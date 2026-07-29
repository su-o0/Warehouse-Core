<?php
namespace WarehouseCore\Api\Topology;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Payload\Request\ActivateLocationRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\LocationStatus;
use WarehouseCore\Service\Query\GetService;
use WarehouseCore\Service\Topology\LocationService;

final class ActivateLocationApi {
    public function __construct(
        public string $api_name,
        private LocationService $location,
        private GetService $get,
    ) { }

    public function handle(
        ActivateLocationRequest $request
    ): ServiceResult {
        try {
            $result = $this->get->getLocation($request->id);
        } catch (DomainException $e) {
            return new ServiceResult(success: false, message: $e->getMessage());
        }  

        if ($result->status == LocationStatus::Created or $result->status == LocationStatus::Archived){
            return new ServiceResult(
                success: true,
                entity: $this->location->setActive(
                    $result->id
                )
            );
        }
        
        return new ServiceResult(
            success: false, 
            message: ErrorMessage::LOCATION_INVALID_STATUS
        );  
    }
}