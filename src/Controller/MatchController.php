<?php

namespace App\Controller;

use App\Model\Team;
use App\Model\Match;
use App\Repository\TeamRepository;
use App\Repository\MatchRepository;

class MatchController
{
    /** @var MatchRepository $matchRepository */
    private $matchRepository;
    /** @var array $teams */
    private $teams;
    /** @var TeamRepository $teamRepository */
    private $teamRepository;

    /**
     * MatchController constructor.
     */
    public function __construct()
    {
        $this->matchRepository = new MatchRepository();
        $this->teamRepository = new TeamRepository();
        $this->teams = $this->teamRepository->getTeams();
    }

    public function index()
    {
        $matches = $this->matchRepository->getMatches();
        require_once 'src/View/Match/index.php';
    }

    public function putResults()
    {
        if (!isset($_GET['match_id']) || empty($_GET['match_id'])) {
            header('Location: /match');
            exit;
        }
        $teamRepository = new TeamRepository();

        $id = $_GET['match_id'];
        $match = $this->matchRepository->getMatch("WHERE match_id = ${id}");

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['score_one']) && !empty($_POST['score_one']) && 
                isset($_POST['score_two']) && !empty($_POST['score_two'])) {
                $scoreOne = $_POST['score_one'];
                $scoreTwo = $_POST['score_two'];
                if($scoreOne === null || $scoreTwo === null) {
                    $errors[] = 'Score not found';
                } else if($scoreOne === $scoreTwo) {
                    $errors[] = 'Les scores ne peuvent être égaux';
                } else {
                    $match->setScoreOne($_POST['score_one'])
                        ->setScoreTwo($_POST['score_two']);
                    $this->matchRepository->update($match);
                    header('Location: /match');
                    exit;
                }
            } else {
                $errors[] = 'Missing fields';
            }
        }
        $teams = $teamRepository->getTeams();
        require_once 'src/View/Match/index.php';
    }

    public function createFirstMatches() {

        $errors = [];
        $currentMatches = [];
        $teams = $this->teamRepository->getTeams();
        if (count($teams) !== 8) {
            $errors[] = 'Il doit y avoir 8 équipes pour lancer un tournoi.';
            header('Location: /match');
            exit;
        } else {
            for ($i=0; $i < 4 ; $i++) { 
                $match = new Match();
                $randomKeys = array_rand($teams, 2);
                $match->setTeamOne($teams[$randomKeys[0]]->getId());
                $match->setTeamTwo($teams[$randomKeys[1]]->getId());
                $teams.splice($randomKeys[1], 1);
                $teams.splice($randomKeys[0], 1);
                $this->matchRepository->insert($match);
                $currentMatches[] = $match;
            }
        }
        return $currentMatches;
        require_once 'src/View/Match/index.php';
    }

    public function createSemiFinals() {
        $matches = $this->matchRepository->getMatches();
        $winningTeams = [];
        $currentMatches = [];
        for ($i=0; $i < 4; $i++) { 
            if ($matches[i]->getScoreOne() > $matches[i]->getScoreTwo()) {
                $winningTeams[] = $matches[i]->getTeamOne();
            } else {
                $winningTeams[] = $matches[i]->getTeamTwo();
            }
        }
        for ($i=0; $i < 2 ; $i++) { 
            $match = new Match();
            $randomKeys = array_rand($winningTeams, 2);
            $match->setTeamOne($winningTeams[$randomKeys[0]]);
            $match->setTeamTwo($winningTeams[$randomKeys[1]]);
            $winningTeams.splice($randomKeys[1], 1);
            $winningTeams.splice($randomKeys[0], 1);
            $this->matchRepository->insert($match);
            $currentMatches[] = $match;
        }
        return $currentMatches;
    }

    public function createFinals() {
        $matches = [];
        $matches[] = $this->matchRepository->getMatch("WHERE match_id = 5");
        $matches[] = $this->matchRepository->getMatch("WHERE match_id = 6");
        $winningTeams = [];
        $loosingTeams = [];
        for ($i=0; $i < 2; $i++) { 
            if ($matches[i]->getScoreOne() > $matches[i]->getScoreTwo()) {
                $winningTeams[] = $matches[i]->getTeamOne();
                $loosingTeams[] = $matches[i]->getTeamTwo();
            } else {
                $winningTeams[] = $matches[i]->getTeamTwo();
                $loosingTeams[] = $matches[i]->getTeamOne();
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
        $finals = [$greatFinal, $littleFinal];
        return $finals;
    }

    public function abandonShip() {
        $this->matchRepository->refresh();
        header('Location: /match');
    }
        
}