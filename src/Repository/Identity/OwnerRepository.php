<?php
namespace WarehouseCore\Repository\Identity;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\Entity\OwnerEntity;

final class OwnerRepository extends Repository {
    public function hydrate(
        array $raw
    ): OwnerEntity {
        return OwnerEntity::fromRaw($raw);
    }

    public function getById(
        int $id
    ): ?OwnerEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE id = :id",
            [
                ':id' => $id
            ]
        );
    }

    public function findByUserId(
        int $user_id
    ): ?OwnerEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE user_id = :user_id",
            [
                ':user_id' => $user_id
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
        int $user_id,
        int $created_by_user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    user_id,
                    created_by_user_id
                )
                VALUES
                (
                    :user_id,
                    :created_by_user_id
                )",
                [
                    ':user_id' => $user_id,
                    ':created_by_user_id' => $created_by_user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateUserId(
        int $id,
        int $user_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET user_id = :user_id
                WHERE id = :id",
                [
                    ':id' => $id,
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

    public function updateCreatedByUserId(
        int $id,
        int $user_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET created_by_user_id = :user_id
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':user_id' => $user_id
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