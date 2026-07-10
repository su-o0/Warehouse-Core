<?php
namespace WarehouseCore\Repository\Audit;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\TelemetryEntity;

final class TelemetryRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
        int $id
    ): null|TelemetryEntity {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE id = :id"
        );
        $stmt->execute([
            ":id" => $id
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : TelemetryEntity::fromRaw($result);
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
        return array_map(fn($row) => TelemetryEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByEntityTypeAndId(
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
        return array_map(fn($row) => TelemetryEntity::fromRaw($row), $stmt->fetchAll());
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
        return array_map(fn($row) => TelemetryEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByUserId(
        int $user_id
    ): array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE user_id = :user_id"
        );
        $stmt->execute([
            ":user_id" => $user_id
        ]);
        return array_map(fn($row) => TelemetryEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function add(
        string $entity_type, 
        int $entity_id, 
        string $action, 
        string $payload, 
        int $user_id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (entity_type, entity_id, action, payload, user_id)
                VALUE (:entity_type, :entity_id, :action, :payload, :user_id)"
            );
            $stmt->execute([
                ':action' => $action,
                ':entity_type' => $entity_type,
                ':entity_id' => $entity_id,
                ':payload' => $payload,
                ':user_id' => $user_id
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }   
}