<?php
namespace WarehouseCore\Repository\Catalog;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\PartAliasEntity;

final class PartAliasRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        string $id
    ): null|PartAliasEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : PartAliasEntity::fromRaw($result);
    }

    public function findByPartId(
        int $part_id
    ): array{ 
        $stmt = $this->db->prepare(
            "SELECT * FROM $this->table_name 
            WHERE part_id = :part_id"
        );
        $stmt->execute([
            ":part_id" => $part_id
        ]);
        return array_map(fn($row) => PartAliasEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByArticle(
        string $article
    ): null|PartAliasEntity{
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table_name} 
            WHERE article = :article"
        );
        $stmt->execute([
            ":article" => $article
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : PartAliasEntity::fromRaw($result);
    }

    public function add(
        int $part_id,
        string $article
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (part_id, article) 
                VALUES (:part_id, :article)"
            );
            $stmt->execute([
                ':part_id' => $part_id,
                ':article' => $article
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updatePartId(
        int $id, 
        int $part_id
    ): bool {
        try{
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET part_id = :part_id 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':part_id' => $part_id,
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateArticle(
        int $id, 
        string $article
    ): bool {
        try{
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET article = :article 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':article' => $article,
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $id
    ): bool {
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