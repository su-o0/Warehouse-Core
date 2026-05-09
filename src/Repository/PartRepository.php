<?php
namespace SuO0\StorageApi\Repository;

class PartRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findById(string $Id): null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Id = :Id"
        );
        $stmt->execute([
            ":Id" => $Id
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByArticle(string $Article): null|array{
        $stmt = $this->db->prepare(
            "SELECT * FROM $this->tableName 
            WHERE Article = :Article"
        );
        $stmt->execute([
            ":Article" => $Article
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function add(string $Article, ?string $Name = null): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Article, Name) 
                VALUES (:Article, :Name)"
            );
            $stmt->execute([
                ':Article' => $Article,
                ':Name' => $Name
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1062)
                throw new \RuntimeException("Артикул $Article уже существует");

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function findOrCreate(string $Article, ?string $Name = null): array {
        $id = $this->findByArticle($Article);
        if ($id !== null)
            return $id;
        return $this->findById($this->add($Article, $Name));
    }
}