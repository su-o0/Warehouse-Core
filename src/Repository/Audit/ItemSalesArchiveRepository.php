<?php
namespace WarehouseCore\Repository\Audit;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\Audit\ItemSalesArchiveVO;

final class ItemSalesArchiveRepository extends Repository {
    public function hydrate(
        array $raw
    ): ItemSalesArchiveVO {
        return ItemSalesArchiveVO::fromRaw($raw);
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
        int $item_id,
        int $user_id,
        int $created_by_user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    item_id,
                    user_id,
                    created_by_user_id
                )
                VALUES
                (
                    :item_id,
                    :user_id,
                    :created_by_user_id
                )",
                [
                    ':item_id' => $item_id,
                    ':user_id' => $user_id,
                    ':created_by_user_id' => $created_by_user_id
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