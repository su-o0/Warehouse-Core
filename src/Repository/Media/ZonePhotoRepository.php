<?php
namespace WarehouseCore\Repository\Media;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\PhotoVO;

final class ZonePhotoRepository extends Repository {
    public function hydrate(
        array $raw
    ): PhotoVO {
        return PhotoVO::fromZoneRaw($raw);
    }

    public function getByItemId(
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
        int $zone_id,
        int $stored_file_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    zone_id,
                    stored_file_id
                )
                VALUES
                (
                    :zone_id,
                    :stored_file_id
                )",
                [
                    ':zone_id' => $zone_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $zone_id,
        int $stored_file_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE zone_id = :zone_id
                AND stored_file_id = :stored_file_id",
                [
                    ':zone_id' => $zone_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}