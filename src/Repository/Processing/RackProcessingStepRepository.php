<?php
namespace WarehouseCore\Repository\Processing;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\RackProcessingStepVO;

final class RackProcessingStepRepository extends Repository {
    public function hydrate(
        array $raw
    ): RackProcessingStepVO {
        return RackProcessingStepVO::fromRaw($raw);
    }

    public function findByRecordId(
        int $record_id
    ): ?RackProcessingStepVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE record_id = :record_id",
            [
                ':record_id' => $record_id
            ]
        );
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

    public function findByRackIdAndStage(
        int $rack_id,
        string $stage
    ): ?RackProcessingStepVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE rack_id = :rack_id
            AND stage = :stage",
            [
                ':rack_id' => $rack_id,
                ':stage' => $stage
            ]
        );
    }

    public function add(
        int $rack_id,
        string $stage
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    rack_id,
                    stage
                )
                VALUES
                (
                    :rack_id,
                    :stage
                )",
                [
                    ':rack_id' => $rack_id,
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