<?php
namespace WarehouseCore\Repository\Inventory;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\Entity\RackEntity;

final class RackRepository extends Repository {
    public function hydrate(
        array $raw
    ): RackEntity {
        return RackEntity::fromRaw($raw);
    }

    public function getById(
        int $id
    ): ?RackEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE id = :id",
            [
                ':id' => $id
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

    public function add(
        int $id,
        int $created_by_user_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    id,
                    created_by_user_id
                )
                VALUES
                (
                    :id,
                    :created_by_user_id
                )",
                [
                    ':id' => $id,
                    ':created_by_user_id' => $created_by_user_id
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