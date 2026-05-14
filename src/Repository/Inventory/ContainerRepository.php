<?php
namespace SuO0\StorageApi\Repository\Inventory;
use SuO0\StorageApi\Exception\StorageException;

class ContainerRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findById(int $Id): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Id = :Id"
        );
        $stmt->execute([
            ":Id" => $Id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByType(int $Type): null|array {
        if($this->isStateType($Type))
            throw StorageException::CONTAINER_INVALID_TYPE();

        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Type = :Type"
        );
        $stmt->execute([
            ":Type" => $Type
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function add(int $Id, string $Type): int {
        if($this->isStateType($Type))
            throw StorageException::CONTAINER_INVALID_TYPE();

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Id, Type) 
                VALUES (:Id, :Type)"
            );
            $stmt->execute([
                ':Id' => $Id,
                ':Type' => $Type
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1062)
                throw StorageException::CONTAINER_ALREADY_EXISTS();

            throw $e;
        }
    }
    
    public function updateType(int $Id, string $Type): bool {
        if($this->isStateType($Type))
            throw StorageException::CONTAINER_INVALID_TYPE();

        try{
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Type = :Type 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Type' => $Type,
                ':Id' => $Id,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::CONTAINER_NOT_FOUND();

            throw $e;
        }
    }

    public function delete(int $Id): bool {
        $stock = $this->findById($Id);
        if($stock === null)
            throw StorageException::CONTAINER_NOT_FOUND();
        
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM $this->tableName 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Id' => $Id
            ]);
        } catch (\PDOException $e) {

            throw $e;
        }
    }

    public function isStateType(string $Type): bool {
        switch($Type) {
            case "Box": 
                return true;
            case "Pallet": 
                return true;
            default: 
                return false;
        }
    }
}