<?php

namespace App\Repository;

use App\Model\Team;

class TeamRepository extends Repository implements IRepository {

    private static $table = 'team';

    /**
     * TeamRepository constructor.
    */
    public function __construct()
    {
        parent::__construct(TeamRepository::$table);
    }

    public function getResult(string $request =''): ?Team
    {
        $team = null;
        $result = parent::getResult($request);

        if ($result) {
            $team = new Team();
            $team->setId($result['team_id'])
                ->setName($result['team_name']);
        }
        return $team;
    }

    public function getResults(string $request = ''): array
    {
        $teams = [];
        $results = parent::getResults($request);

        if ($results) {
            foreach ($results as $result) {
                $team = new Team();
                $team->setId($result['team_id'])
                    ->setName($result['team_name']);
                $teams[] = $team;
            }
        }

        return $teams;
    }

    public function insert($team)
    {
        if (!$team instanceof Team) {
            throw new \Exception('You can save only teams');
        }
        $request = "(team_name) VALUES ('" . addslashes($team->getName()) . "')";
        return parent::insert($request);
    }

    public function update($team)
    {
        if(!$team instanceof Team) {
            throw new \Exception('You can save only teams');
        }
        $request = "SET team_name ='" . addslashes($team->getName()) . "' WHERE team_id = " . $team->getId() . " ";
        parent::update($request);
    }

    public function delete($team)
    {
        if (!$team instanceof Team) {
            throw new \Exception('You can save only teams');
        }
        $request = "WHERE team_id = " . $team->getId();
        parent::delete($request);
    }

    
}
