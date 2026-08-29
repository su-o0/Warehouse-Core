<?php
namespace WarehouseCore\Repository\Inventory;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\Entity\StockEntity;

final class StockRepository extends Repository {
    public function hydrate(
        array $raw
    ): StockEntity {
        return StockEntity::fromRaw($raw);
    }

    public function getById(
        int $id
    ): ?StockEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE id = :id",
            [
                ':id' => $id
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

    public function findByCreaterUserId(
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
        ?int $part_id = null,
        int $qty = 0
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    part_id,
                    qty,
                    created_by_user_id
                )
                VALUES
                (
                    :part_id,
                    :qty,
                    :user_id
                )",
                [
                    ':part_id' => $part_id,
                    ':qty' => $qty,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePartId(
        int $id,
        int $part_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET part_id = :part_id
                WHERE id = :id",
                [
                    ':part_id' => $part_id,
                    ':id' => $id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateQty(
        int $id,
        int $qty
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET qty = :qty
                WHERE id = :id",
                [
                    ':qty' => $qty,
                    ':id' => $id
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
                    ':status' => $status,
                    ':id' => $id
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