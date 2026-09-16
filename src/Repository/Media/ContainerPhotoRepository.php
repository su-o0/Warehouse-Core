<?php
namespace WarehouseCore\Repository\Media;

use WarehouseCore\Contract\Repository;
use WarehouseCore\Payload\Map\PdoExceptionMapper;

use WarehouseCore\Payload\VO\PhotoVO;

final class ContainerPhotoRepository extends Repository {
    public function hydrate(
        array $raw
    ): PhotoVO {
        return PhotoVO::fromContainerRaw($raw);
    }

    public function getByContainerId(
        int $container_id
    ): array {
        return $this->entities(
            "SELECT * FROM {$this->table}
            WHERE container_id = :container_id",
            [
                ':container_id' => $container_id
            ]
        );
    }

    public function getByStoredFileId(
        int $stored_file_id
    ): ?PhotoVO {
        return $this->entity(
            "SELECT * FROM {$this->table}
            WHERE stored_file_id = :stored_file_id",
            [
                ':stored_file_id' => $stored_file_id
            ]
        );
    }

    public function add(
        int $container_id,
        int $stored_file_id
    ): void {
        try {
            $this->insert(
                "INSERT INTO {$this->table}
                (
                    container_id,
                    stored_file_id
                )
                VALUES
                (
                    :container_id,
                    :stored_file_id
                )",
                [
                    ':container_id' => $container_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }

    public function delete(
        int $container_id,
        int $stored_file_id
    ): void {
        try {
            $this->execute(
                "DELETE FROM {$this->table}
                WHERE container_id = :container_id
                AND stored_file_id = :stored_file_id",
                [
                    ':container_id' => $container_id,
                    ':stored_file_id' => $stored_file_id
                ]
            );
        } catch (\PDOException $e) {
            throw PdoExceptionMapper::map($e);
        }
    }
}