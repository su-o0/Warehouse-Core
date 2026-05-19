<?php
namespace WarehouseCore\Repository\Catalog;
use WarehouseCore\Exception\StorageException;

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
        $result = $stmt->fetch();
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
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByName(string $Name): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Name = :Name"
        );
        $stmt->execute([
            ":Name" => $Name
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
                throw StorageException::PART_ALREADY_EXISTS();

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }

    public function updateName(int $Id, string $Name): bool {
        $container = $this->findById($Id);
        if($container === null) 
            throw StorageException::PART_NOT_FOUND();

        try{
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Name = :Name 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Id' => $Id,
                ':Name' => $Name,
            ]);
        } catch (\PDOException $e) {
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