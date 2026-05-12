<?php
namespace SuO0\StorageApi\Repository;

class ContainerRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findById(int $Id):null|array{
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

    public function findByIdLocation(int $IdLocation):null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE IdLocation = :IdLocation"
        );
        $stmt->execute([
            ":IdLocation" => $IdLocation
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(int $Id, int $IdLocation, string $Type): bool {
        $Container = $this->findById($Id);
        if($Container !== null) 
            throw new \RuntimeException("Контейнер $Id уже существует");
        
        if($this->isStateType($Type))
            throw new \RuntimeException("Тип контейнера $Type должен быть Box|Pallet");

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Id, IdLocation, Type) 
                VALUES (:Id, :IdLocation, :Type)"
            );
            return $stmt->execute([
                ':Id' => $Id,
                ':IdLocation' => $IdLocation,
                ':Type' => $Type
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Адрес $IdLocation не найден");

            throw $e;
        }
    }

    public function updateIdLocation(int $Id, int $IdLocation): bool {
        $container = $this->findById($Id);
        if($container === null) 
            throw new \RuntimeException("Контейнер $Id не найден");

        try{
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET IdLocation = :IdLocation 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':IdLocation' => $IdLocation,
                ':Id' => $Id,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Контейнер $IdLocation не найден");

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

    public function isStateType(string $Type):bool {
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