<?php
namespace WarehouseCore\Repository\Topology;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\Relationship\ContainerPlacementVO;

final class ContainerPlacementRepository extends Repository {
    public function hydrate(
        array $raw
    ): ContainerPlacementVO {
        return ContainerPlacementVO::fromRaw($raw);
    }

    public function getByContainerId(
        int $container_id
    ): ?ContainerPlacementVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE container_id = :container_id",
            [
                ':container_id' => $container_id
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

    public function add(
        int $container_id,
        ?int $zone_id = null,
        ?int $shelf_id = null
    ): void {
        try {
            $this->execute(
                "INSERT INTO {$this->table}
                (
                    zone_id,
                    shelf_id,
                    container_id
                )
                VALUES
                (
                    :zone_id,
                    :shelf_id,
                    :container_id
                )",
                [
                    ':zone_id' => $zone_id,
                    ':shelf_id' => $shelf_id,
                    ':container_id' => $container_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateZoneId(
        int $container_id,
        ?int $zone_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET zone_id = :zone_id,
                    shelf_id = NULL
                WHERE container_id = :container_id",
                [
                    ':zone_id' => $zone_id,
                    ':container_id' => $container_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateShelfId(
        int $container_id,
        ?int $shelf_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET shelf_id = :shelf_id,
                    zone_id = NULL
                WHERE container_id = :container_id",
                [
                    ':shelf_id' => $shelf_id,
                    ':container_id' => $container_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $container_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE container_id = :container_id",
                [
                    ':container_id' => $container_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}