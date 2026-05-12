<?php
namespace SuO0\StorageApi\Repository;

class PhysicalTagRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findByIdPhysicalTag(int $IdPhysicalTag): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE IdPhysicalTag = :IdPhysicalTag"
        );
        $stmt->execute([
            ":IdPhysicalTag" => $IdPhysicalTag
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByStatus(string $Status): null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Status = :Status"
        );
        $stmt->execute([
            ":Status" => $Status
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(int $IdPhysicalTag, string $Status): bool {
        $PhysicalTag = $this->findByIdPhysicalTag($IdPhysicalTag);
        if ($PhysicalTag === null) 
            throw new \RuntimeException("Бирка $IdPhysicalTag не найдена");

        if($this->isStateStatus($Status))
            throw new \RuntimeException("Статут физического идентификатора должен быть Free|Assigned|Lost|Broken");            

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdPhysicalTag, Status) 
                VALUES (:IdPhysicalTag, :Status)"
            );
            return $stmt->execute([
                ':IdPhysicalTag' => $IdPhysicalTag,
                ':Status' => $Status,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1062)
                throw new \RuntimeException("Физический идентификатор $IdPhysicalTag уже существует");            
            
            throw $e;
        }
    }

    public function updateStatus(int $IdPhysicalTag, string $Status) {
        $PhysicalTag = $this->findByIdPhysicalTag($IdPhysicalTag);
        if ($PhysicalTag === null) 
            throw new \RuntimeException("Бирка $IdPhysicalTag не найдена");

        if($this->isStateStatus($Status))
            throw new \RuntimeException("Статут физического идентификатора должен быть Free|Assigned|Lost|Broken");            

        try {
            $stmt = $this->db->prepare(
                 "UPDATE $this->tableName 
                SET Status = :Status 
                WHERE IdPhysicalTag = :IdPhysicalTag"
            );
            return $stmt->execute([
                ':IdPhysicalTag' => $IdPhysicalTag,
                ':Status' => $Status,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1062)
                throw new \RuntimeException("Физический идентификатор $IdPhysicalTag уже существует");            
            
            throw $e;
        }
    }

    public function isStateStatus(string $Status): bool {
        switch($Status){
            case "Free": 
                return true;
            case "Assigned": 
                return true;
            case "Lost": 
                return true;
            case "Broken": 
                return true;
            default: 
                return false;
        }
    }
}