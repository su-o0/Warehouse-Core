<?php
namespace WarehouseCore\Repository\Catalog;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\Entity\VehicleEntity;

final class VehicleRepository extends Repository
{
    public function hydrate(
        array $raw
    ): VehicleEntity {
        return VehicleEntity::fromRaw($raw);
    }

    public function getById(
        int $id
    ): ?VehicleEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE id = :id",
            [
                ':id' => $id
            ]
        );
    }

    public function findByVin(
        string $vin
    ): ?VehicleEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE vin = :vin",
            [
                ':vin' => $vin
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
        int $user_id,
        string $vin
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    vin,
                    created_by_user_id
                )
                VALUES
                (
                    :vin,
                    :user_id
                )",
                [
                    ':vin' => $vin,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateVin(
        int $id,
        string $vin
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET vin = :vin
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':vin' => $vin
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