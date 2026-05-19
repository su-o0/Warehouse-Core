<?php
namespace WarehouseCore\Repository\Topology;
use WarehouseCore\Exception\StorageException;

class PhysicalTagRepository {
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

    public function findByStatus(string $Status): null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Status = :Status"
        );
        $stmt->execute([
            ":Status" => $Status
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(int $Id, string $Status): int {
        if(!$this->isValidStatus($Status))
            throw StorageException::PHYSICAL_TAG_INVALID_STATUS();

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Id, Status) 
                VALUES (:Id, :Status)"
            );
            $stmt->execute([
                ':Id' => $Id,
                ':Status' => $Status,
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1062)
                throw StorageException::PHYSICAL_TAG_ALREADY_EXISTS();            
            
            throw $e;
        }
    }

    public function updateStatus(int $Id, string $Status):bool {
        $PhysicalTag = $this->findById($Id);
        if ($PhysicalTag === null) 
            throw new \RuntimeException("Бирка $Id не найдена");

        if(!$this->isValidStatus($Status))
            throw StorageException::PHYSICAL_TAG_INVALID_STATUS();
        
        try {
            $stmt = $this->db->prepare(
                 "UPDATE $this->tableName 
                SET Status = :Status 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                'Id' => $Id,
                ':Status' => $Status,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1062)
                throw StorageException::PHYSICAL_TAG_ALREADY_EXISTS();
            
            throw $e;
        }
    }

    public function isValidStatus(string $Status): bool {
        switch($Status){
            case "Free": 
                return true;
            case "Assigned": 
                return true;
            case "Lost": 
                return true;
            case "Broken": 
                return true;
            default: 
                return false;
        }
    }
}