<?php
namespace WarehouseCore\Repository\Media;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\PhotoEntity;

final class PartPhotoRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        int $id
    ): null|PhotoEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : PhotoEntity::fromRaw($result);
    }

    public function findByPartId(
        int $part_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE part_id = :part_id"
        );
        $stmt->execute([
            ":part_id" => $part_id
        ]);
        return array_map(fn($row) => PhotoEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByFileId(
        int $file_id
    ): null|PhotoEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE file_id = :file_id"
        );
        $stmt->execute([
            ":file_id" => $file_id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : PhotoEntity::fromRaw($result);
    }

    public function add(
        int $part_id, 
        int $file_id 
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (part_id, file_id) 
                VALUES (:part_id, :file_id)"
            );
            $stmt->execute([
               ':part_id' => $part_id,
               ':file_id' => $file_id,
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