<?php
namespace SuO0\StorageApi\Repository\Audit;
use SuO0\StorageApi\Exception\StorageException;

class SalesArhiveRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function add(?int $itemId, ?int $stockId, int $partId, int $containerId, ?int $carId, int $saleOwnerId): int {
        try {
            return 1;
        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw StorageException::DB_RELATION_ERROR();
            throw $e;
        }
    }
}