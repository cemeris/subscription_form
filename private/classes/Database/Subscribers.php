<?php
namespace Database;

class Subscribers extends DB
{
    private $table_name = 'subscribers';

    public function get(int $id) {
        return $this->getById($id, $this->table_name);
    }

    public function getAll() {
        return $this->selectAll($this->table_name);
    }

    public function addEntity(array $entity) {
        return $this->insertEntity($entity, $this->table_name);
    }

    public function delete(int $id) {
        return $this->deleteEntityById($id, $this->table_name);
    }
}