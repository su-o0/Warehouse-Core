<?php
namespace WarehouseCore\Repository\Audit;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\VO\Audit\ItemMovementArchiveVO;

final class ItemMovementArchiveRepository extends Repository {
    public function hydrate(
        array $raw
    ): ItemMovementArchiveVO {
        return ItemMovementArchiveVO::fromRaw($raw);
    }

    public function findByItemId(
        int $item_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE item_id = :item_id",
            [
                ':item_id' => $item_id
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
        int $item_id,
        ?int $from_zone_id,
        ?int $from_shelf_id,
        ?int $from_container_id,
        ?int $to_zone_id,
        ?int $to_shelf_id,
        ?int $to_container_id,
        int $user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    item_id,
                    from_zone_id,
                    from_shelf_id,
                    from_container_id,
                    to_zone_id,
                    to_shelf_id,
                    to_container_id,
                    created_by_user_id
                )
                VALUES
                (
                    :item_id,
                    :from_zone_id,
                    :from_shelf_id,
                    :from_container_id,
                    :to_zone_id,
                    :to_shelf_id,
                    :to_container_id,
                    :user_id
                )",
                [
                    ':item_id' => $item_id,
                    ':from_zone_id' => $from_zone_id,
                    ':from_shelf_id' => $from_shelf_id,
                    ':from_container_id' => $from_container_id,
                    ':to_zone_id' => $to_zone_id,
                    ':to_shelf_id' => $to_shelf_id,
                    ':to_container_id' => $to_container_id,
                    ':user_id' => $user_id
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