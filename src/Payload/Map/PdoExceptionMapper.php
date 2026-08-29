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

        default => RepositoryException::DB_UNKNOWN_ERROR($e),
    };
}
}