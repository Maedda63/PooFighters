<?php

namespace App\Controller;

use App\Model\Tournament;
use App\Repository\TournamentRepository;

class TournamentController
{
    /** @var TournamentRepository $tournamentRepository */
    private $tournamentRepository;

    public function __construct()
    {
        $this->tournamentRepository = new TournamentRepository();
    }

    public function index()
    {
        $tournaments = $this->tournamentRepository->getTournaments;

        require_once 'src/View/Tournament/index.php';
    }

    public function create()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['tournament_id']) && !empty($_POST['tournament_id'])) {
                $tournament = new Tournament();
                $tournament->setId($_POST['tournament_id']);

                $this->tournamentRepository->insert($tournament);
                header('Location: /tournament');
                exit;
            } else {
                $errors[] = 'Missing fields';
            }
        }
        require_once 'src/View/Tournament/create.php';
    }

}