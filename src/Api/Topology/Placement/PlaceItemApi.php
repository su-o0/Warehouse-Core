<?php
namespace WarehouseCore\Api\Topology;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Payload\Request\PlaceApiRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\ItemProcessingStage;
use WarehouseCore\Payload\Type\PlacementEntity;
use WarehouseCore\Payload\Type\PlacementTarget;
use WarehouseCore\Service\Inventory\ItemService;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\Topology\PlacementService;

final class PlaceItemApi {
    public function __construct(
        public string $api_name,
        private PlacementService $placement,
        private ItemService $item,
        private GetService $get,
        private FindService $find
    ) { }

    public function handle(
        PlaceApiRequest $request
    ): ApiResult {
        if ($request->entity != PlacementEntity::Item) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::PLACEMENT_ENTITY_INVALID_TYPE
            );
        }

        $result = $this->find->findItemByPhysicalTag(
            $request->entity_id
        );

        if($result->entity === null){
            return new ServiceResult(
                success: false,
                message: $result->message
            );
        }
            
        $item = $result->entity;
        $steps = [];

        try {
            $steps = $this->get->getAllItemProcessingStep($item->id);
        } catch (DomainException $e) {
            if ($e->errorCode !== ErrorCode::ITEM_PROCESSING_STEP_NOT_FOUND) {
                return new ServiceResult(
                    success: false,
                    message: $e->getMessage()
                );
            }
        }

        foreach ($steps as $step) {
            if ($step->stage === ItemProcessingStage::Placement) {
                return new ServiceResult(
                    success: false,
                    message: ErrorMessage::ITEM_ALREADY_PLACED
                );
            }
        }

        $stages = count($steps);

        switch ($request->target) {
            case PlacementTarget::Location: 
                try {
                    $result = $this->get->getLocation($request->target_id);

                    $this->placement->placeItemToLocation(
                        $request->target_id,
                        $item->id
                    );

                } catch (DomainException $e ) {
                    return new ServiceResult(success: false, message: $e->getMessage());
                }  
                break;
            case PlacementTarget::Container: 
                try {
                    $result = $this->get->getContainer($request->target_id);

                    $this->placement->placeItemToContainer(
                        $request->target_id,
                        $item->id
                    );
                } catch (DomainException $e ) {
                    return new ServiceResult(success: false, message: $e->getMessage());
                }  
                break;

            default:
                return new ServiceResult(
                    success: false,
                    message: DomainException::PLACEMENT_TARGET_INVALID_TYPE()
                );
        }
    
        $result = $this->item->stagePlacement(
            $item->id,
            [
                'target_type' => $request->target->value,
                'target_id' => $request->target_id,
            ]
        );

        if($stages == 0) {
            $this->item->setProcessing($item->id);
        }
            
        $required_stages = count(ItemProcessingStage::cases());
        if($stages == $required_stages - 1) {
            $this->item->setActive($item->id);
        }

        if (!$result->success) {
            return $result;
        }

        return new ServiceResult(
            success: true
        );
    }
}