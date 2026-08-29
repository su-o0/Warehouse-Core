<?php
namespace WarehouseCore\Repository\Audit;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\Audit\ContainerPlacementArchiveVO;

final class ContainerPlacementArchiveRepository extends Repository {
    public function hydrate(
        array $raw
    ): ContainerPlacementArchiveVO {
        return ContainerPlacementArchiveVO::fromRaw($raw);
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
        int $container_id,
        ?int $to_zone_id,
        ?int $to_shelf_id,
        int $user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    container_id,
                    to_zone_id,
                    to_shelf_id,
                    created_by_user_id
                )
                VALUES
                (
                    :container_id,
                    :to_zone_id,
                    :to_shelf_id,
                    :user_id
                )",
                [
                    ':container_id' => $container_id,
                    ':to_zone_id' => $to_zone_id,
                    ':to_shelf_id' => $to_shelf_id,
                    ':user_id' => $user_id
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