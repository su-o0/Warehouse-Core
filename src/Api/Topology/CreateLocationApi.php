<?php
namespace WarehouseCore\Api\Topology;

use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Payload\Request\CreateLocationRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\Query\FindService;
use WarehouseCore\Service\Topology\LocationService;

final class CreateLocationApi {
    public function __construct(
        public string $api_name,
        private LocationService $location,
        private FindService $find,
    ) { }

    public function handle(
        CreateLocationRequest $request
    ): ServiceResult {
        $result = $this->find->findLocationByAddress($request->address);

        if (!$result->success) {
            return $result;
        }

        if($result->entity !== null) {
            return new ServiceResult(
                success: false, 
                message: ErrorMessage::LOCATION_ALREADY_EXISTS
            );
        }

        return $this->location->create(
            $request->address
        );
    }
}