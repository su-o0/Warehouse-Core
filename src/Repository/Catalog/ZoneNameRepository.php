<?php
namespace WarehouseCore\Repository\Catalog;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\VO\ZoneNameVO;

final class ZoneNameRepository extends Repository {
    public function hydrate(
        array $raw
    ): ZoneNameVO {
        return ZoneNameVO::fromRaw($raw);
    }

    public function getByZoneId(
        int $zone_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE zone_id = :zone_id",
            [
                ':zone_id' => $zone_id
            ]
        );
    }

    public function getPrimaryByZoneId(
        int $zone_id
    ): ?ZoneNameVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE zone_id = :zone_id
            AND is_primary = TRUE",
            [
                ':zone_id' => $zone_id
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
        int $zone_id,
        string $value,
        bool $is_primary,
        int $user_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    zone_id,
                    value,
                    is_primary,
                    created_by_user_id
                )
                VALUES
                (
                    :zone_id,
                    :value,
                    :is_primary,
                    :user_id
                )",
                [
                    ':zone_id' => $zone_id,
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
        int $zone_id,
        string $value,
        string $new_value
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET value = :new_value
                WHERE zone_id = :zone_id
                AND value = :value",
                [
                    ':zone_id' => $zone_id,
                    ':value' => $value,
                    ':new_value' => $new_value
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePrimary(
        int $zone_id,
        string $value,
        bool $is_primary
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET is_primary = :is_primary
                WHERE zone_id = :zone_id
                AND value = :value",
                [
                    ':zone_id' => $zone_id,
                    ':value' => $value,
                    ':is_primary' => $is_primary ? 1 : 0
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $zone_id,
        string $value
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE zone_id = :zone_id
                AND value = :value",
                [
                    ':zone_id' => $zone_id,
                    ':value' => $value
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}