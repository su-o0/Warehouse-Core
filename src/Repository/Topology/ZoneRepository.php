<?php
namespace WarehouseCore\Repository\Topology;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Exception\PdoExceptionMapper;
use WarehouseCore\Payload\Entity\ZoneEntity;

final class ZoneRepository extends Repository {
    public function hydrate(
        array $raw
    ): ZoneEntity {
        return ZoneEntity::fromRaw($raw);
    }

    public function getById(
        int $id
    ): ?ZoneEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE id = :id",
            [
                ':id' => $id
            ]
        );
    }

    public function findByAreaId(
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

    public function findByCreatedByUserId(
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
        int $user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    area_id,
                    created_by_user_id
                )
                VALUES
                (
                    :area_id,
                    :user_id
                )",
                [
                    ':area_id' => $area_id,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateAreaId(
        int $id,
        int $area_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET area_id = :area_id
                WHERE id = :id",
                [
                    ':area_id' => $area_id,
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