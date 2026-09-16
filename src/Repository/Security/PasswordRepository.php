<?php
namespace WarehouseCore\Repository\Security;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;
use WarehouseCore\Payload\VO\PasswordVO;

final class PasswordRepository extends Repository
{
    public function hydrate(
        array $raw
    ): PasswordVO {
        return PasswordVO::fromRaw($raw);
    }

    public function findByUserIdentityRecordId(
        int $user_identity_record_id
    ): ?PasswordVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE user_identity_record_id = :user_identity_record_id",
            [
                ':user_identity_record_id' => $user_identity_record_id
            ]
        );
    }

    public function add(
        int $user_identity_record_id,
        string $hash
    ):int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table} (
                    user_identity_record_id,
                    hash
                )
                VALUES (
                    :user_identity_record_id,
                    :hash
                )",
                [ 
                    ':user_identity_record_id' => $user_identity_record_id,
                    ':hash' => $hash
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateHash(
        int $user_identity_record_id,
        string $hash
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET hash = :hash
                WHERE user_identity_record_id = :user_identity_record_id",
                [
                    ':user_identity_record_id' => $user_identity_record_id,
                    ':hash' => $hash
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $user_identity_record_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE user_identity_record_id = :user_identity_record_id",
                [
                    ':user_identity_record_id' => $user_identity_record_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}