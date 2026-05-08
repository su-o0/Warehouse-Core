<?php
namespace SuO0\StorageApi\Repository;

class OwnerRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function find(int $id): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE Id = :id"
        );
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByUserId(int $userId): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdUser = :userId"
        );
        $stmt->execute([":userId" => $userId]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findByName(string $name): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE Name = :name"
        );
        $stmt->execute([":name" => $name]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }
    public function findByPermission(string $permission): null|array {
        switch($permission){
            case "Admin":
                break;
            case "Worker":
                break;
            default: 
                throw new \RuntimeException("Permission должен быть Admin|Worker");
                break;
        }

        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE Permission = :permission"
        );
        $stmt->execute([":permission" => $permission]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function add(int $userId, string $permission, string $name): bool {
        try {
            switch($permission){
                case "Admin":
                    break;
                case "Worker":
                    break;
                default: 
                    throw new \RuntimeException("Permission должен быть Admin|Worker");
                    break;
            }

            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdC, IdA, Type) 
                VALUES (:userId, :permission, :type)"
            );
            $result = $stmt->execute([
                ':userId' => $userId,
                ':permission' => $permission,
                ':name' => $name
            ]);
            return $result;
        
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];
            
            if ($code === 1062)
                throw new \RuntimeException("Пользователь $userId уже существует");

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            
            throw $e;
        }
    }

    public function changePermission(int $id, string $newPermission) {
        try {
            switch($newPermission){
                case "Admin":
                    break;
                case "Worker":
                    break;
                default: 
                    throw new \RuntimeException("Permission должен быть Admin|Worker");
                    break;
            }

            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Permission = :newPermission 
                WHERE Id = :id"
            );
            $result = $stmt->execute([
            ':id' => $id,
            ':newPermission' => $newPermission
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