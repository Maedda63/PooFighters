<?php

namespace App\Repository;

use App\Model\Tournament;

class TournamentRepository extends Repository implements IRepository {

    private static $table = 'tournament';

    /**
     * TournamentRepository constructor.
    */
    public function __construct()
    {
        parent::__construct(TournamentRepository::$table);
    }

    private function convertToModel(array $data) {
        $tournament = new Tournament();
        $tournament->setId((int)$data['tournament_id'])
             ->setName($data['tournament_name']);
        return $tournament;
    }

    public function getTournaments(string $request = ''): array {
        $results = parent::getResults($request);
        $tournaments = [];
        foreach ($results as $result) {
            $tournaments[] = $this->convertToModel($result);
        }
        return $tournaments;
    }

    public function getTournament(string $request = ''): ?Tournament {
        $tournament = null;
        $result = parent::getResult($request);

        if($result) {
            $tournament = $this->convertToModel($result);
        }
        return $tournament;
    }

    public function insert($tournament) {
        if (!$tournament instanceof Tournament) {
            throw new \Exception('Something went wrong');
        }
        $request = "(name) VALUES  ('" . 
            addslashes($tournament->getName()) . "')";
        return parent::insert($request);
    }
}
