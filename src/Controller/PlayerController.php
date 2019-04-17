<?php

namespace App\Controller; 

use App\Repository\PlayerRepository;
use App\Model\Player;
use App\Repository\TeamRepository;

class PlayerController {
    private $playerRepository;
    private $teamRepository;

    public function __construct() {
        $this->playerRepository = new PlayerRepository();
        $this->teamRepository = new TeamRepository();
    }

    public function index() {
        $players = $this->playerRepository->getPlayers();
        require_once 'src/View/Player/index.php';
    }

    public function show() {
        if(!isset($_GET['player_id']) || empty($_GET['player_id'])) {
            header('Location: /player');
            exit;
        }
        $id = $_GET['player_id'];
        $player = $this->playerRepository->getPlayers('WHERE player_id =' . $id);
        require_once 'src/View/Player/show.php';
    }

    public function create() {
        $errors = [];
        $teamRepository = new TeamRepository();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['lastname']) && !empty($_POST['lastname']) &&
            isset($_POST['firstname']) && !empty($_POST['firstname']) &&
            isset($_POST['team']) && !empty($_POST['team'])
            ) {
                $player = new Player();
                $player->setLastname($_POST['lastname'])
                        ->setFirstname($_POST['firstname'])
                        ->setTeam($_POST['team']);
                $this->playerRepository->insert($player);
                header('Location: /player');
                exit; 
            } else {
                $errors[] = 'Missing fields';
            }
        }
        $teams = $teamRepository->getTeams();

        require_once 'src/View/Player/create.php';
        return;
    }

    public function update() {
        $errors = [];
        $teamRepository = new TeamRepository();

        if(!isset($_GET['player_id']) || empty($_GET['player_id'])) {
            header('Location: /player');
            exit;
        }
        $player = $this->playerRepository->getPlayer('WHERE player_id=' . $_GET['player_id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['lastname']) && !empty($_POST['lastname']) && 
                isset($_POST['firstname']) && !empty($_POST['firstname']) &&
                isset($_POST['team']) && !empty($_POST['team'])) {
                
                $team = $teamRepository->getResult('WHERE player_id=' . $_POST['team']);
                $player->setLastname(htmlspecialchars($_POST['lastname']))
                    ->setFirstname(htemlspecialchars($_POST['firstname']))
                    ->setTeam($team);

                $this->playerRepository->uptdate($player);

                header('Location: /player');
                exit;
                } else {
                    $errors[] = 'Missing fields';
                }
            }
            $teams = $teamRepository->getTeams();

            require_once 'src/View/Player/update.php';
            return;
    }

    public function delete() {
        if(!isset($_GET['player_id']) || empty($_GET['player_id'])) {
            header('Location: /player');
            return;
            $id = $_GET['player_id'];

            $player = $this->playerRepository->getResult("WHERE player_id = ${id}");
            $this->playerRepository->delete($player);
            header('Location: /player');
            exit;
        }
    }
}