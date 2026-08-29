<?php
namespace WarehouseCore\Repository\Inventory;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\Entity\ItemEntity;

final class ItemRepository extends Repository {
    public function hydrate(
        array $raw
    ): ItemEntity {
        return ItemEntity::fromRaw($raw);
    }

    public function getById(
        int $id
    ): ?ItemEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE id = :id",
            [
                ':id' => $id
            ]
        );
    }

    public function findByPhysicalTagId(
        int $physical_tag_id
    ): ?ItemEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE physical_tag_id = :physical_tag_id",
            [
                ':physical_tag_id' => $physical_tag_id
            ]
        );
    }

    public function findByPartId(
        int $part_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE part_id = :part_id",
            [
                ':part_id' => $part_id
            ]
        );
    }

    public function findByVehicleId(
        int $vehicle_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE vehicle_id = :vehicle_id",
            [
                ':vehicle_id' => $vehicle_id
            ]
        );
    }

    public function findByOwnerId(
        int $owner_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE owner_id = :owner_id",
            [
                ':owner_id' => $owner_id
            ]
        );
    }

    public function findByStatus(
        string $status
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE status = :status",
            [
                ':status' => $status
            ]
        );
    }

    public function findByCondition(
        string $condition
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE condition_level = :condition",
            [
                ':condition' => $condition
            ]
        );
    }

    public function findByCreatedByUserId(
        int $user_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE created_by_user_id = :user_id",
            [
                ':user_id' => $user_id
            ]
        );
    }

    public function add(
        int $user_id,
        ?int $physical_tag_id = null,
        ?int $part_id = null,
        ?int $vehicle_id = null,
        ?int $owner_id = null,
        ?string $condition = null,
        ?string $condition_note = null
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    physical_tag_id,
                    part_id,
                    vehicle_id,
                    owner_id,
                    condition_level,
                    condition_note,
                    created_by_user_id
                )
                VALUES
                (
                    :physical_tag_id,
                    :part_id,
                    :vehicle_id,
                    :owner_id,
                    :condition,
                    :condition_note,
                    :user_id
                )",
                [
                    ':physical_tag_id' => $physical_tag_id,
                    ':part_id' => $part_id,
                    ':vehicle_id' => $vehicle_id,
                    ':owner_id' => $owner_id,
                    ':condition' => $condition,
                    ':condition_note' => $condition_note,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePhysicalTagId(
        int $id,
        ?int $physical_tag_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET physical_tag_id = :physical_tag_id
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':physical_tag_id' => $physical_tag_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePartId(
        int $id,
        ?int $part_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET part_id = :part_id
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':part_id' => $part_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateVehicleId(
        int $id,
        ?int $vehicle_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET vehicle_id = :vehicle_id
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':vehicle_id' => $vehicle_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateOwnerId(
        int $id,
        ?int $owner_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET owner_id = :owner_id
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':owner_id' => $owner_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateStatus(
        int $id,
        string $status
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET status = :status
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':status' => $status
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateCondition(
        int $id,
        ?string $condition
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET condition_level = :condition
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':condition' => $condition
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateConditionNote(
        int $id,
        ?string $condition_note
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET condition_note = :condition_note
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':condition_note' => $condition_note
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE id = :id",
                [
                    ':id' => $id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}