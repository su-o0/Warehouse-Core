<?php
namespace WarehouseCore\Repository\Processing;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\ContainerProcessingStepVO;

final class ContainerProcessingStepRepository extends Repository {
    public function hydrate(
        array $raw
    ): ContainerProcessingStepVO {
        return ContainerProcessingStepVO::fromRaw($raw);
    }

    public function findByRecordId(
        int $record_id
    ): ?ContainerProcessingStepVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE record_id = :record_id",
            [
                ':record_id' => $record_id
            ]
        );
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

    public function findByContainerIdAndStage(
        int $container_id,
        string $stage
    ): ?ContainerProcessingStepVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE container_id = :container_id
            AND stage = :stage",
            [
                ':container_id' => $container_id,
                ':stage' => $stage
            ]
        );
    }

    public function add(
        int $container_id,
        string $stage
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    container_id,
                    stage
                )
                VALUES
                (
                    :container_id,
                    :stage
                )",
                [
                    ':container_id' => $container_id,
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