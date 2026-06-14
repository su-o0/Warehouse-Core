<?php
namespace WarehouseCore\Repository\Catalog;
use WarehouseCore\Exception\PdoExceptionMapper;

final class PartRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function findById(
        string $id
    ): null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByArticle(
        string $article
    ): null|array{
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table_name} 
            WHERE article = :article"
        );
        $stmt->execute([
            ":article" => $article
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByName(
        string $name
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->table_name 
            WHERE name = :name"
        );
        $stmt->execute([
            ":name" => $name
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function add(
        string $article, 
        ?string $name = null
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (article, name) 
                VALUES (:article, :name)"
            );
            $stmt->execute([
                ':article' => $article,
                ':name' => $name
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function updateName(
        int $id, 
        string $name
    ): bool {
        try{
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET name = :name 
                WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $id,
                ':name' => $name,
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function findOrCreate(
        string $article, 
        ?string $name = null
    ): array {
        $id = $this->findByArticle($article);
        if ($id !== null)
            return $id;
        return $this->findById($this->add($article, $name));
    }
}