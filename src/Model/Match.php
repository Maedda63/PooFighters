<?php

namespace App\Model;

class Match {
    /** @var int $id */
    private $id;
    /** @var int $teamOne */
    private $teamOne;
    /** @var int $teamTwo */
    private $teamTwo;
    /** @var int $resultOne */
    private $resultOne;
    /** @var int $resultTwo */
    private $resultTwo;
    /** @var int $tournament */
    private $tournament;


    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTeamOne(): int
    {
        return $this->teamOne;
    }
    public function setTeamOne(int $teamOne): self
    {
        $this->teamOne = $teamOne;
        return $this;
    }

    public function getTeamTwo(): int
    {
        return $this->teamTwo;
    }
    public function setTeamTwo(int $teamTwo): self
    {
        $this->teamTwo = $teamTwo;
        return $this;
    }

    public function getResultOne(): int
    {
        return $this->resultOne;
    }
    public function setResultOne(int $resultOne): self
    {
        $this->resultOne = $resultOne;
        return $this;
    }

    public function getResultTwo(): int
    {
        return $this->resultTwo;
    }
    public function setResultTwo(int $resultTwo): self
    {
        $this->resultTwo = $resultTwo;
        return $this;
    }

    public function getTournament(): int {
        return $this->tournament;
    }
    public function setTournament(int $tournament): self {
        $this->tournament = $tournament;
        return $this;
    }
}
