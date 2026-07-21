<?php
namespace WarehouseCore\Repository\Inventory;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\ItemEntity;

final class ItemRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name) {
    }

    public function getById(
        int $id
    ): null|ItemEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : ItemEntity::fromRaw($result);
    }

    public function findByPhysicalTagId(
        int $physical_tag_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE physical_tag_id = :physical_tag_id"
        );
        $stmt->execute([
            ":physical_tag_id" => $physical_tag_id
        ]);
        return array_map(fn($row) => ItemEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByPartId(
        int $part_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE part_id = :part_id"
        );
        $stmt->execute([
            ":part_id" => $part_id
        ]);
        return array_map(fn($row) => ItemEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByVehicleId(
        int $vehicle_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE vehicle_id = :vehicle_id"
        );
        $stmt->execute([
            ":vehicle_id" => $vehicle_id
        ]);
        return array_map(fn($row) => ItemEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByOwnerId(
        int $owner_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE owner_id = :owner_id"
        );
        $stmt->execute([
            ":owner_id" => $owner_id
        ]);
        return array_map(fn($row) => ItemEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByStatus(
        string $status
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE status = :status"
        );
        $stmt->execute([
            ":status" => $status
        ]);
        return array_map(fn($row) => ItemEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByCondition(
        string $condition
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE condition_level = :condition"
        );
        $stmt->execute([
            ":condition" => $condition
        ]);
        return array_map(fn($row) => ItemEntity::fromRaw($row), $stmt->fetchAll());
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
        return array_map(fn($row) => ItemEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function add(
        int $user_id,
        int $physical_tag_id, 
        ?int $owner_id = null,
        ?int $vehicle_id = null,
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (physical_tag_id, vehicle_id, owner_id, created_by_user_id) 
                VALUES (:physical_tag_id, :vehicle_id, :owner_id, :user_id)"    
            );
            $stmt->execute([
                ':physical_tag_id' => $physical_tag_id,
                ':vehicle_id' => $vehicle_id,
                ':owner_id' => $owner_id,
                ':user_id' => $user_id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePhysicalTagId(
        int $id, 
        int $physical_tag_id
    ): bool {
        try {
            $stmt = $this->db->prepare( 
                "UPDATE {$this->table_name} 
                SET physical_tag_id = :physical_tag_id 
                WHERE id = :id"
            );
            return $stmt->execute([
                ":id" => $id,
                ":physical_tag_id" => $physical_tag_id
            ]);
        }catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePartId(
        int $id, 
        int $part_id
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET part_id = :part_id
                WHERE id = :id"
            );
            return $stmt->execute([
                ':part_id' => $part_id,
                ':id' => $id,
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateVehicleId(
        int $id, 
        int $vehicle_id
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET vehicle_id = :vehicle_id
                WHERE id = :id"
            );
            return $stmt->execute([
                ':vehicle_id' => $vehicle_id,
                ':id' => $id,
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateStatus(
        int $id, 
        string $status
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET status = :status
                WHERE id = :id"
            );
            return $stmt->execute([
                ':status' => $status,
                ':id' => $id,
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateCondition(
        int $id, 
        string $condition
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET condition = :condition
                WHERE id = :id"
            );
            return $stmt->execute([
                ':condition' => $condition,
                ':id' => $id,
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateConditionNote(
        int $id, 
        string $condition_note
    ): bool {
        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET condition_note = :condition_note
                WHERE id = :id"
            );
            return $stmt->execute([
                ':condition_note' => $condition_note,
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