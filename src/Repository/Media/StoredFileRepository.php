<?php
namespace WarehouseCore\Repository\Media;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\Entity\StoredFileEntity;

final class StoredFileRepository extends Repository {
    public function hydrate(
        array $raw
    ): StoredFileEntity {
        return StoredFileEntity::fromRaw($raw);
    }

    public function getById(
        int $id
    ): ?StoredFileEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE id = :id",
            [
                ':id' => $id
            ]
        );
    }

    public function findByHash(
        string $hash
    ): ?StoredFileEntity {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE hash = :hash",
            [
                ':hash' => $hash
            ]
        );
    }

    public function findByCreatedUserId(
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

    public function findByMimeType(
        string $mime_type
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE mime_type = :mime_type",
            [
                ':mime_type' => $mime_type
            ]
        );
    }

    public function add(
        string $path,
        string $hash,
        string $mime_type,
        int $size,
        int $user_id
    ): int {
        try {
            return $this->insert(
                "INSERT INTO {$this->table}
                (
                    path,
                    hash,
                    mime_type,
                    size,
                    created_by_user_id
                )
                VALUES
                (
                    :path,
                    :hash,
                    :mime_type,
                    :size,
                    :user_id
                )",
                [
                    ':path' => $path,
                    ':hash' => $hash,
                    ':mime_type' => $mime_type,
                    ':size' => $size,
                    ':user_id' => $user_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePath(
        int $id,
        string $path
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET path = :path
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':path' => $path
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateHash(
        int $id,
        string $hash
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET hash = :hash
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':hash' => $hash
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateMimeType(
        int $id,
        string $mime_type
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET mime_type = :mime_type
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':mime_type' => $mime_type
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateSize(
        int $id,
        int $size
    ): void {
        try {
            $this->execute(
                "UPDATE {$this->table}
                SET size = :size
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':size' => $size
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE id = :id",
                [
                    ':id' => $id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}