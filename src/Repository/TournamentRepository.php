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

    
}
