<?php
namespace WarehouseCore\Repository\Catalog;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\VO\AreaNameVO;

final class AreaNameRepository extends Repository {
    public function hydrate(
        array $raw
    ): AreaNameVO {
        return AreaNameVO::fromRaw($raw);
    }

    public function getByAreaId(
        int $area_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE area_id = :area_id",
            [
                ':area_id' => $area_id
            ]
        );
    }

    public function getByAreaIdAndValue(
        int $area_id,
        string $value
    ): ?AreaNameVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE area_id = :area_id
            AND value = :value",
            [
                ':area_id' => $area_id,
                ':value' => $value
            ]
        );
    }

    public function getPrimaryByAreaId(
        int $area_id
    ): ?AreaNameVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE area_id = :area_id
            AND is_primary = TRUE",
            [
                ':area_id' => $area_id
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
        int $area_id,
        string $value,
        bool $is_primary,
        int $user_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    area_id,
                    value,
                    is_primary,
                    created_by_user_id
                )
                VALUES
                (
                    :area_id,
                    :value,
                    :is_primary,
                    :user_id
                )",
                [
                    ':area_id' => $area_id,
                    ':value' => $value,
                    ':is_primary' => $is_primary,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateValue(
        int $area_id,
        string $value,
        string $new_value
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET value = :new_value
                WHERE area_id = :area_id
                AND value = :value",
                [
                    ':area_id' => $area_id,
                    ':value' => $value,
                    ':new_value' => $new_value
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePrimary(
        int $area_id,
        string $value,
        bool $is_primary
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET is_primary = :is_primary
                WHERE area_id = :area_id
                AND value = :value",
                [
                    ':area_id' => $area_id,
                    ':value' => $value,
                    ':is_primary' => $is_primary
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $area_id,
        string $value
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE area_id = :area_id
                AND value = :value",
                [
                    ':area_id' => $area_id,
                    ':value' => $value
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}