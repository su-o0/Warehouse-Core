<?php
namespace WarehouseCore\Repository\Processing;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\VO\PartProcessingStepVO;

final class PartProcessingStepRepository extends Repository {
    public function hydrate(
        array $raw
    ): PartProcessingStepVO {
        return PartProcessingStepVO::fromRaw($raw);
    }

    public function getByPartId(
        int $part_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE part_id = :part_id",
            [
                ':part_id' => $part_id
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

    public function findByPartIdAndStage(
        int $part_id,
        string $stage
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE part_id = :part_id
            AND stage = :stage",
            [
                ':part_id' => $part_id,
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
        int $part_id,
        string $stage,
        ?string $metadata,
        int $user_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    part_id,
                    stage,
                    metadata,
                    created_by_user_id
                )
                VALUES
                (
                    :part_id,
                    :stage,
                    :metadata,
                    :user_id
                )",
                [
                    ':part_id' => $part_id,
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
        int $part_id,
        string $stage,
        string $new_stage
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET stage = :new_stage
                WHERE part_id = :part_id
                AND stage = :stage",
                [
                    ':part_id' => $part_id,
                    ':stage' => $stage,
                    ':new_stage' => $new_stage
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateMetadata(
        int $part_id,
        string $stage,
        ?string $metadata
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET metadata = :metadata
                WHERE part_id = :part_id
                AND stage = :stage",
                [
                    ':part_id' => $part_id,
                    ':stage' => $stage,
                    ':metadata' => $metadata
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $part_id,
        string $stage
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE part_id = :part_id
                AND stage = :stage",
                [
                    ':part_id' => $part_id,
                    ':stage' => $stage
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}