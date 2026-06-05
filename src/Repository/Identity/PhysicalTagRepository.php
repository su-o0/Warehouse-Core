<?php
namespace WarehouseCore\Repository\Identity;

use WarehouseCore\Exception\StorageException;

final class PhysicalTagRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function findById(
        int $id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":Id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByStatus(
        string $status
    ): null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE status = :status"
        );
        $stmt->execute([
            ":status" => $status
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(
        int $id, 
        string $status
    ): int {
        if(!$this->isValidStatus($status))
            throw StorageException::PHYSICAL_TAG_INVALID_STATUS();

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (id, status) 
                VALUES (:id, :status)"
            );
            $stmt->execute([
                ':id' => $id,
                ':status' => $status,
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1062)
                throw StorageException::PHYSICAL_TAG_ALREADY_EXISTS();            
            
            throw $e;
        }
    }

    public function updateStatus(
        int $id, 
        string $status
    ):bool {
        if ($this->findById($id) === null) 
            throw new \RuntimeException("Бирка $id не найдена");

        if(!$this->isValidStatus($status))
            throw StorageException::PHYSICAL_TAG_INVALID_STATUS();
        
        try {
            $stmt = $this->db->prepare(
                 "UPDATE {$this->table_name} 
                SET status = :status 
                WHERE id = :id"
            );
            return $stmt->execute([
                'id' => $id,
                ':status' => $status,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1062)
                throw StorageException::PHYSICAL_TAG_ALREADY_EXISTS();
            
            throw $e;
        }
    }

    public function isValidStatus(
        string $status
    ): bool {
        switch($status){
            case "Free": 
                return true;
            case "Assigned": 
                return true;
            case "Lotable_namst": 
                return true;
            case "Broken": 
                return true;
            default: 
                return false;
        }
    }
}