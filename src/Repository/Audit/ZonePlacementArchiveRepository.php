<?php
namespace WarehouseCore\Repository\Audit;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\Audit\ContainerPlacementArchiveVO;

final class ZonePlacementArchiveRepository extends Repository {
    public function hydrate(
        array $raw
    ): ContainerPlacementArchiveVO {
        return ContainerPlacementArchiveVO::fromRaw($raw);
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
        int $zone_id,
        int $to_area_id,
        int $user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    zone_id,
                    to_area_id,
                    created_by_user_id
                )
                VALUES
                (
                    :zone_id,
                    :to_area_id,
                    :user_id
                )",
                [
                    ':zone_id' => $zone_id,
                    ':to_area_id' => $to_area_id,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}