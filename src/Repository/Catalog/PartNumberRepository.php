<?php
namespace WarehouseCore\Repository\Catalog;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\VO\PartNumberVO;

final class PartNumberRepository extends Repository {
    public function hydrate(
        array $raw
    ): PartNumberVO {
        return PartNumberVO::fromRaw($raw);
    }

    public function findByRecordId(
        int $record_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE record_id = :record_id",
            [
                ':record_id' => $record_id
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

    public function findPrimaryByPartId(
        int $part_id
    ): ?PartNumberVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE part_id = :part_id
            AND is_primary = TRUE",
            [
                ':part_id' => $part_id
            ]
        );
    }

    public function findByValue(
        string $value
    ): ?PartNumberVO {
        return $this->entity(
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
        int $part_id,
        string $value,
        bool $is_primary,
        int $user_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    part_id,
                    value,
                    is_primary,
                    created_by_user_id
                )
                VALUES
                (
                    :part_id,
                    :value,
                    :is_primary,
                    :user_id
                )",
                [
                    ':part_id' => $part_id,
                    ':value' => $value,
                    ':is_primary' => $is_primary ? 1 : 0,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateValue(
        int $part_id,
        string $value,
        string $new_value
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET value = :new_value
                WHERE part_id = :part_id
                AND value = :value",
                [
                    ':part_id' => $part_id,
                    ':value' => $value,
                    ':new_value' => $new_value
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePrimary(
        int $part_id,
        string $value,
        bool $is_primary
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET is_primary = :is_primary
                WHERE part_id = :part_id
                AND value = :value",
                [
                    ':part_id' => $part_id,
                    ':value' => $value,
                    ':is_primary' => $is_primary ? 1 : 0
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $part_id,
        string $value
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE part_id = :part_id
                AND value = :value",
                [
                    ':part_id' => $part_id,
                    ':value' => $value
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}