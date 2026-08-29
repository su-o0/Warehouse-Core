<?php
namespace WarehouseCore\Repository\Identity;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\Relationship\UserIdentityVO;

final class UserIdentityRepository extends Repository
{
    public function hydrate(
        array $raw
    ): UserIdentityVO {
        return UserIdentityVO::fromRaw($raw);
    }

    public function getByRecordId(
        int $record_id
    ): ?UserIdentityVO {
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

    public function findByProviderAndExternalId(
        string $provider,
        string $external_id
    ): ?UserIdentityVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE provider = :provider
            AND external_id = :external_id",
            [
                ':provider' => $provider,
                ':external_id' => $external_id
            ]
        );
    }

    public function findByProvider(
        string $provider
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE provider = :provider",
            [
                ':provider' => $provider
            ]
        );
    }

    public function findByExternalId(
        string $external_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE external_id = :external_id",
            [
                ':external_id' => $external_id
            ]
        );
    }

    public function add(
        int $user_id,
        string $provider,
        string $external_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    user_id,
                    provider,
                    external_id
                )
                VALUES
                (
                    :user_id,
                    :provider,
                    :external_id
                )",
                [
                    ':user_id' => $user_id,
                    ':provider' => $provider,
                    ':external_id' => $external_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateUserId(
        int $record_id,
        int $user_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET user_id = :user_id
                WHERE record_id = :record_id",
                [
                    ':record_id' => $record_id,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateProvider(
        int $record_id,
        string $provider
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET provider = :provider
                WHERE record_id = :record_id",
                [
                    ':record_id' => $record_id,
                    ':provider' => $provider
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateExternalId(
        int $record_id,
        string $external_id
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET external_id = :external_id
                WHERE record_id = :record_id",
                [
                    ':record_id' => $record_id,
                    ':external_id' => $external_id
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