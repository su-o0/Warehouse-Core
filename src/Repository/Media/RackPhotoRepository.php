<?php
namespace WarehouseCore\Repository\Media;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\PhotoVO;

final class RackPhotoRepository extends Repository {
    public function hydrate(
        array $raw
    ): PhotoVO {
        return PhotoVO::fromRackRaw($raw);
    }

    public function getByRackId(
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
        int $rack_id,
        int $stored_file_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    rack_id,
                    stored_file_id
                )
                VALUES
                (
                    :rack_id,
                    :stored_file_id
                )",
                [
                    ':rack_id' => $rack_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $rack_id,
        int $stored_file_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE rack_id = :rack_id
                AND stored_file_id = :stored_file_id",
                [
                    ':rack_id' => $rack_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}