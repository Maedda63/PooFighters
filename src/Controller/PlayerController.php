<?php

namespace App\Controller; 

use App\Model\Player;
use App\Repository\PlayerRepository;

class PlayerController {
    public function index() {
        $playerRepository = new PlayerRepository();
        $players = $playerRepository->getPlayers();
    }

    public function create(){
        $errors = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['lastname']) && !empty($_POST['lastname']) || isset($_POST['firstname']) && !empty($_POST['firstname'])) {
                $player = new Player();
                $player->setLastname($_POST['lastname'])
                    ->setFirstname($_POST['firstname']);

                    $this->playerRepository->insert($player);

                    header('Location: /player');
                    exit;
            } else {
                $errors[] = 'Missing fields';
            }
        }

        require_once 'src/View/Player/create.php';
        return;
    }

}