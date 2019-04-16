<?php 

namespace App\Model;

class Team {

    /** @var int $id */
    private $id;
    /** @var Player[] $players */
    private $players;

    public function getId(): int {
        return $this->id;    
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }
    public function getPlayers(): array {
        return $this->players;    
    }

    public function setPlayers(array $players): self {
        $this->players = $players;
        return $this;
    }
}