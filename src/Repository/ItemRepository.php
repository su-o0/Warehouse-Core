<?php
namespace SuO0\StorageApi\Repository;

class ItemRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findById(int $itemId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE Id = :Id"
        );
        $stmt->execute([":Id" => $itemId]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function move(int $itemId, int $toContainerId) : bool {
        try {
            $item = $this->findById($itemId);
            if(empty($item))
                throw new \RuntimeException("Элемент $itemId не найден");
             
            $stmt = $this->db->prepare( 
                "UPDATE $this->tableName SET IdC = :IdC WHERE Id = :Id"
            );
            $result = $stmt->execute([
                ":Id" => $itemId,
                ":IdC" => $toContainerId
            ]);
            return $result;
        }catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Контейнер $toContainerId не найден");
            throw $e;
        }
    }

    public function findByContainerId(int $containerId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdC = :IdC"
        );
        $stmt->execute([":IdC" => $containerId]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByPartId(int $partId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdPart = :IdPart"
        );
        $stmt->execute([":IdPart" => $partId]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByCarId(int $carId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdCar = :IdCar"
        );
        $stmt->execute([":IdCar" => $carId]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function add(int $id, int $containerId, int $partId, ?int $carId = null, ?string $condition = null, ?string $conditionNote = null): int {
        try {
            if(!empty($condition))
            switch($condition) {
                case "New": 
                    break;
                case "Good":
                    break;
                case "Fair":
                    break;
                case "Poor":
                    break;
                default:
                    throw new \RuntimeException("Condition type $condition должен быть New|Good|Fair|Poor");
                    break;
            }

            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName 
                (Id, IdC, IdPart, IdCar, Condition, ConditionNote) 
                VALUES 
                (:Id, :IdC, :IdPart, :IdCar, :Condition, :ConditionNote)"    
            );
            $stmt->execute([
            ':Id'               => $id,
            ':IdC'              => $containerId,
            ':IdPart'           => $partId,
            ':IdCar'            => $carId,
            ':Condition'        => $condition,
            ':ConditionNote'    => $conditionNote
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function delete(int $itemId): bool{
        try {
            $item = $this->findById($itemId);
            if(empty($item))
                throw new \RuntimeException("Элемент $itemId не найден");
            
            $stmt = $this->db->prepare(
                "DELETE FROM $this->tableName WHERE Id = :Id"
            );
            $result = $stmt->execute([
                ':Id' => $itemId,
            ]);
            return $result;

        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function changePartId(int $partId, int $itemId): bool{
        try {
            $item = $this->findById($itemId);
            if(empty($item))
                throw new \RuntimeException("Элемент $itemId не найден");
            
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET IdPart = :partId
                WHERE Id = :Id"
            );
            $result = $stmt->execute([
                ':partId' => $partId,
                ':Id' => $itemId,
            ]);
            return $result;

        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function changeCarId(int $carId, int $itemId): bool{
        try {
            $item = $this->findById($itemId);
            if(empty($item))
                throw new \RuntimeException("Элемент $itemId не найден");
            
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET IdCar = :carId
                WHERE Id = :Id"
            );
            $result = $stmt->execute([
                ':carId' => $carId,
                ':Id' => $itemId,
            ]);
            return $result;

        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }

    public function changeCondition(string $condition, int $itemId): bool{
        try {
            switch($condition) {
                case "New": 
                    break;
                case "Good":
                    break;
                case "Fair":
                    break;
                case "Poor":
                    break;
                default:
                    throw new \RuntimeException("Condition type $condition должен быть New|Good|Fair|Poor");
                    break;
            }
            $item = $this->findById($itemId);
            if(empty($item))
                throw new \RuntimeException("Элемент $itemId не найден");

            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Condition = :condition
                WHERE Id = :Id"
            );
            $result = $stmt->execute([
                ':condition' => $condition,
                ':Id' => $itemId,
            ]);
            return $result;

        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }
}