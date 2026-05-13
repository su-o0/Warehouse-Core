<?php
namespace SuO0\StorageApi\Repository;

class ContainerRepository {
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

    public function findByType(int $Type): null|array {
        if($this->isStateType($Type))
            throw new \RuntimeException("Тип контейнера $Type должен быть Box|Pallet");

        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Type = :Type"
        );
        $stmt->execute([
            ":Type" => $Type
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }


    public function add(int $Id, string $Type): bool {
        $Container = $this->findById($Id);
        if($Container !== null) 
            throw new \RuntimeException("Контейнер $Id уже существует");
        
        if($this->isStateType($Type))
            throw new \RuntimeException("Тип контейнера $Type должен быть Box|Pallet");

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Id, Type) 
                VALUES (:Id, :Type)"
            );
            return $stmt->execute([
                ':Id' => $Id,
                ':Type' => $Type
            ]);
        } catch (\PDOException $e) {

            throw $e;
        }
    }
    
    public function updateType(int $Id, string $Type): bool {
        $container = $this->findById($Id);
        if($container === null) 
            throw new \RuntimeException("Контейнер $Id уже существует");

        if($this->isStateType($Type))
            throw new \RuntimeException("Тип контейнера $Type должен быть Box|Pallet");

        try{
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Type = :Type 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Type' => $Type,
                ':Id' => $Id,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Контейнер $Id не найден");

            throw $e;
        }
    }

    public function delete(int $Id): int {
        $stock = $this->findById($Id);
        if($stock === null)
            throw new \RuntimeException("Контейнер $Id не найден");
        
        try {
            $stmt = $this->db->prepare(
                "DELETE FROM $this->tableName 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Id' => $Id
            ]);
        } catch (\PDOException $e) {

            throw $e;
        }
    }

    public function isStateType(string $Type): bool {
        switch($Type) {
            case "Box": 
                return true;
            case "Pallet": 
                return true;
            default: 
                return false;
        }
    }
}