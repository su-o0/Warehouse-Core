<?php
namespace WarehouseCore\Repository\Processing;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\ZoneProcessingStepVO;

final class ZoneProcessingStepRepository extends Repository {
    public function hydrate(
        array $raw
    ): ZoneProcessingStepVO {
        return ZoneProcessingStepVO::fromRaw($raw);
    }

    public function findByRecordId(
        int $record_id
    ): ?ZoneProcessingStepVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE record_id = :record_id",
            [
                ':record_id' => $record_id
            ]
        );
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

    public function findByZoneIdAndStage(
        int $zone_id,
        string $stage
    ): ?ZoneProcessingStepVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE zone_id = :zone_id
            AND stage = :stage",
            [
                ':zone_id' => $zone_id,
                ':stage' => $stage
            ]
        );
    }

    public function add(
        int $zone_id,
        string $stage
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    zone_id,
                    stage
                )
                VALUES
                (
                    :zone_id,
                    :stage
                )",
                [
                    ':zone_id' => $zone_id,
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