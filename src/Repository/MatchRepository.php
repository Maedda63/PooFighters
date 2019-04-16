<?php

namespace App\Repository;

use App\Model\Match;

class MatchRepository extends Repository implements IRepository {

    private static $table = 'match';

    /**
     * MatchRepository constructor.
    */
    public function __construct()
    {
        parent::__construct(MatchRepository::$table);
    }

    private function convertToModel(array $data) {
        $match = new Match();
        $match->setId((int)$data['match_id'])
             ->setTeam1($data['team_one'])
             ->setTeam2($data['team_two'])
             ->setResult1($data['score_one'])
             ->setResult2($data['score_two']);
        return $match;
    }

    public function getMatches(string $request = ''): array {
        $results = parent::getResults($request);
        $matches = [];
        foreach ($results as $result) {
            $matches[] = $this->convertToModel($result);
        }
        return $matches;
    }

    public function getMatch(string $request = ''): ?Player {
        $match = null;
        $result = parent::getResult($request);

        if($result) {
            $match = $this->convertToModel($result);
        }
        return $match;
    }

    public function insert($match) {
        if (!$match instanceof Match) {
            throw new \Exception('Something went wrong');
        }
        $request = "(team_one, team_two, score_one, score_two) VALUES  ('" . 
            addslashes($match->getTeam1()) . "','" . 
            addslashes($player->getTeam2()) . "','" . 
            addslashes($player->getResult1()) . "','" . 
            addslashes($player->getResult2()) . "')";
        return parent::insert($request);
    }

    
}
