<?php
namespace SuO0\StorageApi\Repository;

class PlacementRepository {
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

    public function findByIdLocation(int $IdLocation): null|array {
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

    public function findByEntityType(string $EntityType): null|array {
        if(!$this->isStateEntityType($EntityType))
            throw new \RuntimeException("Тип сущности должен быть Container|Item|Stock");

        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE EntityType = :EntityType"
        );
        $stmt->execute([
            ":EntityType" => $EntityType
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByEntity(string $EntityType, int $EntityId): null|array {
        if(!$this->isStateEntityType($EntityType))
            throw new \RuntimeException("Тип сущности должен быть Container|Item|Stock");

        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE EntityType = :EntityType AND EntityId = :EntityId"
        );
        $stmt->execute([
            ":EntityType" => $EntityType,
            ":EntityId" => $EntityId
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(int $IdLocation, string $EntityType, int $EntityId): bool {
        if(!$this->isStateEntityType($EntityType))
            throw new \RuntimeException("Тип сущности должен быть Container|Item|Stock");

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdLocation, EntityType, EntityId) 
                VALUES (:IdLocation, :EntityType, :EntityId)"
            );
            return $stmt->execute([
                ':IdLocation' => $IdLocation,
                ':EntityType' => $EntityType,
                ':EntityId' => $EntityId
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Адрес $IdLocation не найден");

            throw $e;
        }
    }

    public function updateEntity(int $Id, string $EntityType, int $EntityId): bool {
        $placement = $this->findById($Id);
        if($placement === null)
            throw new \RuntimeException("Расположение не найдено");

        if(!$this->isStateEntityType($EntityType))
            throw new \RuntimeException("Тип сущности должен быть Container|Item|Stock");

        try {
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET EntityType = :EntityType, EntityId = :EntityId
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':EntityType' => $EntityType,
                ':EntityId' => $EntityId,
                ':Id' => $Id
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Сшибка связи данних.");

            throw $e;
        }
    }

    public function delete(int $Id): int{
        $placement = $this->findById($Id);
        if($placement === null)
            throw new \RuntimeException("Расположение не найдено");
        
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

    public function isStateEntityType(string $EntityType): bool {
        switch($EntityType) {
            case "Container":
                return true;
            case "Item":
                return true;
            case "Stock":
                return true;
            default:
                return false;
        }
    }
}