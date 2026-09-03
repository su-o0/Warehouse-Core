<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Registry\ApiRegistry;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\ValidationException;
use WarehouseCore\Payload\Request\AddUserIdentityRequest;
use WarehouseCore\Payload\Request\EntityEntityRequest;
use WarehouseCore\Payload\Request\EntityRecordRequest;
use WarehouseCore\Payload\Request\EntityRequest;
use WarehouseCore\Payload\Request\EntityValueRequest;
use WarehouseCore\Payload\Request\UserIdentityRequest;

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
            var_dump([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'errorInfo' => $e->errorInfo,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
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
            EntityEntityRequest::fromRaw($raw)
        );
    }

    public function revokeAreaAccess(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->revokeAreaAccess(),
            EntityEntityRequest::fromRaw($raw)
        );
    }

    public function addAreaName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->addAreaName(),
            EntityValueRequest::fromRaw($raw)
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
            EntityRecordRequest::fromRaw($raw)
        );
    }

    public function listArea(): ApiResult {
        return $this->handle(
            $this->api->listArea(),
            null
        );
    }

    public function listUser(): ApiResult {
        return $this->handle(
            $this->api->listUser(),
            null
        );
    }

    public function addZoneName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->addZoneName(),
            EntityValueRequest::fromRaw($raw)
        );
    }

    public function setPrimaryZoneName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->setPrimaryZoneName(),
            EntityRecordRequest::fromRaw($raw)
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

    public function listAreaNames(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->listAreaNames(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function createUser(): ApiResult{
        return $this->handle(
            $this->api->createUser(),
            null
        );
    }

    public function assignUserRole(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->assignUserRole(),
            EntityValueRequest::fromRaw($raw)
        );
    }

    public function dismissUserRole(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->dismissUserRole(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function addUserName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->addUserName(),
            EntityValueRequest::fromRaw($raw)
        );
    }

    public function setPrimaryUserName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->setPrimaryUserName(),
            EntityRecordRequest::fromRaw($raw)
        );
    }

    public function removeUserName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->removeUserName(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function addUserIdentity(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->addUserIdentity(),
            AddUserIdentityRequest::fromRaw($raw)
        );
    }

    public function removeUserIdentity(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->removeUserIdentity(),
            UserIdentityRequest::fromRaw($raw)
        );
    }

    public function listUserIdentities(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->listUserIdentities(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function listUserNames(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->listUserNames(),
            EntityRequest::fromRaw($raw)
        );
    }

    public function activateUser(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->activateUser(),
            EntityRequest::fromRaw($raw)
        );
    }
    
    public function archiveUser(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->archiveUser(),
            EntityRequest::fromRaw($raw)
        );
    }
}