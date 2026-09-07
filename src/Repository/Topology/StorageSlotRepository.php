<?php
namespace WarehouseCore\Repository\Topology;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\Entity\ShelfEntity;
use WarehouseCore\Payload\Entity\StorageSlotEntity;

final class StorageSlotRepository extends Repository {
    public function hydrate(
        array $raw
    ): StorageSlotEntity {
        return StorageSlotEntity::fromRaw($raw);
    }

    public function getById(
        int $id
    ): ?StorageSlotEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE id = :id",
            [
                ':id' => $id
            ]
        );
    }

    public function findByRackId(
        int $rack_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE rack_id = :rack_id",
            [
                ':rack_id' => $rack_id
            ]
        );
    }

    public function findByRackIdAndSlotPosition(
        int $rack_id,
        int $slot_position
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE rack_id = :rack_id 
            AND slot_position = :slot_position",
            [
                ':rack_id' => $rack_id,
                ':slot_position' => $slot_position
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

    public function findByCreatedUserId(
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
        int $rack_id,
        int $slot_position,
        int $user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    rack_id,
                    slot_position,
                    created_by_user_id
                )
                VALUES
                (
                    :rack_id,
                    :slot_position,
                    :user_id
                )",
                [
                    ':rack_id' => $rack_id,
                    ':slot_position' => $slot_position,
                    ':user_id' => $user_id
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