<?php
namespace SuO0\StorageApi\Repository;

class ItemPhotoRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findById(int $Id): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE Id = :Id"
        );
        $stmt->execute([":Id" => $Id]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByIdItem(int $IdItem): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdItem = :IdItem"
        );
        $stmt->execute([":IdItem" => $IdItem]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByIdOwner(int $IdOwner): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdOwner = :IdOwner"
        );
        $stmt->execute([":IdOwner" => $IdOwner]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByFile(string $File): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE File = :File"
        );
        $stmt->execute([":File" => $File]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function add(int $IdItem, int $IdOwner, string $File): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdItem, IdOwner, File) 
                VALUES (:IdItem, :IdOwner, :File)"
            );
            $stmt->execute([
               ':IdItem' => $IdItem,
               ':IdOwner' => $IdOwner,
               ':File' => $File
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            
            throw $e;
        }
    }
    
}