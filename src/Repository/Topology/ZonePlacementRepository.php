<?php
namespace WarehouseCore\Repository\Topology;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\Relationship\ZonePlacementVO;

final class ZonePlacementRepository extends Repository {
    public function hydrate(
        array $raw
    ): ZonePlacementVO {
        return ZonePlacementVO::fromRaw($raw);
    }

    public function findByZoneId(
        int $zone_id
    ): ?ZonePlacementVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE zone_id = :zone_id",
            [
                ':zone_id' => $zone_id
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

    public function add(
        int $zone_id,
        int $area_id
    ): void {
        try {
            $this->execute(
                "INSERT INTO {$this->table}
                (
                    area_id,
                    zone_id
                )
                VALUES
                (
                    :area_id,
                    :zone_id
                )",
                [
                    ':area_id' => $area_id,
                    ':zone_id' => $zone_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
    public function updateAreaId(
        int $zone_id,
        int $area_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET area_id = :area_id
                WHERE zone_id = :zone_id",
                [
                    ':area_id' => $area_id,
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