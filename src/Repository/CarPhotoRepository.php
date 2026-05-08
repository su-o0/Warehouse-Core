<?php
namespace SuO0\StorageApi\Repository;

class CarPhotoRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function find(int $id): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE Id = :id"
        );
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByCarId(int $carId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdCar = :carId"
        );
        $stmt->execute([":carId" => $carId]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByFile(string $file): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE File = :file"
        );
        $stmt->execute([":file" => $file]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function add(int $carId, string $file): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdCar, File) 
                VALUES (:carId, :file)"
            );
            $stmt->execute([
               ':carId' => $carId,
               ':file' => $file
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