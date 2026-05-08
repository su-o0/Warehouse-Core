<?php
namespace SuO0\StorageApi\Repository;

class PhysicalTagRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findByIdTag(int $IdTag): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE IdTag = :IdTag"
        );
        $stmt->execute([
            ":IdTag" => $IdTag
        ]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByStatus(string $Status): null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Status = :Status"
        );
        $stmt->execute([
            ":Status" => $Status
        ]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }   

    public function add(int $IdTag, string $Status): bool {
        try {
            switch($Status){
                case "Free": break;
                case "Assigned": break;
                case "Lost": break;
                case "Broken": break;
                default: 
                    throw new \RuntimeException("Статут физического идентификатора должен быть Free|Assigned|Lost|Broken");            
            }
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdTag, Status) 
                VALUES (:IdTag, :Status)"
            );
            $result = $stmt->execute([
                ':IdTag'    => $IdTag,
                ':Status'   => $Status,
            ]);
            return $result;
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1062)
                throw new \RuntimeException("Физический идентификатор #$IdTag уже существует");            
            
            throw $e;
        }
    }

    public function updateStatus(int $IdTag, string $Status) {
        try {
            switch($Status){
                case "Free": break;
                case "Assigned": break;
                case "Lost": break;
                case "Broken": break;
                default: 
                    throw new \RuntimeException("Статут физического идентификатора должен быть Free|Assigned|Lost|Broken");            
            }
            $stmt = $this->db->prepare(
                 "UPDATE $this->tableName 
                SET IdTag = :IdTag 
                WHERE IdTag = :IdTag"
            );
            $result = $stmt->execute([
                ':IdTag'    => $IdTag,
                ':Status'   => $Status,
            ]);
            return $result;
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1062)
                throw new \RuntimeException("Физический идентификатор #$IdTag уже существует");            
            
            throw $e;
        }
    }
}