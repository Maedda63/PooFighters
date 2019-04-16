<?php

namespace App\Repository;

abstract class Repository implements IRepository
{
    /** @var \mysqli $db */
    private $db;
    /** @var string $table */
    private $table;

    /**
     * Repository constructor.
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Connection to database
     *
     * @throws \Exception
     */
    protected function connectDB()
    {
        if (empty($this->db)) {
            $this->db = new \mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'), getenv('DB_PORT'));
            if ($this->db->connect_errno) {
                throw new \Exception($this->db->connect_error, $this->db->connect_errno);
            }
        }
    }

    /**
     * Close connection to database
     *
     * @throws \Exception
     */
    protected function disconnectDB()
    {
        if (!empty($this->db)) {
            $this->db->close();

            if ($this->db->connect_errno) {
                throw new \Exception($this->db->connect_error, $this->db->connect_errno);
            }
            $this->db = null;
        }
    }

    /**
     * Insert data in table
     *
     * @param string $request
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function insert($request)
    {
        $this->connectDB();

        $this->db->query("INSERT INTO `" . $this->table . "` ${request};");

        if ($this->db->errno) {
            throw new \Exception($this->db->error, $this->db->errno);
        }

        $lastId = $this->db->insert_id;
        $this->disconnectDB();

        return $lastId;
    }

    /**
     * Delete data in table
     *
     * @param string $request
     * @throws \Exception
     */
    public function delete($request)
    {
        $this->connectDB();

        $this->db->query("DELETE FROM `" . $this->table . "` ${request};");

        if ($this->db->errno) {
            throw new \Exception($this->db->error, $this->db->errno);
        }

        $this->disconnectDB();
    }

    /**
     * Update data in table
     *
     * @param $request
     * @throws \Exception
     */
    public function update($request)
    {
        $this->connectDB();

        $this->db->query("UPDATE `" . $this->table . "` ${request};");

        if ($this->db->errno) {
            throw new \Exception($this->db->error, $this->db->errno);
        }

        $this->disconnectDB();
    }

    /**
     * Get results
     *
     * @param string $request
     * @return array
     * @throws \Exception
     */
    public function getResults(string $request): array
    {
        $results = [];

        $this->connectDB();

        $res = $this->db->query("SELECT * FROM `" . $this->table . "` ${request};");

        if ($this->db->errno) {
            throw new \Exception($this->db->error, $this->db->errno);
        }

        while ($row = $res->fetch_assoc()) {
            $results[] = $row;
        }
        $this->disconnectDB();

        return $results;
    }


    /**
     * Get result
     *
     * @param string $request
     * @return array|null
     * @throws \Exception
     */
    public function getResult(string $request)
    {
        $this->connectDB();

        $res = $this->db->query("SELECT * FROM `" . $this->table . "` ${request};");

        if ($this->db->errno) {
            throw new \Exception($this->db->error, $this->db->errno);
        }

        $result = $res->fetch_assoc();

        $this->disconnectDB();

        return $result;
    }
}