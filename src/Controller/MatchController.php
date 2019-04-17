<?php

namespace App\Controller;

use App\Model\Team;
use App\Repository\TeamRepository;
use App\Repository\MatchRepository;

class TeamController
{
    /** @var MatchRepository $matchRepository */
    private $matchRepository;
    private $teams;
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

    public function show()
    {
        if (!isset($_GET['match_id']) || empty($_GET['match_id'])) {
            header('Location: /match');
            exit;
        }
        $id = $_GET['match_id'];
        $match = $this->matchRepository->getMatch("WHERE match_id = ${id}");

        require_once 'src/View/Match/show.php';
    }

    public function create()
    {
        $teamRepository = new TeamRepository();

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['team_one']) && !empty($_POST['team_one']) &&
                isset($_POST['team_two']) && !empty($_POST['team_two'])) {
                $teamOneId = $_POST['team_one'];
                $teamTwoId = $_POST['team_two'];
                $teamOne = $teamRepository->getTeam("WHERE team_id = ${teamOneId}");
                $teamTwo = $teamRepository->getTeam("WHERE team_id = ${teamTwoId}");
                if ($teamOne === null || $teamTwo === null) {
                    $errors[] = 'Match not found';
                } else {
                    $match = new Match();
                    $match->setTeamOne($_POST['team_one'])
                        ->setTeamTwo($_POST['team_two']);
                    $this->matchRepository->insert($match);
                    header('Location: /match');
                    exit;
                }
            } else {
                $errors[] = 'Missing fields';
            } 
        }

        $matches = $this->matchRepository->getMatches();

        require_once 'src/View/Match/create.php';
    }

    public function update()
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

        require_once 'src/View/Match/update.php';
    }

    public function delete()
    {
        if (!isset($_GET['match_id']) || empty($_GET['match_id'])) {
            header('Location: /match');
            exit;
        }

        $id = $_GET['match_id'];
        $match = $this->matchRepository->getMatch("WHERE match_id = ${id}");
        $this->matchRepository->delete($match);

        header('Location: /match');
        exit;
    }

    public function createFirstMatches() {
        $errors = [];
        $currentMatches = [];
        $teams = $this->teamRepository->getTeams();
        if (count($teams) !== 8) {
            $errors[] = 'Il doit y avoir 8 équipes pour lancer un tournoi.';
        } else {
            for ($i=0; $i < 4 ; $i++) { 
                $match = new Match();
                $randomKeys = array_rand($this->teams, 2);
                $match->setTeamOne($teams[$randomKeys[0]]);
                $match->setTeamTwo($teams[$randomKeys[1]]);
                $teams.splice($randomKeys[0]);
                $teams.splice($randomKeys[1]);
                $this->matchRepository->insert($match);
                $currentMatches[] = $match;
            }
        }
        require_once 'src/View/Match/index.php';
    }   


}