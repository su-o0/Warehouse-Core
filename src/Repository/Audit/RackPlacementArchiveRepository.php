<?php
namespace WarehouseCore\Repository\Audit;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\Audit\RackPlacementArchiveVO;

final class RackPlacementArchiveRepository extends Repository {
    public function hydrate(
        array $raw
    ): RackPlacementArchiveVO {
        return RackPlacementArchiveVO::fromRaw($raw);
    }

    public function findByRackId(
        int $rack_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE rack_id = :rack_id",
            [
                ':rack_id' => $rack_id
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
        int $rack_id,
        ?int $to_area_id,
        ?int $to_zone_id,
        int $user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    rack_id,
                    to_area_id,
                    to_zone_id,
                    created_by_user_id
                )
                VALUES
                (
                    :rack_id,
                    :to_area_id,
                    :to_zone_id,
                    :user_id
                )",
                [
                    ':rack_id' => $rack_id,
                    ':to_area_id' => $to_area_id,
                    ':to_zone_id' => $to_zone_id,
                    ':user_id' => $user_id
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