<?php
namespace SuO0\StorageApi\Repository;

class ContainerRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function findAllByAddressId(int $addressId):null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdA = :IdA"
        );
        $stmt->execute([":IdA" => $addressId]);
        $result = $stmt->fetchAll();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function findById(int $containerId):null|array{
        $stmt = $this->db->prepare( 
            "SELECT * FROM $this->tableName WHERE IdC = :IdC"
        );
        $stmt->execute([":IdC" => $containerId]);
        $result = $stmt->fetch();
        if(empty($result))
            return null;
        else 
            return $result;
    }

    public function add(int $containerId, int $addressId, string $type): bool {
        try {
            switch($type) {
                case "Bulk": 
                    break;
                case "Box":
                    break;
                case "Area":
                    break;
                default:
                    throw new \RuntimeException("Type $type должен быть Bulk|Box|Area");
                    break;
            }

            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (IdC, IdA, Type) 
                VALUES (:idC, :idA, :type)"
            );
            $result = $stmt->execute([
                ':idC' => $containerId,
                ':idA' => $addressId,
                ':type' => $type
            ]);
            return $result;

        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1062)
                throw new \RuntimeException("Контейнер $containerId уже существует");

            if ($code === 1452)
                throw new \RuntimeException("Адрес $addressId не найден в Location");

            throw $e;
        }
    }

    public function move(int $containerId, int $addressIdTo): bool {
        try{
            $conteiner = $this->findById($containerId);
            if(empty($conteiner)) {
                throw new \RuntimeException("Контейнер $containerId не найден");
            }
            $stmt = $this->db->prepare(
                "UPDATE $this->tableName 
                SET IdA = :addressIdTo 
                WHERE IdC = :containerId"
            );
            $result = $stmt->execute([
                ':addressIdTo' => $addressIdTo,
                ':containerId' => $containerId,
            ]);
            return $result;
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Контейнер $containerId не найден ил");

            throw $e;
        }
    }
}