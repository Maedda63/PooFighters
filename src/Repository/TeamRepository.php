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

    
}
