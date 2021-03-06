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

    /**
     * function to get ONE Team in the database
     */
    public function getTeam(string $request =''): ?Team
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

    /**
     * function to get ALL Teams in the database
     */
    public function getTeams(string $request = ''): array
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

    /**
     * function to insert values for 'team_name' in the 'team' table
     */
    public function insert($team)
    {
        if (!$team instanceof Team) {
            throw new \Exception('You can save only teams');
        }
        $request = "(team_name) VALUES ('" . addslashes($team->getName()) . "')";
        return parent::insert($request);
    }

    /** 
     * function to modify the values in the 'team' table
     */
    public function update($team)
    {
        if(!$team instanceof Team) {
            throw new \Exception('You can update only teams');
        }
        $request = "SET team_name ='" . addslashes($team->getName()) . "' WHERE team_id = " . $team->getId() . " ";
        parent::update($request);
    }

    /**
     *  function to delete a team from the team table
     */
    public function delete($team)
    {
        if (!$team instanceof Team) {
            throw new \Exception('You can delete only teams');
        }
        $request = "WHERE team_id = " . $team->getId();
        parent::delete($request);
    }

    
}
