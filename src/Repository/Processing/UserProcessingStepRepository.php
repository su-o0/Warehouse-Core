<?php
namespace WarehouseCore\Repository\Processing;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\UserProcessingStepVO;

final class UserProcessingStepRepository extends Repository {
    public function hydrate(
        array $raw
    ): UserProcessingStepVO {
        return UserProcessingStepVO::fromRaw($raw);
    }

    public function findByRecordId(
        int $record_id
    ): ?UserProcessingStepVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE record_id = :record_id",
            [
                ':record_id' => $record_id
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

    public function findByUserIdAndStage(
        int $user_id,
        string $stage
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE user_id = :user_id
            AND stage = :stage",
            [
                ':user_id' => $user_id,
                ':stage' => $stage
            ]
        );
    }

    public function add(
        int $user_id,
        string $stage
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    user_id,
                    stage
                )
                VALUES
                (
                    :user_id,
                    :stage
                )",
                [
                    ':user_id' => $user_id,
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