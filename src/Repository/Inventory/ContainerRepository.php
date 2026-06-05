<?php
namespace WarehouseCore\Repository\Inventory;
use WarehouseCore\Exception\StorageException;

final class ContainerRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name) {
    }

    public function findById(
        int $id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByType(
        int $type
    ): null|array {
        if(!$this->isValidType($type))
            throw StorageException::CONTAINER_INVALID_TYPE();

        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE type = :type"
        );
        $stmt->execute([
            ":type" => $type
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function add(
        int $id, 
        string $type
    ): int {
        if(!$this->isValidType($type))
            throw StorageException::CONTAINER_INVALID_TYPE();

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (id, type) 
                VALUES (:id, :type)"
            );
            $stmt->execute([
                ':id' => $id,
                ':type' => $type
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1062)
                throw StorageException::CONTAINER_ALREADY_EXISTS();

            throw $e;
        }
    }
    
    public function updateType(
        int $id, 
        string $type
    ): bool {
        if(!$this->isValidType($type))
            throw StorageException::CONTAINER_INVALID_TYPE();

        try{
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET type = :type 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':type' => $type,
                ':id' => $id,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::CONTAINER_NOT_FOUND();

            throw $e;
        }
    }

    public function delete(
        int $id
    ): bool {
        if($this->findById($id) === null)
            throw StorageException::CONTAINER_NOT_FOUND();
        
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM {$this->table_name} 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id
            ]);
        } catch (\PDOException $e) {

            throw $e;
        }
    }

    private function isValidType(
        string $type
    ): bool {
        switch($type) {
            case "Box": 
                return true;
            case "Pallet": 
                return true;
            default: 
                return false;
        }
    }
}