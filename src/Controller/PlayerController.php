<?php

namespace App\Controller; 

use App\Repository\PlayerRepository;
use App\Model\Player\Player;
use App\Repository\TeamRepository;

class PlayerController {
    private $playerRepository;
    private $teamRepository;

    public function __construct() {
        $this->playerRepository = new PlayerRepository();
        $this->teamRepository = new TeamRepository();
    }

    public function index() {
        $players = $this->playerRepository->getResults();
        require_once 'src/View/Player/index.php';
    }

    public function show() {
        if(isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: /player');
            exit;
        }
        $id = $_GET['id'];
        $player = $this->playerRepository->getResults('WHERE id =' . $id);
        require_once 'src/View/Player/show.php';
    }

    public function create() {
        $errors = [];
        $teamRepository = new TeamRepository();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['player']) && !empty($_POST['player']) &&
            isset($_POST['team']) && !empty($_POST['team'])
            ) {
                $player = new Player();
                $team = $teamRepository->getResult('WHERE id =' . $_POST['team']);
                if($team == NULL) {
                    $errors[] = 'Team not found';
                } else {
                    $player->setLastname($_POST['lastname'])
                            ->setFirstname($_POST['firstname'])
                            ->setTeam($team);
                    $this->playerRepository->insert($player);
                    header('Location: /player');
                    exit;
                }
            }else {
                $errors[] = 'Missing fields';
            }
        }
        $teams = $teamRepository->getResults();

        require_once 'src/View/Player/create.php';
        return;
    }

    public function update() {
        $errors
    }
}