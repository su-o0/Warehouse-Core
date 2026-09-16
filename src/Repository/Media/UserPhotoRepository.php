<?php
namespace WarehouseCore\Repository\Media;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\PhotoVO;

final class UserPhotoRepository extends Repository {
    public function hydrate(
        array $raw
    ): PhotoVO {
        return PhotoVO::fromUserRaw($raw);
    }

    public function getByItemId(
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

    public function getByStoredFileId(
        int $stored_file_id
    ): ?PhotoVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE stored_file_id = :stored_file_id",
            [
                ':stored_file_id' => $stored_file_id
            ]
        );
    }

    public function add(
        int $user_id,
        int $stored_file_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    user_id,
                    stored_file_id
                )
                VALUES
                (
                    :user_id,
                    :stored_file_id
                )",
                [
                    ':user_id' => $user_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $user_id,
        int $stored_file_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE user_id = :user_id
                AND stored_file_id = :stored_file_id",
                [
                    ':user_id' => $user_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}