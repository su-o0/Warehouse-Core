<?php
namespace WarehouseCore\Service\Media;

use WarehouseCore\Repository\Media\ItemPhotoRepository;
use WarehouseCore\Repository\Media\StockPhotoRepository;
use WarehouseCore\Repository\Media\VehiclePhotoRepository;

final class PhotoService {
    public function __construct(
        private ItemPhotoRepository $item_photo_repository,
        private StockPhotoRepository $stock_photo_repository,
        private VehiclePhotoRepository $vehicle_photo_repository
    ) { }

    public function addItemPhoto(
        int $item_id,
        string $file_path
    ): int {
        return $this->item_photo_repository->add($item_id, $file_path);
    }

    public function addStockPhoto(
        int $stock_id,
        string $file_path
    ): int {
        return $this->stock_photo_repository->add($stock_id, $file_path);
    }

    public function addVehiclePhoto(
        int $vehicle_id,
        string $file_path
    ): int {
        return $this->vehicle_photo_repository->add($vehicle_id, $file_path);
    }

     

    public function deleteItemPhoto(
        int $id
    ): bool {
        return $this->item_photo_repository->delete($id);
    }
}