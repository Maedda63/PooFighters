<?php

namespace App\Repository;

use App\Model\Player;

class PlayerRepository extends Repository implements IRepository {

    private static $table = 'player';

    /**
     * PlayerRepository constructor.
    */
    public function __construct()
    {
        parent::__construct(PlayerRepository::$table);
    }

    
}
