<?php
namespace WarehouseCore\Repository\Inventory;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\ContainerEntity;

final class ContainerRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name) {
    }

    public function getById(
        int $id
    ): null|ContainerEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : ContainerEntity::fromRaw($result);
    }

    public function findByType(
        string $type
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE type = :type"
        );
        $stmt->execute([
            ":type" => $type
        ]);
        return array_map(fn($row) => ContainerEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByCreatedByUserId(
        int $user_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE created_by_user_id = :user_id"
        );
        $stmt->execute([
            ":user_id" => $user_id
        ]);
        return array_map(fn($row) => ContainerEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function add(
        int $user_id,
        int $id, 
        string $type
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (id, type, created_by_user_id) 
                VALUES (:id, :type, :user_id)"
            );
            $stmt->execute([
                ':id' => $id,
                ':type' => $type,
                ':user_id' => $user_id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
    
    public function updateType(
        int $id, 
        string $type
    ): bool {
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
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $id
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM {$this->table_name} 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}