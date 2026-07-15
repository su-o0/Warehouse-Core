<?php
namespace WarehouseCore\Repository\Media;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\StorageFileEntity;

final class StorageFileRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        int $id
    ): null|StorageFileEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : StorageFileEntity::fromRaw($result);
    }

    public function findByHash(
        string $hash
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE hash = :hash"
        );
        $stmt->execute([
            "hash" => $hash
        ]);
        return array_map(fn($row) => StorageFileEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByUserId(
        int $user_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE user_id = :user_id"
        );
        $stmt->execute([
            ":user_id" => $user_id
        ]);
        return array_map(fn($row) => StorageFileEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function add(
        string $path, 
        string $hash,
        string $mime_type,
        string $size,
        int $user_id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (path, hash, mime_type, size, created_by_user_id) 
                VALUES (:path, :hash, :mime_type, :size, :user_id)"
            );
            $stmt->execute([
               ':path' => $path,
               ':hash' => $hash,
               ':mime_type' => $mime_type,
               ':size' => $size,
               ':user_id' => $user_id,
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $id
    ): bool{
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM {$this->table_name} 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}