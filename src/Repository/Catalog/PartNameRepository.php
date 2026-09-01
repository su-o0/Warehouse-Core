<?php
declare(strict_types=1);

namespace WarehouseCore\Repository\Catalog;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\PartNameVO;

final class PartNameRepository extends Repository {
    public function hydrate(
        array $raw
    ): PartNameVO {
        return PartNameVO::fromRaw($raw);
    }

    public function findByRecordId(
        int $record_id
    ): ?PartNameVO {
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

    public function findByPartIdAndValue(
        int $part_id,
        string $value
    ): ?PartNameVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE part_id = :part_id
            AND value = :value",
            [
                ':part_id' => $part_id,
                ':value' => $value
            ]
        );
    }

    public function findPrimaryByPartId(
        int $part_id
    ): ?PartNameVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE part_id = :part_id
            AND is_primary = TRUE",
            [
                ':part_id' => $part_id
            ]
        );
    }

    public function findByValue(
        string $value
    ): ?PartNameVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE value = :value",
            [
                ':value' => $value
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
        string $value,
        bool $is_primary,
        int $user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    part_id,
                    value,
                    is_primary,
                    created_by_user_id
                )
                VALUES
                (
                    :part_id,
                    :value,
                    :is_primary,
                    :user_id
                )",
                [
                    ':part_id' => $part_id,
                    ':value' => $value,
                    ':is_primary' => $is_primary ? 1 : 0,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePrimary(
        int $record_id,
        bool $is_primary
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET is_primary = :is_primary
                WHERE record_id = :record_id",
                [
                    ':record_id' => $record_id,
                    ':is_primary' => $is_primary ? 1 : 0
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