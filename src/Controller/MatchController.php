<?php

namespace App\Controller;

use App\Model\Team;
use App\Model\Match;
use App\Model\Player;
use App\Repository\TeamRepository;
use App\Repository\MatchRepository;
use App\Repository\PlayerRepository;

class MatchController
{
    /** @var MatchRepository $matchRepository */
    private $matchRepository;
    /** @var array $teams */
    private $teams;
    /** @var TeamRepository $teamRepository */
    private $teamRepository;
    /** @var PlayerRepository $playerRepository */
    private $playerRepository;
    /** @var array $errors */
    private $errors;
    
    /**
     * MatchController constructor.
     */



    public function __construct()
    {
        $this->matchRepository = new MatchRepository();
        $this->teamRepository = new TeamRepository();
        $this->playerRepository = new PlayerRepository();
        $this->teams = $this->teamRepository->getTeams();
    }

    //function to test if a team has enough players to participate
    public function hasEnoughPlayer($team): bool {
        $id = $team->getId();
        $count = 0;
        $players = $this->playerRepository->getPlayers();
        foreach ($players as $player) {
            if ($player->getTeam() === $id ) {
                $count += 1;
            }
            if ($count > 1) {
                return True;
            } 
        }
        return false;
    }

    public function index()
    {
        $matches = $this->matchRepository->getMatches();
        require_once 'src/View/Match/index.php';
    }

    //Function to generate results for a given match
    public function putResults($match)
    {   
        $scoreOne = rand(0,13);
        do {
        $scoreTwo = rand(0,13);
        } while ($scoreOne == $scoreTwo);
        $match->setResultOne($scoreOne)
        ->setResultTwo($scoreTwo);
        $this->matchRepository->update($match);
    }

    //function to generate and save the finals quarters
    public function createFirstMatches() {
        $teamRepository = new TeamRepository();
        $currentMatches = [];
        $teams = $this->teamRepository->getTeams();
        if (count($teams) !== 8) {
            $this->errors[] = 'Il doit y avoir 8 équipes pour lancer un tournoi.';
            require_once 'src/View/Match/show.php';
            exit;
        } else {
            $isCorrect = true;
            foreach ($teams as $team) {
                if(!$this->hasEnoughPlayer($team)) {
                    $isCorrect = false;
                }
            }
            if (!$isCorrect) {
                $this->errors[] = 'Il doit y avoir au moins 2 joueurs par équipe.';
                require_once 'src/View/Match/show.php';
                exit;
            } else {
                for ($i=0; $i < 4 ; $i++) { 
                    $match = new Match();
                    $randomKeys = array_rand($teams, 2);
                    $match->setTeamOne($teams[$randomKeys[0]]->getId());
                    $match->setTeamTwo($teams[$randomKeys[1]]->getId());
                    array_splice($teams,$randomKeys[1], 1);
                    array_splice($teams,$randomKeys[0], 1);
                    $this->matchRepository->insert($match);
                    $currentMatches[] = $this->matchRepository->getMatch("WHERE match_id =" . $this->getCurrentMatchId(4));
                }
            }
            return $currentMatches;
        }
    }

    //function to generate the semi Finals given the quarter matches
    public function createSemiFinals($currentMatches) {
        $winningTeams = [];
        $currentSemiMatches = [];
        for ($i=0; $i < 4; $i++) { 
            if ($currentMatches[$i]->getResultOne() > $currentMatches[$i]->getResultTwo()) {
                $winningTeams[] = $currentMatches[$i]->getTeamOne();
            } else {
                $winningTeams[] = $currentMatches[$i]->getTeamTwo();
            }
        }
        for ($i=0; $i < 2 ; $i++) { 
            $match = new Match();
            $randomKeys = array_rand($winningTeams, 2);
            $match->setTeamOne($winningTeams[$randomKeys[0]]);
            $match->setTeamTwo($winningTeams[$randomKeys[1]]);
            array_splice($winningTeams,$randomKeys[1], 1);
            array_splice($winningTeams,$randomKeys[0], 1);
            $this->matchRepository->insert($match);
            $match = $this->matchRepository->getMatch("WHERE match_id =" . $this->getCurrentMatchId(4));
            $currentSemiMatches[] = $match;
        }
        return $currentSemiMatches;    
    }

    //function to generate the finals given the semi-finals
    public function createFinals($currentSemiMatches) {
        $winningTeams = [];
        $loosingTeams = [];
        for ($i=0; $i < 2; $i++) { 
            if ($currentSemiMatches[$i]->getResultOne() > $currentSemiMatches[$i]->getResultTwo()) {
                $winningTeams[] = $currentSemiMatches[$i]->getTeamOne();
                $loosingTeams[] = $currentSemiMatches[$i]->getTeamTwo();
            } else {
                $winningTeams[] = $currentSemiMatches[$i]->getTeamTwo();
                $loosingTeams[] = $currentSemiMatches[$i]->getTeamOne();
            }
        }
        $greatFinal = new Match();
        $littleFinal = new Match();
        $greatFinal->setTeamOne($winningTeams[0]);
        $greatFinal->setTeamTwo($winningTeams[1]);
        $littleFinal->setTeamOne($loosingTeams[0]);
        $littleFinal->setTeamTwo($loosingTeams[1]);
        $this->matchRepository->insert($greatFinal);
        $this->matchRepository->insert($littleFinal);
        $greatFinal = $this->matchRepository->getMatch("WHERE match_id =" . $this->getCurrentMatchId(3));
        $littleFinal = $this->matchRepository->getMatch("WHERE match_id =" . $this->getCurrentMatchId(4));
        $finals = [$greatFinal, $littleFinal];
        return $finals;
    }

    //function to get the right ID in the DATA Base
    public function getCurrentMatchId($id) {
        $teamRepository = new TeamRepository();
        $matches = $this->matchRepository->getMatches();
        $matchesIds = [];
        foreach ($matches as $match) {
            $matchesIds[] = $match->getId();
        }
        $id = max($matchesIds) - 4 + $id;
        return($id);
    }

    //function that simulates the tournament
    public function doEverything() {
        $currentMatches = $this->createFirstMatches();
        foreach ($currentMatches as $currentMatch) {
            $this->putResults($currentMatch);
        }
        $currentSemiMatches = $this->createSemiFinals($currentMatches);
        foreach ($currentSemiMatches as $currentMatch) {
            $this->putResults($currentMatch);
        }
        $finals = $this->createFinals($currentSemiMatches);
        foreach ($finals as $final) {
            $this->putResults($final);
        }
        if ($finals[0]->getResultOne() < $finals[0]->getResultTwo()) {
            $winner = $this->teamRepository->getTeam('WHERE team_id =' . 
            $this->matchRepository->getMatch('WHERE match_id =' . 
            $finals[0]->getId())->getTeamTwo())->getName();
        } else {
            $winner = $this->teamRepository->getTeam('WHERE team_id =' . 
            $this->matchRepository->getMatch('WHERE match_id =' . 
            $finals[0]->getId())->getTeamOne())->getName();
        }
        require_once 'src/View/Match/show.php';
    }

    
     
}