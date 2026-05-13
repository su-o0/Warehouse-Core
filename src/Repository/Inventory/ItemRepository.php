<?php
namespace SuO0\StorageApi\Repository;

class ItemRepository {
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

    public function findByPhysicalTagId(int $PhysicalTagId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE PhysicalTagId = :PhysicalTagId"
        );
        $stmt->execute([
            ":PhysicalTagId" => $PhysicalTagId
        ]);
        $result = $stmt->fetchAll();
        return empty($result) ? null : $result;
    }

    public function findByPartId(int $PartId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE PartId = :PartId"
        );
        $stmt->execute([
            ":PartId" => $PartId
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByCarId(string $CarId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE CarId = :CarId"
        );
        $stmt->execute([
            ":CarId" => $CarId
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByStatus(string $Status): null|array {
        if(!$this->isStateStatus($Status))
            throw new \RuntimeException("Статус $Status должен быть Active|Sold|Archived|Lost");
    
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Status = :Status"
        );
        $stmt->execute([
            ":Status" => $Status
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByCondition(string $Condition): null|array {
        if(!$this->isStateCondition($Condition))
            throw new \RuntimeException("Состояние $Condition должен быть New|Good|Fair|Poor");
    
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Condition = :Condition"
        );
        $stmt->execute([
            ":Condition" => $Condition
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByPhysicalTagIdStatus(int $PhysicalTagId, string $Status): null|array {
        if(!$this->isStateStatus($Status))
            throw new \RuntimeException("Статус $Status должен быть Active|Sold|Archived|Lost");
    
        $stmt = $this->db->prepare(
            "SELECT * FROM $this->tableName 
            WHERE PhysicalTagId = :PhysicalTagId AND Status = 'Active'"
        );
        $stmt->execute([
            ":PhysicalTagId" => $PhysicalTagId
        ]);
        $result = $stmt->fetch();
        return empty($result) ? null : $result;
    }

    public function add(int $PhysicalTagId, int $PartId, ?int $CarId = null): int {
        if ($this->findByPhysicalTagIdStatus($PhysicalTagId, "Active") !== null)
            throw new \RuntimeException("Бирка $PhysicalTagId уже занята");

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName 
                (PhysicalTagId, PartId, CarId) 
                VALUES 
                (:PhysicalTagId, :IdPart, :CarId)"    
            );
            $stmt->execute([
                ':PhysicalTagId'    => $PhysicalTagId,
                ':PartId'           => $PartId,
                ':CarId'            => $CarId,
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function updatePhysicalTagId(int $Id, int $PhysicalTagId): bool {
        $item = $this->findById($Id);
        if($item === null) 
            throw new \RuntimeException("Элемент $Id не найден");

        try {
            $stmt = $this->db->prepare( 
                "UPDATE $this->tableName 
                SET PhysicalTagId = :PhysicalTagId 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ":Id" => $Id,
                ":PhysicalTagId" => $PhysicalTagId
            ]);
        }catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Бирка $PhysicalTagId не найдена");
            throw $e;
        }
    }

    public function updateContainerId(int $Id, int $ContainerId): bool {
        $item = $this->findById($Id);
        if($item === null) 
            throw new \RuntimeException("Элемент $Id не найден");

        try {
            $stmt = $this->db->prepare( 
                "UPDATE $this->tableName 
                SET ContainerId = :ContainerId 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ":Id" => $Id,
                ":ContainerId" => $ContainerId
            ]);
        }catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Контейнер $ContainerId не найдена");
            throw $e;
        }
    }

    public function updatePartId(int $Id, int $IdPart): bool{
        $item = $this->findById($Id);
        if($item === null) 
            throw new \RuntimeException("Элемент $Id не найден");

        try {
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET IdPart = :IdPart
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':IdPart' => $IdPart,
                ':Id' => $Id,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Часть $IdPart не найдена");
            throw $e;
        }
    }

    public function updateCarId(int $Id, int $CarId): bool{
        $item = $this->findById($Id);
        if($item === null) 
            throw new \RuntimeException("Элемент $Id не найден");

        try {
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET CarId = :CarId
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':CarId' => $CarId,
                ':Id' => $Id,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Авто $CarId не найдено");
            throw $e;
        }
    }

    public function updateStatus(int $Id, string $Status): bool {
        $item = $this->findById($Id);
        if($item === null) 
            throw new \RuntimeException("Элемент $Id не найден");

        if(!$this->isStateStatus($Status))
            throw new \RuntimeException("Статус $Status должен быть Active|Sold|Archived|Lost");

        try {
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Status = :Status
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Status' => $Status,
                ':Id' => $Id,
            ]);
        } catch (\PDOException $e) {
            
            throw $e;
        }
    }

    public function updateCondition(int $Id, string $Condition, ?string $ConditionNote = null): bool{
        $item = $this->findById($Id);
        if($item === null) 
            throw new \RuntimeException("Элемент $Id не найден");

        if(!$this->isStateCondition($Condition))
            throw new \RuntimeException("Состояние должно быть New|Good|Fair|Poor");

        try {
            
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Condition = :Condition, ConditionNote = :ConditionNote
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':Condition' => $Condition,
                ':ConditionNote' => $ConditionNote,
                ':Id' => $Id,
            ]);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function isStateStatus(string $Status): bool {
        switch($Status) {
            case "Active": 
                return true;
            case "Sold": 
                return true;
            case "Archived": 
                return true;
            case "Lost": 
                return true;
            default:
                return false;
        }
    }
    
    public function isStateCondition(string $Condition): bool {
        switch($Condition) {
            case "New": 
                return true;
            case "Good": 
                return true;
            case "Fair": 
                return true;
            case "Poor": 
                return true;
            default:
                return false;
        }
    }
}