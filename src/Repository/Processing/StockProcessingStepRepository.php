<?php
namespace WarehouseCore\Repository\Processing;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\StockProcessingStepVO;

final class StockProcessingStepRepository extends Repository {
    public function hydrate(
        array $raw
    ): StockProcessingStepVO {
        return StockProcessingStepVO::fromRaw($raw);
    }

    public function findByRecordId(
        int $record_id
    ): ?StockProcessingStepVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE record_id = :record_id",
            [
                ':record_id' => $record_id
            ]
        );
    }

    public function findStockById(
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

    public function findByStage(
        string $stage
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE stage = :stage",
            [
                ':stage' => $stage
            ]
        );
    }

    public function findByStockIdAndStage(
        int $stock_id,
        string $stage
    ): ?StockProcessingStepVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE stock_id = :stock_id
            AND stage = :stage",
            [
                ':stock_id' => $stock_id,
                ':stage' => $stage
            ]
        );
    }

    public function add(
        int $stock_id,
        string $stage
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    stock_id,
                    stage
                )
                VALUES
                (
                    :stock_id,
                    :stage
                )",
                [
                    ':stock_id' => $stock_id,
                    ':stage' => $stage
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $record_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE record_id = :record_id",
                [
                    ':record_id' => $record_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}