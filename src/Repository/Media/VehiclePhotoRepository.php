<?php
namespace WarehouseCore\Repository\Media;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\PhotoVO;

final class VehiclePhotoRepository extends Repository {
    public function hydrate(
        array $raw
    ): PhotoVO {
        return PhotoVO::fromVehicleRaw($raw);
    }

    public function getByVehicleId(
        int $vehicle_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE vehicle_id = :vehicle_id",
            [
                ':vehicle_id' => $vehicle_id
            ]
        );
    }

    public function getByStoredFileId(
        int $stored_file_id
    ): ?PhotoVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE stored_file_id = :stored_file_id",
            [
                ':stored_file_id' => $stored_file_id
            ]
        );
    }

    public function add(
        int $vehicle_id,
        int $stored_file_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    vehicle_id,
                    stored_file_id
                )
                VALUES
                (
                    :vehicle_id,
                    :stored_file_id
                )",
                [
                    ':vehicle_id' => $vehicle_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $vehicle_id,
        int $stored_file_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE vehicle_id = :vehicle_id
                AND stored_file_id = :stored_file_id",
                [
                    ':vehicle_id' => $vehicle_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}