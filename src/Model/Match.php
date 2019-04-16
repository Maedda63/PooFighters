<?php

namespace App\Model;

class Match {
    /** @var int $id */
    private $id;
    /** @var Team $team1 */
    private $team1;
    /** @var Team $team2 */
    private $team2;
    /** @var int $result1 */
    private $result1;
    /** @var int $result2 */
    private $result2;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTeam1(): Team
    {
        return $this->team1;
    }

    public function setTeam1(Team $team1): self
    {
        $this->team1 = $team1;

        return $this;
    }

    public function getTeam2(): Team
    {
        return $this->team2;
    }

    public function setTeam2(Team $team2): self
    {
        $this->team2 = $team2;

        return $this;
    }

    public function getResult1(): int
    {
        return $this->result1;
    }

    public function setResult1(int $result1): self
    {
        $this->result1 = $result1;

        return $this;
    }

    public function getResult2(): int
    {
        return $this->result2;
    }

    public function setResult2(int $result2): self
    {
        $this->result2 = $result2;

        return $this;
    }
}
