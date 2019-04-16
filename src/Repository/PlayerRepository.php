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

    private function convertToModel(array $data) {
        $player = new Player();
        $player->setId((int)$data['player_id'])
             ->setFirstName($data['first_name'])
             ->setLastName($data['last_name'])
             ->setTeam($data['team']);
        return $player;
    }

    public function getPlayers(string $request = ''): array {
        $results = parent::getResults($request);
        $players = [];
        foreach ($results as $result) {
            $players[] = $this->convertToModel($result);
        }
        return $players;
    }

    public function getPlayer(string $request = ''): ?Player {
        $player = null;
        $result = parent::getResult($request)
    }
}
