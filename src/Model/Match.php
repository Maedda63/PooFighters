<?php

namespace App\Model;

class Match {
    /** @var int $id */
    private $id;
    /** @var Team[] $teams */
    private $teams;
    /** @var int[] $results */
    private $results;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTeams(): array
    {
        return $this->teams;
    }

    public function setTeams(array $teams): self
    {
        $this->teams = $teams;

        return $this;
    }

    public function getResults(): array 
    {
        return $this->results;
    }

    public function setResults(array $results)
    {
        $this->results = $results;

        return $this;
    }
}
