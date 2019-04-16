<?php

namespace App\Model;

class Tournament {

    /** @var int $id */
    private $id;
    /** @var string $name */
    private $name;


    public function getId(): int {
        return $this->id;    
    }
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getName(): string {
        return $this->name;    
    }
    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }
}