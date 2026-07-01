<?php
namespace WarehouseCore\Service\Movement;
use WarehouseCore\Service\Placement\SetPlacementService;
use WarehouseCore\Payload\Result\ServiceResult;

class PutIntoContainerService {
    public function __construct(
        private SetPlacementService $SetPlacement
    ) {}

    public function execute(string $EntityType, int $EntityId, int $ContainerId): ServiceResult {
        try {
            switch($EntityType) {
                case 'Item':
                    $res = $this->SetPlacement->execute('Item', $EntityId, $ContainerId);
                    return ($res instanceof ServiceResult) ? $res : new ServiceResult(true, null, null);
                case 'Stock':
                    $res = $this->SetPlacement->execute('Stock', $EntityId, $ContainerId);
                    return ($res instanceof ServiceResult) ? $res : new ServiceResult(true, null, null);
                default:
                    return new ServiceResult(false, null, "Невозможно поместить сущность типа $EntityType в контейнер");
            }
        } catch(\RuntimeException $e) {
            return new ServiceResult(false, null, $e->getMessage());
        }
    }
}