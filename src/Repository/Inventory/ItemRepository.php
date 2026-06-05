<?php
namespace WarehouseCore\Repository\Inventory;
use WarehouseCore\Exception\StorageException;

final class ItemRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name) {
    }

    public function findById(
        int $id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByPhysicalTagId(
        int $physical_tag_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE physical_tag_id = :physical_tag_id"
        );
        $stmt->execute([
            ":physical_tag_id" => $physical_tag_id
        ]);
        $result = $stmt->fetchAll();
        return empty($result) ? null : $result;
    }

    public function findByContainerId(
        int $container_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE container_id = :container_id"
        );
        $stmt->execute([
            ":container_id" => $container_id
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByPartId(
        int $part_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE part_id = :part_id"
        );
        $stmt->execute([
            ":part_id" => $part_id
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByVehicleId(
        string $vehicle_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE vehicle_id = :vehicle_id"
        );
        $stmt->execute([
            ":vehicle_id" => $vehicle_id
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByStatus(
        string $status
    ): null|array {
        if(!$this->isValidStatus($status))
            throw StorageException::ITEM_INVALID_STATUS();

        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE status = :status"
        );
        $stmt->execute([
            ":status" => $status
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByCondition(
        string $condition_level
    ): null|array {
        if(!$this->isValidCondition($condition_level))
            throw StorageException::ITEM_INVALID_CONDITION();
    
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE condition_level = :condition_level"
        );
        $stmt->execute([
            ":condition_level" => $condition_level
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByPhysicalTagIdStatus(
        int $physical_tag_id, 
        string $status
    ): null|array {
        if(!$this->isValidStatus($status))
            throw StorageException::ITEM_INVALID_STATUS();
    
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table_name} 
            WHERE physical_tag_id = :physical_tag_id AND status = :status"
        );
        $stmt->execute([
            ":physical_tag_id" => $physical_tag_id,
            ":status" => $status
        ]);
        $result = $stmt->fetchAll();
        return empty($result) ? null : $result;
    }

    public function add(
        int $physical_tag_id, 
        int $owner_id,
        ?int $part_id = null, 
        ?int $vehicle_id = null,
    ): int {
        if ($this->findByPhysicalTagIdStatus($physical_tag_id, "Active") !== null)
            throw StorageException::ITEM_PHYSICAL_TAG_ALREADY_USED();

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (physical_tag_id, part_id, vehicle_id, owner_id) 
                VALUES (:physical_tag_id, :part_id, :vehicle_id, owner_id)"    
            );
            $stmt->execute([
                ':physical_tag_id' => $physical_tag_id,
                ':part_id' => $part_id,
                ':vehicle_id' => $vehicle_id,
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }

    public function updatePhysicalTagId(
        int $id, 
        int $physical_tag_id
    ): bool {
        if($this->findById($id) === null) 
            throw StorageException::ITEM_NOT_FOUND();

        try {
            $stmt = $this->db->prepare( 
                "UPDATE {$this->table_name} 
                SET physical_tag_id = :physical_tag_id 
                WHERE id = :id"
            );
            return $stmt->execute([
                ":id" => $id,
                ":physical_tag_id" => $physical_tag_id
            ]);
        }catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }

    public function updateContainerId(
        int $id, 
        ?int $container_id = null
    ): bool {
        if($this->findById($id) === null) 
            throw StorageException::ITEM_NOT_FOUND();

        try {
            $stmt = $this->db->prepare( 
                "UPDATE {$this->table_name} 
                SET container_id = :container_id 
                WHERE id = :id"
            );
            return $stmt->execute([
                ":id" => $id,
                ":container_id" => $container_id
            ]);
        }catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }

    public function updatePartId(
        int $id, 
        int $part_id
    ): bool {
        if($this->findById($id) === null) 
            throw StorageException::ITEM_NOT_FOUND();

        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET part_id = :part_id
                WHERE id = :id"
            );
            return $stmt->execute([
                ':part_id' => $part_id,
                ':id' => $id,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }

    public function updateVehicleId(
        int $id, 
        int $vehicle_id
    ): bool {
        if($this->findById($id) === null) 
            throw StorageException::ITEM_NOT_FOUND();

        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET vehicle_id = :vehicle_id
                WHERE id = :id"
            );
            return $stmt->execute([
                ':vehicle_id' => $vehicle_id,
                ':id' => $id,
            ]);
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }

    public function updateStatus(
        int $id, 
        string $status
    ): bool {
        if($this->findById($id) === null) 
            throw StorageException::ITEM_NOT_FOUND();

        if(!$this->isValidStatus($status))
            throw StorageException::ITEM_INVALID_STATUS();

        try {
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET status = :status
                WHERE id = :id"
            );
            return $stmt->execute([
                ':status' => $status,
                ':id' => $id,
            ]);
        } catch (\PDOException $e) {
            
            throw $e;
        }
    }

    public function updateCondition(
        int $id, 
        string $condition_level, 
        ?string $ConditionNote = null
    ): bool {
        if($this->findById($id) === null) 
            throw StorageException::ITEM_NOT_FOUND();

        if(!$this->isValidCondition($condition_level))
            throw StorageException::ITEM_INVALID_CONDITION();

        try {
            
            $stmt = $this->db->prepare(
                "UPDATE {$this->table_name} 
                SET condition_level = :condition_level, ConditionNote = :ConditionNote
                WHERE id = :id"
            );
            return $stmt->execute([
                'condition_level' => $condition_level,
                ':ConditionNote' => $ConditionNote,
                ':id' => $id,
            ]);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    private function isValidStatus(
        string $status
    ): bool {
        switch($status) {
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
    
    private function isValidCondition(
        string $condition_level
    ): bool {
        switch($condition_level) {
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