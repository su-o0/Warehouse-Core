<?php
namespace WarehouseCore\Payload\Map;

use PDOException;
use WarehouseCore\Exception\RepositoryException;

final class PdoExceptionMapper {
    public static function map(
        PDOException $e
    ): RepositoryException {
        var_dump([
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'errorInfo' => $e->errorInfo,
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);

        $code = $e->errorInfo[1] ?? null;

        return match ($code) {
            1451 => RepositoryException::DB_RELATION_ERROR($e),
            1452 => RepositoryException::DB_RELATION_ERROR($e),
            1062 => RepositoryException::DB_DUPLICATE_ERROR($e),
            1644 => match (true) {
                str_contains($e->getMessage(), 'immutable') => RepositoryException::DB_IMMUTABLE_FIELD_ERROR($e),
                default => RepositoryException::DB_VALIDATION_ERROR($e),
            },
            default => RepositoryException::DB_UNKNOWN_ERROR($e),
        };
    }
}