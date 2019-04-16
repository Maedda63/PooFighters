<?php 

namespace App\Model;

class Team {

    /** @var int $id */
    private $id;

    public function getId(): int {
        return $this->id;    
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }
}