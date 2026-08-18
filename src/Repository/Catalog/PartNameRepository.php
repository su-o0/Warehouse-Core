<?php
namespace WarehouseCore\Repository\Catalog;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\Entity\PartNameEntity;

final class PartNameRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        string $id
    ): null|PartNameEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : PartNameEntity::fromRaw($result);
    }

    public function findByValue(
        string $value
    ): null|PartNameEntity{
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table_name} 
            WHERE value = :value"
        );
        $stmt->execute([
            ":value" => $value
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : PartNameEntity::fromRaw($result);
    }

    public function add(
        int $part_id,
        string $value,
        bool $is_primary = false
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (part_id, value, is_primary) 
                VALUES (:part_id, :value, :is_primary)"
            );
            $stmt->execute([
                ':part_id' => $part_id,
                ':value' => $value,
                ':is_primary' => $is_primary
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateValue(
        int $id, 
        string $value
    ): bool {
        try{
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET value = :value 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':value' => $value,
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
    
    public function updateIsPrimary(
        int $id, 
        bool $is_primary
    ): bool {
        try{
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET is_primary = :is_primary 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':is_primary' => $is_primary,
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