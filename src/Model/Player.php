<?php

namespace App\Model;

class Player {

    /** @var int $id */
    private $id;
    /** @var string $lastname */
    private $lastname;
    /** @var string $firstname */
    private $firstname;
    /** @var Team $team */
    private $team;

    public function getId(): int{
        return $this->id;
    }
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getLastname(): string{
        return $this->lastname;
    }
    public function setLastname(string $lastname): self {
        $this->lastname = $lastname;
        return $this;
    }

    public function getFirstname(): string{
        return $this->firstname;
    }
    public function setFirstname(string $firstname): self {
        $this->firstname = $firstname;
         return $this;
    }

    public function getTeam(): Team{
        return $this->team;
    }
    public function setTeam(Team $team): self {
        $this->team = $team;
         return $this;
    }
}