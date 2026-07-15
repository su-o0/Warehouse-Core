<?php
namespace WarehouseCore\Service\Media;

use WarehouseCore\Payload\DTO\UserEntity;
use WarehouseCore\Repository\Media\ItemPhotoRepository;
use WarehouseCore\Repository\Media\PartPhotoRepository;
use WarehouseCore\Repository\Media\StockPhotoRepository;
use WarehouseCore\Repository\Media\VehiclePhotoRepository;
use WarehouseCore\Security\Authorization;

final class PhotoService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private PartPhotoRepository $part_photo_repository,
        private ItemPhotoRepository $item_photo_repository,
        private StockPhotoRepository $stock_photo_repository,
        private VehiclePhotoRepository $vehicle_photo_repository
    ) { }

    public function addItemPhoto(
        UserEntity $user,
        int $item_id,
        string $file_path
    ): int {
        return $this->item_photo_repository->add(
            $user->id,
            $item_id, 
            $file_path
        );
    }

    public function addStockPhoto(
        UserEntity $user,
        int $stock_id,
        string $file_path
    ): int {
        return $this->stock_photo_repository->add(
            $user->id,
            $stock_id, 
            $file_path
        );
    }

    public function addVehiclePhoto(
        UserEntity $user,
        int $vehicle_id,
        string $file_path
    ): int {
        return $this->vehicle_photo_repository->add(
            $user->id, 
            $vehicle_id, 
            $file_path
        );
    }

    public function deleteItemPhoto(
        UserEntity $user,
        int $item_photo_id
    ): void {
        if ($user->name != 'root') {
            return ;
        }
        $this->item_photo_repository->delete(
            $item_photo_id
        );
    }

    public function deleteStockPhoto(
        UserEntity $user,
        int $stock_photo_id
    ): void {
        if ($user->name != 'root') {
            return ;
        }
        $this->stock_photo_repository->delete(
            $stock_photo_id
        );
    }

    public function deleteVenichePhoto(
        UserEntity $user,
        int $vehicle_photo_id
    ): void {
        if ($user->name != 'root') {
            return ;
        }
        $this->vehicle_photo_repository->delete(
            $vehicle_photo_id
        );
    }
}