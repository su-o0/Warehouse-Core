<?php
namespace WarehouseCore\Repository\Audit;
use WarehouseCore\Exception\PdoExceptionMapper;

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
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE entity_type = :entity_type"
        );
        $stmt->execute([
            ":entity_type" => $entity_type
        ]);
        return $stmt->fetchAll();
    }

    public function findByEntity(
        string $entity_type,
        int $entity_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE entity_type = :entity_type AND entity_id = :entity_id"
        );
        $stmt->execute([
            ":entity_type" => $entity_type,
            ":entity_id" => $entity_id,
        ]);
        return $stmt->fetchAll();
    }

    public function findByAction(
        string $action
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE action = :action"
        );
        $stmt->execute([
            ":action" => $action
        ]);
        return $stmt->fetchAll();
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
            throw PdoExceptionMapper::map($e);
        }
    }   
}