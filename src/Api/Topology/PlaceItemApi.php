<?php
namespace WarehouseCore\Api\Topology;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Payload\Request\PlaceApiRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\PlacementEntity;
use WarehouseCore\Payload\Type\PlacementTarget;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\Topology\LocationService;
use WarehouseCore\Service\Topology\PlacementService;

final class PlaceItemApi {
    public function __construct(
        public string $api_name,
        private PlacementService $placement,
        private GetService $get
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

        if ($request->target == PlacementTarget::Location) {
            try {
                $this->get->getLocation($request->target_id);
                $this->get->getItem($request->entity_id);
                
            } catch (DomainException $e ) {
                return new ServiceResult(
                    success: false,
                    message: $e->getMessage()
                );
            }  
        }
        else if ($request->target == PlacementTarget::Container) {
            try {
                $this->get->getContainer($request->target_id);
            } catch (DomainException $e ) {
                return new ServiceResult(
                    success: false,
                    message: $e->getMessage()
                );
            }
        }
        else {
            return new ServiceResult(
                success: false,
                message: DomainException::PLACEMENT_TARGET_INVALID_TYPE()
            );
        }
    }
}