<?php
namespace WarehouseCore\Repository\Media;
use WarehouseCore\Exception\StorageException;

final class ItemPhotoRepository {
    public function __construct(
        private \PDO $db, 
        private string $table_name
    ) { }

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

    public function findByItemId(
        int $item_id
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE item_id = :item_id"
        );
        $stmt->execute([
            ":item_id" => $item_id
        ]);
        $result = $stmt->fetchAll();
        return empty($result)? null : $result;
    }

    public function findByFile(
        string $file
    ): null|array {
        $stmt = $this->db->prepare( 
            "SELECT * FROM {$this->table_name} 
            WHERE file = :file"
        );
        $stmt->execute([
            ":file" => $file
        ]);
        $result = $stmt->fetch();
        return empty($result)? null : $result;
    }

    public function add(
        int $item_id, 
        string $file
    ): int {
        if(!$this->findByFile($file))
            throw StorageException::ITEM_PHOTO_ALREADY_EXISTS();

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table_name} 
                (item_id, file) 
                VALUES (:item_id, :file)"
            );
            $stmt->execute([
               ':item_id' => $item_id,
               ':file' => $file
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