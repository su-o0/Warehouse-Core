<?php
namespace WarehouseCore\Repository\Media;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\VideoVO;

final class ItemVideoRepository extends Repository {
    public function hydrate(
        array $raw
    ): VideoVO {
        return VideoVO::fromItemRaw($raw);
    }

    public function findByItemId(
        int $item_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE item_id = :item_id",
            [
                ':item_id' => $item_id
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
        int $item_id,
        int $stored_file_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    item_id,
                    stored_file_id
                )
                VALUES
                (
                    :item_id,
                    :stored_file_id
                )",
                [
                    ':item_id' => $item_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $item_id,
        int $stored_file_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE item_id = :item_id
                AND stored_file_id = :stored_file_id",
                [
                    ':item_id' => $item_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}