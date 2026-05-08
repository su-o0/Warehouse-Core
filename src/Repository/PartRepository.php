<?php
namespace SuO0\StorageApi\Repository;

class PartRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function find(string $id): null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE Id = :Id"
        );
        $stmt->execute([":Id" => $id]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByArticle(string $article):null|array{
        $stmt = $this->db->prepare(
            "SELECT * FROM $this->tableName WHERE Article = :article"
        );
        $stmt->execute([":article" => $article]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function add(string $article, ?string $name = null): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Article, Name) 
                VALUES (:article, :name)"
            );
            $stmt->execute([
                ':article' => $article,
                ':name' => $name
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1062)
                throw new \RuntimeException("Артикул $article уже существует");

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function findOrCreate(string $article, ?string $name = null): array {
        $id = $this->findByArticle($article);
        if ($id !== null)
            return $id;
        return $this->find($this->add($article, $name));
    }
}