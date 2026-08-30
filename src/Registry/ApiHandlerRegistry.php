<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Registry\ApiRegistry;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\ValidationException;
use WarehouseCore\Payload\Request\AreaAccessRequest;
use WarehouseCore\Payload\Request\AreaNameRequest;
use WarehouseCore\Payload\Request\AreaRequest;
use WarehouseCore\Payload\Request\AssignPhysicalTagRequest;
use WarehouseCore\Payload\Request\CreateContainerRequest;
use WarehouseCore\Payload\Request\CreatePhysicalTagRequest;
use WarehouseCore\Payload\Request\CreateUserIdentityRequest;
use WarehouseCore\Payload\Request\CreateUserRequest;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Payload\Request\PlaceApiRequest;
use WarehouseCore\Payload\Request\RecordRequest;
use WarehouseCore\Payload\Request\ValueNameRequest;

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
            EntityRequest::fromRaw($raw)
        );
    }

    public function archiveArea(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->archiveArea(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function markAreaAsCrowded(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->markAreaAsCrowded(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function grantAreaAccess(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->grantAreaAccess(),
            AreaAccessRequest::fromRaw($raw)
        );
    }

    public function revokeAreaAccess(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->revokeAreaAccess(),
            AreaAccessRequest::fromRaw($raw)
        );
    }

    public function addAreaName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->addAreaName(),
            ValueNameRequest::fromRaw($raw)
        );
    }

    public function removeAreaName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->removeAreaName(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function setPrimaryAreaName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->setPrimaryAreaName(),
            RecordRequest::fromRaw($raw)
        );
    }

    public function listArea(): ApiResult {
        return $this->handle(
            $this->api->listArea(),
            null
        );
    }

    public function addZoneName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->addZoneName(),
            ValueNameRequest::fromRaw($raw)
        );
    }

    public function setPrimaryZoneName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->setPrimaryZoneName(),
            RecordRequest::fromRaw($raw)
        );
    }

    public function removeZoneName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->removeZoneName(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function createZone(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->createZone(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function activateZone(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->activateZone(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function archiveZone(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->archiveZone(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function markZoneAsCrowded(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->archiveZone(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function listZoneByArea(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->listZoneByArea(),
            EntityRequest::fromRaw($raw)
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