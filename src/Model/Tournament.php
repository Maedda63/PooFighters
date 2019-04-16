<?php

namespace App\Model;

class Tournament {
    /** @var string $name */
    private $name;
    /** @var Match[] $matches */
    private $matches;
    /** @var Team[] $teams */
    private $teams;

    public function getName(): string {
        return $this->name;    
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getMatches(): array {
        return $this->matches;    
    }

    public function setMatches(array $matches): self {
        $this->matches = $matches;
        return $this;
    }

    public function getTeams(): array {
        return $this->teams;    
    }

    public function setTeams(array $teams): self {
        $this->teams = $teams;
        return $this;
    }

}