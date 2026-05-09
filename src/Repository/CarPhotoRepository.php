<?php
namespace SuO0\StorageApi\Repository;

class CarPhotoRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findById(int $Id): null|array {
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

    public function findByIdCar(int $IdCar): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE IdCar = :IdCar"
        );
        $stmt->execute([":IdCar" => $IdCar]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByIdOwner(int $IdOwner): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE IdOwner = :IdOwner"
        );
        $stmt->execute([
            ":IdOwner" => $IdOwner
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByFile(string $File): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE File = :File"
        );
        $stmt->execute([
            ":File" => $File
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function add(int $IdCar, int $IdOwner, string $File): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdCar, IdOwner, File) 
                VALUES (:IdCar, :IdOwner, :File)"
            );
            $stmt->execute([
               ':IdCar' => $IdCar,
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