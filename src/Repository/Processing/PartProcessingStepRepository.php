<?php
namespace WarehouseCore\Repository\Processing;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\PartProcessingStepVO;

final class PartProcessingStepRepository extends Repository {
    public function hydrate(
        array $raw
    ): PartProcessingStepVO {
        return PartProcessingStepVO::fromRaw($raw);
    }

    public function findByRecordId(
        int $record_id
    ): ?PartProcessingStepVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE record_id = :record_id",
            [
                ':record_id' => $record_id
            ]
        );
    }

    public function findByPartId(
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
    ): ?PartProcessingStepVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE part_id = :part_id
            AND stage = :stage",
            [
                ':part_id' => $part_id,
                ':stage' => $stage
            ]
        );
    }

    public function add(
        int $part_id,
        string $stage
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    part_id,
                    stage
                )
                VALUES
                (
                    :part_id,
                    :stage
                )",
                [
                    ':part_id' => $part_id,
                    ':stage' => $stage
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