<?php
namespace WarehouseCore\Repository\Catalog;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\UserNameVO;

final class UserNameRepository extends Repository {
    public function hydrate(
        array $raw
    ): UserNameVO {
        return UserNameVO::fromRaw($raw);
    }

    public function findByRecordId(
        int $record_id
    ): ?UserNameVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE record_id = :record_id",
            [
                ':record_id' => $record_id
            ]
        );
    }

    public function findByUserId(
        int $user_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE user_id = :user_id",
            [
                ':user_id' => $user_id
            ]
        );
    }

    public function findByUserIdAndValue(
        int $user_id,
        string $value
    ): ?UserNameVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE user_id = :user_id
            AND value = :value",
            [
                ':user_id' => $user_id,
                ':value' => $value
            ]
        );
    }

    public function findPrimaryByUserId(
        int $user_id
    ): ?UserNameVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE user_id = :user_id
            AND is_primary = TRUE",
            [
                ':user_id' => $user_id
            ]
        );
    }

    public function findByValue(
        string $value
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE value = :value",
            [
                ':value' => $value
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
        string $value,
        bool $is_primary,
        int $created_by_user_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    user_id,
                    value,
                    is_primary,
                    created_by_user_id
                )
                VALUES
                (
                    :user_id,
                    :value,
                    :is_primary,
                    :created_by_user_id
                )",
                [
                    ':user_id' => $user_id,
                    ':value' => $value,
                    ':is_primary' => $is_primary ? 1 : 0,
                    ':created_by_user_id' => $created_by_user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePrimary(
        int $record_id,
        bool $is_primary
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET is_primary = :is_primary
                WHERE record_id = :record_id",
                [
                    ':record_id' => $record_id,
                    ':is_primary' => $is_primary ? 1 : 0
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $record_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE record_id = :record_id",
                [
                    ':record_id' => $record_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}