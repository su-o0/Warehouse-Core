<?php
declare(strict_types=1);

namespace WarehouseCore\Repository\Catalog;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Exception\PdoExceptionMapper;
use WarehouseCore\Payload\VO\RackNameVO;

final class RackNameRepository extends Repository {
    public function hydrate(
        array $raw
    ): RackNameVO {
        return RackNameVO::fromRaw($raw);
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

    public function findPrimaryByRackId(
        int $rack_id
    ): ?RackNameVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE rack_id = :rack_id
            AND is_primary = TRUE",
            [
                ':rack_id' => $rack_id
            ]
        );
    }

    public function add(
        int $rack_id,
        string $value,
        bool $is_primary,
        int $user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    rack_id,
                    value,
                    is_primary,
                    created_by_user_id
                )
                VALUES
                (
                    :rack_id,
                    :value,
                    :is_primary,
                    :user_id
                )",
                [
                    ':rack_id' => $rack_id,
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
        int $rack_id,
        string $value
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET value = :value
                WHERE rack_id = :rack_id",
                [
                    ':rack_id' => $rack_id,
                    ':value' => $value
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePrimary(
        int $rack_id,
        bool $is_primary
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET is_primary = :is_primary
                WHERE rack_id = :rack_id",
                [
                    ':rack_id' => $rack_id,
                    ':is_primary' => $is_primary ? 1 : 0
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $rack_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE rack_id = :rack_id",
                [
                    ':rack_id' => $rack_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}