<?php
namespace WarehouseCore\Repository\Inventory;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\Entity\ContainerEntity;

final class ContainerRepository extends Repository {
    public function hydrate(
        array $raw
    ): ContainerEntity {
        return ContainerEntity::fromRaw($raw);
    }

    public function getById(
        int $id
    ): ?ContainerEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE id = :id",
            [
                ':id' => $id
            ]
        );
    }

    public function findByType(
        string $type
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE type = :type",
            [
                ':type' => $type
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
        string $type
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    type,
                    created_by_user_id
                )
                VALUES
                (
                    :type,
                    :user_id
                )",
                [
                    ':type' => $type,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateType(
        int $id,
        string $type
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET type = :type
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':type' => $type
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