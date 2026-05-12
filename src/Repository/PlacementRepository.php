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