<?php
namespace WarehouseCore\Repository\Media;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\VideoVO;

final class StockVideoRepository extends Repository {
    public function hydrate(
        array $raw
    ): VideoVO {
        return VideoVO::fromStockRaw($raw);
    }

    public function findByStockId(
        int $stock_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE stock_id = :stock_id",
            [
                ':stock_id' => $stock_id
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
        int $stock_id,
        int $stored_file_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    stock_id,
                    stored_file_id
                )
                VALUES
                (
                    :stock_id,
                    :stored_file_id
                )",
                [
                    ':stock_id' => $stock_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $stock_id,
        int $stored_file_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE stock_id = :stock_id
                AND stored_file_id = :stored_file_id",
                [
                    ':stock_id' => $stock_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}