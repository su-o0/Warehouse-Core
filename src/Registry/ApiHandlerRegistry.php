<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Registry\ApiRegistry;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\ValidationException;
use WarehouseCore\Payload\Request\AreaRequest;
use WarehouseCore\Payload\Request\AssignPhysicalTagRequest;
use WarehouseCore\Payload\Request\CreateContainerRequest;
use WarehouseCore\Payload\Request\CreatePhysicalTagRequest;
use WarehouseCore\Payload\Request\CreateUserIdentityRequest;
use WarehouseCore\Payload\Request\CreateUserRequest;
use WarehouseCore\Payload\Request\PlaceApiRequest;

final class ApiHandlerRegistry {
    public function __construct(
        private ApiRegistry $api
    ) { }

    private function handle(
        object $api,
        ?object $request = null
    ): ApiResult {
        try {
            return $api->handle($request);
        } catch (ValidationException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        } catch (\Throwable $e) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::SERVICE_UNAVAILABLE
            );
        }
    }

    public function createArea(): ApiResult{
        return $this->handle(
            $this->api->createArea(),
        );
    }

    public function activateArea(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->activateArea(),
            AreaRequest::fromRaw($raw)
        );
    }

    public function archiveArea(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->archiveArea(),
            AreaRequest::fromRaw($raw)
        );
    }

    public function markAreaAsCrowded(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->markAreaAsCrowded(),
            AreaRequest::fromRaw($raw)
        );
    }

    // public function createUser(
    //     array $raw
    // ): ApiResult{
    //     return $this->handle(
    //         $this->api->createUser(),
    //         CreateUserRequest::fromRaw($raw)
    //     );
    // }

    // public function createUserIdentity(
    //     array $raw
    // ): ApiResult{
    //     return $this->handle(
    //         $this->api->createUserIdentity(),
    //         CreateUserIdentityRequest::fromRaw($raw)
    //     );
    // }

    // public function createContainer(
    //     array $raw
    // ): ApiResult{
    //     return $this->handle(
    //         $this->api->createContainer(),
    //         CreateContainerRequest::fromRaw($raw)
    //     );
    // }

    // public function createPhysicalTag(
    //     array $raw
    // ): ApiResult{
    //     return $this->handle( 
    //         $this->api->createPhysicalTag(),
    //         CreatePhysicalTagRequest::fromRaw($raw)
    //     );
    // }
    // public function assignPhysicalTag(
    //     array $raw
    // ): ApiResult{
    //     return $this->handle(
    //         $this->api->assignPhysicalTag(),
    //         AssignPhysicalTagRequest::fromRaw($raw)
    //     );
    // }


    // public function placeItem(
    //     array $raw
    // ): ApiResult{
    //     return $this->handle( 
    //         $this->api->placeItem(),
    //         PlaceApiRequest::fromRaw($raw)
    //     );
    // }
}