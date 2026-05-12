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

    public function findByIdPhysicalTag(int $IdPhysicalTag): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE IdPhysicalTag = :IdPhysicalTag"
        );
        $stmt->execute([
            ":IdPhysicalTag" => $IdPhysicalTag
        ]);
        $result = $stmt->fetchAll();
        return empty($result) ? null : $result;
    }

    public function findByIdPart(int $IdPart): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE IdPart = :IdPart"
        );
        $stmt->execute([
            ":IdPart" => $IdPart
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByIdCar(int $IdCar): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE IdCar = :IdCar"
        );
        $stmt->execute([
            ":IdCar" => $IdCar
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

    public function findActiveByIdTag(int $IdTag): null|array {
        $stmt = $this->db->prepare(
            "SELECT * FROM $this->tableName 
            WHERE IdTag = :IdTag AND Status = 'Active'"
        );
        $stmt->execute([
            ":IdTag" => $IdTag
        ]);
        $result = $stmt->fetch();
        return empty($result) ? null : $result;
    }

    public function add(int $IdPhysicalTag, int $IdPart, ?int $IdCar = null, ?string $Condition = null, ?string $ConditionNote = null): int {
        if ($this->findActiveByIdTag($IdPhysicalTag) !== null)
            throw new \RuntimeException("Бирка $IdPhysicalTag уже занята");

        if(!$this->isStateCondition($Condition))
            throw new \RuntimeException("Состояние должно быть New|Good|Fair|Poor");

        try {
           
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName 
                (IdPhysicalTag, IdPart, IdCar, Condition, ConditionNote) 
                VALUES 
                (:IdPhysicalTag, :IdPart, :IdCar, :Condition, :ConditionNote)"    
            );
            return $stmt->execute([
                ':IdPhysicalTag'            => $IdPhysicalTag,
                ':IdPart'           => $IdPart,
                ':IdCar'            => $IdCar,
                ':Condition'        => $Condition,
                ':ConditionNote'    => $ConditionNote
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function updateIdPhysicalTag(int $Id, int $IdPhysicalTag): bool {
        $item = $this->findById($Id);
        if($item === null) 
            throw new \RuntimeException("Элемент $Id не найден");

        try {
            $stmt = $this->db->prepare( 
                "UPDATE $this->tableName 
                SET IdPhysicalTag = :IdPhysicalTag 
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ":Id" => $Id,
                ":IdPhysicalTag" => $IdPhysicalTag
            ]);
        }catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Бирка $IdPhysicalTag не найдена");
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

    public function updateCarId(int $Id, int $IdCar): bool{
        $item = $this->findById($Id);
        if($item === null) 
            throw new \RuntimeException("Элемент $Id не найден");

        try {
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET IdCar = :IdCar
                WHERE Id = :Id"
            );
            return $stmt->execute([
                ':IdCar' => $IdCar,
                ':Id' => $Id,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Авто $IdCar не найдено");
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

    public function updateCondition(int $Id, string $Condition, string $ConditionNote = null): bool{
        $item = $this->findById($Id);
        if($item === null) 
            throw new \RuntimeException("Элемент $Id не найден");

        if(!$this->isStateCondition($Condition))
            throw new \RuntimeException("Состояние должно быть New|Good|Fair|Poor");

        try {
            if($ConditionNote === null) {
                $stmt = $this->db->prepare(
                    "UPDATE $this->tableName 
                    SET Condition = :Condition
                    WHERE Id = :Id"
                );
                return $stmt->execute([
                    ':Condition' => $Condition,
                    ':Id' => $Id,
                ]);    
            }
            else {
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
            }
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