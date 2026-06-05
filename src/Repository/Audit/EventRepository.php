<?php
namespace WarehouseCore\Repository\Audit;
use WarehouseCore\Exception\StorageException;

final class EventRepository {
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

    public function findByEntityType(
        string $entity_type
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE entity_type = :entity_type"
        );
        $stmt->execute([
            ":entity_type" => $entity_type
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function findByAction(
        string $action
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE action = :action"
        );
        $stmt->execute([
            ":action" => $action
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(
        string $entity_type, 
        int $entity_id, 
        string $action, 
        string $payload, 
        int $owner_id, 
        int $user_id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (action, entity_type, entity_id, payload, owner_id, user_id)
                VALUE (:action, :entity_type, :EntityId, :payload, :owner_id, :user_id)"
            );
            $stmt->execute([
                ':action' => $action,
                ':entity_type' => $entity_type,
                ':entity_id' => $entity_id,
                ':payload' => $payload,
                ':ownerId' => $owner_id,
                ':user_id' => $user_id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }   
}