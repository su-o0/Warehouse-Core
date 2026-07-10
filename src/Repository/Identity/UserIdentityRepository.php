<?php 
namespace WarehouseCore\Repository\Identity;
use WarehouseCore\Exception\PdoExceptionMapper;

use WarehouseCore\Payload\DTO\UserIdentityEntity;

final class UserIdentityRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

    public function getById(
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
        return empty($result)? null : UserIdentityEntity::fromRaw($stmt->fetch());
    }

    public function getAll(): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table_name}"
        );
        $stmt->execute();
        return array_map(fn($row) => UserIdentityEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByUserId(
        int $user_id
    ): array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE user_id = :user_id"
        );
        $stmt->execute([
            ":user_id" => $user_id
        ]);
        return array_map(fn($row) => UserIdentityEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByProvider(
        string $provider
    ): array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE provider = :provider"
        );
        $stmt->execute([
            ":provider" => $provider
        ]);
        return array_map(fn($row) => UserIdentityEntity::fromRaw($row), $stmt->fetchAll());
    }

    public function findByProviderAndId(
        string $provider,
        string $external_id
    ): null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE provider = :provider AND external_id = :external_id"
        );
        $stmt->execute([
            ":provider" => $provider,
            ":external_id" => $external_id
        ]);
        return empty($result)? null : UserIdentityEntity::fromRaw($stmt->fetch());
    }

    public function add(
        int $user_id, 
        string $provider,
        string $external_id
    ): int {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (user_id, provider, external_id) 
                VALUES (:user_id, :provider, :external_id)"
            );
            $stmt->execute([
                ':user_id' => $user_id,
                ':provider' => $provider,
                ':external_id' => $external_id,
            ]);
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $id, 
    ):bool {
        try {
            $stmt = $this->db->prepare(
                 "DELETE FROM {$this->table_name} 
                WHERE id = :id"
            );
            return $stmt->execute([
                'id' => $id,
            ]);
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}