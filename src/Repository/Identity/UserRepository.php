<?php
namespace WarehouseCore\Repository\Identity;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\Entity\UserEntity;

final class UserRepository extends Repository {
    public function hydrate(
        array $raw
    ): UserEntity {
        return UserEntity::fromRaw($raw);
    }
    
    public function list(
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}",
            []
        );
    }

    public function getById(
        int $id
    ): ?UserEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE id = :id",
            [
                ':id' => $id
            ]
        );
    }

    public function findByRole(
        string $role
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE role = :role",
            [
                ':role' => $role
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
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table} ()
                VALUES ()",
                [ ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateName(
        int $id,
        string $name
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET name = :name
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':name' => $name
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateRole(
        int $id,
        string $role
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET role = :role
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':role' => $role
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