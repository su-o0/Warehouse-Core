<?php
namespace WarehouseCore\Exception;

use PDOException;

final class PdoExceptionMapper {
    public static function map(
        PDOException $e
    ): RepositoryException {
        $code = $e->errorInfo[1] ?? null;

        return match ($code) {
            1451 => RepositoryException::DB_RELATION_ERROR($e),
            1452 => RepositoryException::DB_RELATION_ERROR($e),
            1062 => RepositoryException::DB_DUPLICATE_ERROR($e),

            default => RepositoryException::DB_UNKNOWN_ERROR($e),
        };
    }
}