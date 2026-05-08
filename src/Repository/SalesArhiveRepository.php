<?php
namespace SuO0\StorageApi\Repository;

class SalesArhiveRepository {
    public function __construct(private \PDO $db, private string $tableName) {
    }

    public function add(?int $itemId, ?int $stockId, int $partId, int $containerId, ?int $carId, int $saleOwnerId): int {
        try {

        } catch (\PDOException $e) {
            $code = $e->errorInfo[1];

            if ($code === 1452)
                throw new \RuntimeException("Ошибка связи данных");
            throw $e;
        }
    }
}