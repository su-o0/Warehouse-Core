<?php
namespace SuO0\StorageApi\Repository;

class OwnerRepository {
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

    public function findByIdUser(int $IdUser): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE IdUser = :IdUser"
        );
        $stmt->execute([":IdUser" => $IdUser]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByPermission(string $permission): null|array {
        switch($permission){
            case "Admin": break;
            case "Worker": break;
            default: 
                throw new \RuntimeException("Permission должен быть Admin|Worker");
        }

        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Permission = :permission"
        );
        $stmt->execute([":permission" => $permission]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByName(string $Name): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName 
            WHERE Name = :Name"
        );
        $stmt->execute([":Name" => $Name]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function add(int $IdUser, string $Permission, string $Name): bool {
        switch($Permission){
            case "Admin": break;
            case "Worker":break;
            default: 
                throw new \RuntimeException("Права должни быть Admin|Worker");
        }
        
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdUser, Permission, Name) 
                VALUES (:IdUser, :Permission, :Name)"
            );
            $result = $stmt->execute([
                ':userId' => $IdUser,
                ':Permission' => $Permission,
                ':Name' => $Name
            ]);
            return $result;
        
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            
            throw $e;
        }
    }

    public function updatePermission(int $Id, string $Permission) {
        $owner = $this->findById($Id);
        if($owner === null) 
            throw new \RuntimeException("Пользователь $Id не найден");
        
        switch($Permission){
            case "Admin": break;
            case "Worker": break;
            default: 
                throw new \RuntimeException("Права должни быть Admin|Worker");
        }

        try {
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET Permission = :Permission 
                WHERE Id = :Id"
            );
            $result = $stmt->execute([
                ':Id' => $Id,
                ':Permission' => $Permission
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