<?php
namespace WarehouseCore\Repository\Media;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\VideoVO;

final class PartVideoRepository extends Repository {
    public function hydrate(
        array $raw
    ): VideoVO {
        return VideoVO::fromPartRaw($raw);
    }

    public function getByPartId(
        int $part_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE part_id = :part_id",
            [
                ':part_id' => $part_id
            ]
        );
    }

    public function getByStoredFileId(
        int $stored_file_id
    ): ?VideoVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE stored_file_id = :stored_file_id",
            [
                ':stored_file_id' => $stored_file_id
            ]
        );
    }

    public function add(
        int $part_id,
        int $stored_file_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    part_id,
                    stored_file_id
                )
                VALUES
                (
                    :part_id,
                    :stored_file_id
                )",
                [
                    ':part_id' => $part_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $part_id,
        int $stored_file_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE part_id = :part_id
                AND stored_file_id = :stored_file_id",
                [
                    ':part_id' => $part_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}