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

    
}
