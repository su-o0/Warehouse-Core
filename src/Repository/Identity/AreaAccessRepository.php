<?php
namespace WarehouseCore\Repository\Identity;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\Relationship\AreaAccessVO;

final class AreaAccessRepository extends Repository {
    public function hydrate(
        array $raw
    ): AreaAccessVO {
        return AreaAccessVO::fromRaw($raw);
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

    public function getByUserId(
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


    public function getByAreaIdAndUserId(
        int $area_id,
        int $user_id
    ): ?AreaAccessVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE area_id = :area_id",
            [
                ':area_id' => $area_id
            ]
        );
    }

    public function find(
        int $area_id,
        int $user_id
    ): ?AreaAccessVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE area_id = :area_id
            AND user_id = :user_id",
            [
                ':area_id' => $area_id,
                ':user_id' => $user_id
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
        int $area_id,
        int $user_id,
        int $created_by_user_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    area_id,
                    user_id,
                    created_by_user_id
                )
                VALUES
                (
                    :area_id,
                    :user_id,
                    :created_by_user_id
                )",
                [
                    ':area_id' => $area_id,
                    ':user_id' => $user_id,
                    ':created_by_user_id' => $created_by_user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $area_id,
        int $user_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE area_id = :area_id
                AND user_id = :user_id",
                [
                    ':area_id' => $area_id,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}