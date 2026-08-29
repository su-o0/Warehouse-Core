<?php
namespace WarehouseCore\Repository\Processing;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\ItemProcessingStepVO;

final class ItemProcessingStepRepository extends Repository {
    public function hydrate(
        array $raw
    ): ItemProcessingStepVO {
        return ItemProcessingStepVO::fromRaw($raw);
    }

    public function getByItemId(
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

    public function findByStage(
        string $stage
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE stage = :stage",
            [
                ':stage' => $stage
            ]
        );
    }

    public function findByItemIdAndStage(
        int $item_id,
        string $stage
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE item_id = :item_id
            AND stage = :stage",
            [
                ':item_id' => $item_id,
                ':stage' => $stage
            ]
        );
    }

    public function findByCreaterUserId(
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
        string $stage,
        ?string $metadata,
        int $user_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    item_id,
                    stage,
                    metadata,
                    created_by_user_id
                )
                VALUES
                (
                    :item_id,
                    :stage,
                    :metadata,
                    :user_id
                )",
                [
                    ':item_id' => $item_id,
                    ':stage' => $stage,
                    ':metadata' => $metadata,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateStage(
        int $item_id,
        string $stage,
        string $new_stage
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET stage = :new_stage
                WHERE item_id = :item_id
                AND stage = :stage",
                [
                    ':item_id' => $item_id,
                    ':stage' => $stage,
                    ':new_stage' => $new_stage
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateMetadata(
        int $item_id,
        string $stage,
        ?string $metadata
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET metadata = :metadata
                WHERE item_id = :item_id
                AND stage = :stage",
                [
                    ':item_id' => $item_id,
                    ':stage' => $stage,
                    ':metadata' => $metadata
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $item_id,
        string $stage
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE item_id = :item_id
                AND stage = :stage",
                [
                    ':item_id' => $item_id,
                    ':stage' => $stage
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}