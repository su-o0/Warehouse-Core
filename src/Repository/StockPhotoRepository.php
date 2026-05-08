<?php
namespace SuO0\StorageApi\Repository;

class StockPhotoRepository {
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

    public function findByIdStock(int $IdStock): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdStock = :IdStock"
        );
        $stmt->execute([":IdStock" => $IdStock]);
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

    public function add(int $IdStock, int $IdOwner, string $File): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdStock, IdOwner, File) 
                VALUES (:IdStock, :IdOwner, :File)"
            );
            $stmt->execute([
               ':IdStock' => $IdStock,
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