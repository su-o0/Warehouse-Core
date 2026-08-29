<?php
namespace WarehouseCore\Repository\Topology;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\Relationship\RackPlacementVO;

final class RackPlacementRepository extends Repository {
    public function hydrate(
        array $raw
    ): RackPlacementVO {
        return RackPlacementVO::fromRaw($raw);
    }

    public function getByRackId(
        int $rack_id
    ): ?RackPlacementVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE rack_id = :rack_id",
            [
                ':rack_id' => $rack_id
            ]
        );
    }

    public function findByAreaId(
        int $area_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE area_id = :area_id",
            [
                ':area_id' => $area_id
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

    public function add(
        int $rack_id,
        ?int $area_id = null,
        ?int $zone_id = null
    ): void {
        try {
            $this->execute(
                "INSERT INTO {$this->table}
                (
                    area_id,
                    zone_id,
                    rack_id
                )
                VALUES
                (
                    :area_id,
                    :zone_id,
                    :rack_id
                )",
                [
                    ':area_id' => $area_id,
                    ':zone_id' => $zone_id,
                    ':rack_id' => $rack_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateAreaId(
        int $rack_id,
        ?int $area_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET area_id = :area_id,
                    zone_id = NULL
                WHERE rack_id = :rack_id",
                [
                    ':area_id' => $area_id,
                    ':rack_id' => $rack_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateZoneId(
        int $rack_id,
        ?int $zone_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET zone_id = :zone_id,
                    area_id = NULL
                WHERE rack_id = :rack_id",
                [
                    ':zone_id' => $zone_id,
                    ':rack_id' => $rack_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $rack_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE rack_id = :rack_id",
                [
                    ':rack_id' => $rack_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}