<?php
namespace WarehouseCore\Repository\Topology;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\Entity\ShelfEntity;

final class ShelfRepository extends Repository {
    public function hydrate(
        array $raw
    ): ShelfEntity {
        return ShelfEntity::fromRaw($raw);
    }

    public function getById(
        int $id
    ): ?ShelfEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE id = :id",
            [
                ':id' => $id
            ]
        );
    }

    public function countByRackId(
        int $rack_id
    ): int {
        $result = $this->fetchOne(
            "SELECT COUNT(*) as count FROM {$this->table}
            WHERE rack_id = :rack_id",
            [
                ':rack_id' => $rack_id
            ]
        );
    
        return (int)$result['count'];
    }

    public function findLastLevelByRackId(
        int $rack_id
    ): ?ShelfEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE rack_id = :rack_id
            ORDER BY shelf_level DESC LIMIT 1
            ",
            [
                ':rack_id' => $rack_id
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

    public function findByRackIdAndShelfLevel(
        int $rack_id,
        int $shelf_level
    ): ?ShelfEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE rack_id = :rack_id 
            AND shelf_level = :shelf_level",
            [
                ':rack_id' => $rack_id,
                ':shelf_level' => $shelf_level
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
        int $shelf_level,
        int $user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    rack_id,
                    shelf_level,
                    created_by_user_id
                )
                VALUES
                (
                    :rack_id,
                    :shelf_level,
                    :user_id
                )",
                [
                    ':rack_id' => $rack_id,
                    ':shelf_level' => $shelf_level,
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