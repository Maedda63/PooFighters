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
        $result = parent::getResult($request);

        if($result) {
            $player = $this->convertToModel($result);
        }
        return $player;
    }

    public function insert($player) {
        if (!$player instanceof Player) {
            throw new \Exception('Something went wrong');
        }
        $request = "(first_name, last_name, team) VALUES  ('" . 
            addslashes($player->getFirstname()) . "','" . 
            addslashes($player->getLastname()) . "','" . 
            addslashes($player->getTeam()) . "')";
        return parent::insert($request);
    }

    public function update($player) {
        if (!$player instanceof Player) {
            throw new \Exception('Something went wrong');
        }
        $request = "SET first_name = '" . addslashes($player->getFirstname()) . 
            "', last_name = '" . addslashes($article->getLastname()) . 
            "', team = '" . addslashes($article->getTeam()) . 
            "' WHERE id = " . addslashes($article->getId()) . " ";
        parent::update($request);
    }

    public function delete($player) {
        if (!$player instanceof Player) {
            throw new \Exception('Oops, something went wrong');
        }
        $request = "WHERE id = " . $player->getId();
        parent::delete($request);
    }
    
}
