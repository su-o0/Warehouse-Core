<?php
namespace WarehouseCore\Repository\Media;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\VO\VideoVO;

final class VehicleVideoRepository extends Repository {
    public function hydrate(
        array $raw
    ): VideoVO {
        return VideoVO::fromVehicleRaw($raw);
    }

    public function findByVehicleId(
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

    public function findByStoredFileId(
        int $stored_file_id
    ): array {
        return $this->entities(
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
    ): int {
        try {
            return $this->insert(
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