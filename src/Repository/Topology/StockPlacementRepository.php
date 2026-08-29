<?php
namespace WarehouseCore\Repository\Topology;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\Relationship\StockPlacementVO;

final class StockPlacementRepository extends Repository {
    public function hydrate(
        array $raw
    ): StockPlacementVO {
        return StockPlacementVO::fromRaw($raw);
    }

    public function getByStockId(
        int $stock_id
    ): ?StockPlacementVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE stock_id = :stock_id",
            [
                ':stock_id' => $stock_id
            ]
        );
    }

    public function findByZoneId(
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

    public function findByShelfId(
        int $shelf_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE shelf_id = :shelf_id",
            [
                ':shelf_id' => $shelf_id
            ]
        );
    }

    public function findByContainerId(
        int $container_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE container_id = :container_id",
            [
                ':container_id' => $container_id
            ]
        );
    }

    public function add(
        int $stock_id,
        ?int $zone_id = null,
        ?int $shelf_id = null,
        ?int $container_id = null
    ): void {
        try {
            $this->execute(
                "INSERT INTO {$this->table}
                (
                    zone_id,
                    shelf_id,
                    container_id,
                    stock_id
                )
                VALUES
                (
                    :zone_id,
                    :shelf_id,
                    :container_id,
                    :stock_id
                )",
                [
                    ':zone_id' => $zone_id,
                    ':shelf_id' => $shelf_id,
                    ':container_id' => $container_id,
                    ':stock_id' => $stock_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateZoneId(
        int $stock_id,
        ?int $zone_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET zone_id = :zone_id,
                    shelf_id = NULL,
                    container_id = NULL
                WHERE stock_id = :stock_id",
                [
                    ':zone_id' => $zone_id,
                    ':stock_id' => $stock_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }   
    }

    public function updateShelfId(
        int $stock_id,
        ?int $shelf_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET shelf_id = :shelf_id,
                    zone_id = NULL,
                    container_id = NULL
                WHERE stock_id = :stock_id",
                [
                    ':shelf_id' => $shelf_id,
                    ':stock_id' => $stock_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateContainerId(
        int $stock_id,
        ?int $container_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET container_id = :container_id,
                    zone_id = NULL,
                    shelf_id = NULL
                WHERE stock_id = :stock_id",
                [
                    ':container_id' => $container_id,
                    ':stock_id' => $stock_id
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