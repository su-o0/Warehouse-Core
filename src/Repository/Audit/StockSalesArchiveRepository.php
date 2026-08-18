<?php
namespace WarehouseCore\Repository\Audit;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\VO\Audit\StockSalesArchiveVO;

final class StockSalesArchiveRepository extends Repository {
    public function hydrate(
        array $raw
    ): StockSalesArchiveVO {
        return StockSalesArchiveVO::fromRaw($raw);
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

    public function findByUserId(
        int $user_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE user_id = :user_id",
            [
                ':user_id' => $user_id
            ]
        );
    }

    public function findByCreatedUserId(
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
        int $stock_id,
        int $qty,
        int $user_id,
        int $created_by_user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    stock_id,
                    qty,
                    user_id,
                    created_by_user_id
                )
                VALUES
                (
                    :stock_id,
                    :qty,
                    :user_id,
                    :created_by_user_id
                )",
                [
                    ':stock_id' => $stock_id,
                    ':qty' => $qty,
                    ':user_id' => $user_id,
                    ':created_by_user_id' => $created_by_user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $stock_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE stock_id = :stock_id",
                [
                    ':stock_id' => $stock_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}