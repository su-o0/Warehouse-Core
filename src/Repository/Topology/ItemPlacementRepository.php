<?php
namespace WarehouseCore\Repository\Topology;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\Relationship\ItemPlacementVO;

final class ItemPlacementRepository extends Repository {    
    public function hydrate(
        array $raw
    ): ItemPlacementVO {
        return ItemPlacementVO::fromRaw($raw);
    }

    public function getByItemId(
        int $item_id
    ): ?ItemPlacementVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE item_id = :item_id",
            [
                ':item_id' => $item_id
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
        int $item_id,
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
                    item_id
                )
                VALUES
                (
                    :zone_id,
                    :shelf_id,
                    :container_id,
                    :item_id
                )",
                [
                    ':zone_id' => $zone_id,
                    ':shelf_id' => $shelf_id,
                    ':container_id' => $container_id,
                    ':item_id' => $item_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateZoneId(
        int $item_id,
        ?int $zone_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET zone_id = :zone_id,
                    shelf_id = NULL,
                    container_id = NULL
                WHERE item_id = :item_id",
                [
                    ':zone_id' => $zone_id,
                    ':item_id' => $item_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateShelfId(
        int $item_id,
        ?int $shelf_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET shelf_id = :shelf_id,
                    zone_id = NULL,
                    container_id = NULL
                WHERE item_id = :item_id",
                [
                    ':shelf_id' => $shelf_id,
                    ':item_id' => $item_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateContainerId(
        int $item_id,
        ?int $container_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET container_id = :container_id,
                    zone_id = NULL,
                    shelf_id = NULL
                WHERE item_id = :item_id",
                [
                    ':container_id' => $container_id,
                    ':item_id' => $item_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $item_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE item_id = :item_id",
                [
                    ':item_id' => $item_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}