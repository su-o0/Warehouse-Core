<?php
namespace SuO0\StorageApi\Repository;

class HistoryRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function add(string $action, int $actionOwner, string $entityType, int $entityId, ?string $note = null) {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO $this->tableName (Action, Note, ActionOwner, EntityType, EntityId)
                VALUE (:action, :note, :actionOwner, :entityType, :entityId)"
            );
            $result = $stmt->execute([
                ':action' => $action,
                ':note' => $note,
                ':actionOwner' => $actionOwner,
                ':entityType' => $entityType,
                ':entityId' => $entityId,
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