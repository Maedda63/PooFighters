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
             ->setTeamOne($data['team_one'])
             ->setTeamTwo($data['team_two'])
             ->setResultOne($data['score_one'])
             ->setResultTwo($data['score_two']);
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

    public function getMatch(string $request = ''): ?Match {
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
            addslashes($match->getTeamOne()) . "','" .
            addslashes($match->getTeamTwo()) . "','" .
            addslashes($match->getResultOne()) . "','" .
            addslashes($match->getResultTwo()) . "')";
        return parent::insert($request);
    }

    public function update($match) {
        if (!$match instanceof Match) {
            throw new \Exception('Something went wrong');
        }
        $request = "SET team_one = '" . addslashes($match->getTeamOne()) . 
            "', team_two = '" . addslashes($match->getTeamTwo()) . 
            "', score_one = '" . addslashes($match->getResultOne()) . 
            "', score_two = '" . addslashes($match->getResultTwo()) . 
            "' WHERE id = " . addslashes($match->getId()) . " ";
        parent::update($request);
    }
}
