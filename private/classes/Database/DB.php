<?php
namespace Database;

class DB
{
    private $conn;
    private $last_sql = '';
    public function __construct() {
        $this->conn = new \mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        $this->conn->close();
    }

    protected function getById(int $id, string $table_name) {
        $this->last_sql = "SELECT * FROM $table_name WHERE id=$id";
        $result = $this->conn->query($this->last_sql);

        return $result->fetch_assoc();
    }

    protected function selectAll(string $table_name) {
        $this->last_sql = "SELECT * FROM $table_name";
        $result = $this->conn->query($this->last_sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    protected function insertEntity(array $entity, string $table_name) {
        $column_str = '';
        $value_str = '';

        foreach ($entity as $column => $value) {
            $column_str .= $column . ',';
            $value_str .= "'". $this->conn->real_escape_string($value) . "',";
        }
        $column_str = substr_replace($column_str, "", -1);
        $value_str = substr_replace($value_str, "", -1);

        $this->last_sql = "INSERT INTO $table_name ($column_str) VALUES ($value_str)";

        if ($this->conn->query($this->last_sql)) {
            $entity['id'] = $this->conn->insert_id;
            return $entity;
        }
        return false;
    }

    protected function deleteEntityById(int $id, string $table_name) {
        $sql = "DELETE FROM $table_name WHERE id=$id";
        if (
            $this->conn->query($sql) &&
            $this->conn->affected_rows > 0
        ) {
            return true;
        }
        return false;
    }

    public function getError() {
        return $this->conn->error. PHP_EOL .'SQL:' . $this->last_sql;
    }
}