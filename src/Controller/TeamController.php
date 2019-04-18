<?php

namespace App\Controller;

use App\Model\Team;
use App\Model\Player;
use App\Repository\TeamRepository;
use App\Repository\PlayerRepository;

class TeamController
{
    /** @var TeamRepository $teamRepository */
    private $teamRepository;
    /** @var PlayerRepository $playerRepository */
    private $playerRepository;

    public function __construct()
    {
        $this->teamRepository = new TeamRepository();
        $this->playerRepository = new PlayerRepository();
    }

    public function index()
    {
        $teams = $this->teamRepository->getTeams();

        require_once 'src/View/Team/index.php';
    }

    public function create()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['team_name']) && !empty($_POST['team_name'])) {
                $team = new Team();
                $team->setName($_POST['team_name']);

                $this->teamRepository->insert($team);
                header('Location: /team');
                exit;
            } else {
                $errors[] = 'Missing fields';
            }
        }
        require_once 'src/View/Team/create.php';
    }

    public function update()
    {
        if (!isset($_GET['team_id']) || empty($_GET['team_id'])) {
            header('Location: /team');
            exit;
        }

        $id = $_GET['team_id'];
        $team = $this->teamRepository->getTeam("WHERE team_id = ${id}");

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['team_name']) && !empty($_POST['team_name'])) {
                $team->setName($_POST['team_name']);

                $this->teamRepository->update($team);
                header('Location: /team');
                exit;
            } else {
                $errors[] = 'Missing fields';
            }
        }
        require_once 'src/View/Team/update.php';
    }

    public function delete()
    {
        if (!isset($_GET['team_id']) || empty($_GET['team_id'])) {
            header('Location: /team');
            exit;
        }
        $id = $_GET['team_id'];

        $team = $this->teamRepository->getTeam("WHERE team_id = ${id}");
        $this->teamRepository->delete($team);
        header('Location: /team');
        exit;
    }

    public function getMembers($team) {
        $players = $this->playerRepository->getPlayers();
        $members = [];
        $id = $team->getId();
        foreach ($players as $player) {
            if ($player->getTeam() === $id) {
                $members[] = $player;
            }
        }
        return $members;
    }
}
