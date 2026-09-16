<?php
namespace WarehouseCore\Registry;

use WarehouseCore\Context\ParameterBag;
use WarehouseCore\Contract\ApiResult;
use WarehouseCore\Registry\ApiRegistry;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\ValidationException;

final class ApiHandlerRegistry {
    public function __construct(
        private ApiRegistry $api
    ) { }

    private function handle(
        callable $api,
        ?array $raw = null
    ): ApiResult {
        try {
            $api = $api();
            if ($raw !== null) {
                $request = new ParameterBag(
                    raw: $raw,
                    parameters: $api->config->parameters,
                );
                return $api->handle($request);  
            }
            else {
                return $api->handle();  
            }
        } catch (ValidationException $e) {
            return ServiceResult::failure(
                $e->getMessage()
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
            return ServiceResult::failure(
                ErrorMessage::SERVICE_UNAVAILABLE
            );
        }   
    }

    public function createArea(): ApiResult{
        return $this->handle(
            $this->api->createArea(...)
        );
    }

    public function activateArea(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->activateArea(...),
            $raw
        );
    }

    public function archiveArea(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->archiveArea(...),
            $raw
        );
    }

    public function markAreaAsCrowded(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->markAreaAsCrowded(...),
            $raw
        );
    }

    public function grantAreaAccess(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->grantAreaAccess(...),
            $raw
        );
    }

    public function revokeAreaAccess(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->revokeAreaAccess(...),
            $raw
        );
    }

    public function addAreaName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->addAreaName(...),
            $raw
        );
    }

    public function removeAreaName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->removeAreaName(...),
            $raw
        );
    }

    public function setPrimaryAreaName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->setPrimaryAreaName(...),
            $raw
        );
    }

    public function listArea(): ApiResult {
        return $this->handle(
            $this->api->listArea(...)
        );
    }

    public function listAreaNames(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->listAreaNames(...),
            $raw
        );
    }

    public function addZoneName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->addZoneName(...),
            $raw
        );
    }

    public function setPrimaryZoneName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->setPrimaryZoneName(...),
            $raw
        );
    }

    public function removeZoneName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->removeZoneName(...),
            $raw
        );
    }

    public function createZone(): ApiResult {
        return $this->handle(
            $this->api->createZone(...)
        );
    }

    public function activateZone(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->activateZone(...),
            $raw
        );
    }

    public function archiveZone(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->archiveZone(...),
            $raw
        );
    }

    public function markZoneAsCrowded(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->archiveZone(...),
            $raw
        );
    }

    public function listZone(): ApiResult {
        return $this->handle(
            $this->api->listZone(...)
        );
    }

    public function listZoneByArea(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->listZoneByArea(...),
            $raw
        );
    }
    
    public function listZoneNames(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->listZoneNames(...),
            $raw
        );
    }

    public function createUser(): ApiResult{
        return $this->handle(
            $this->api->createUser(...),
            null
        );
    }

    public function assignUserRole(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->assignUserRole(...),
            $raw
        );
    }

    public function dismissUserRole(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->dismissUserRole(...),
            $raw
        );
    }

    public function addUserName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->addUserName(...),
            $raw
        );
    }

    public function setPrimaryUserName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->setPrimaryUserName(...),
            $raw
        );
    }

    public function removeUserName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->removeUserName(...),
            $raw
        );
    }

    public function addUserIdentity(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->addUserIdentity(...),
            $raw
        );
    }

    public function removeUserIdentity(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->removeUserIdentity(...),
            $raw
        );
    }

    public function listUser(): ApiResult {
        return $this->handle(
            $this->api->listUser(...)
        );
    }

    public function listUserIdentities(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->listUserIdentities(...),
            $raw
        );
    }

    public function listUserNames(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->listUserNames(...),
            $raw
        );
    }

    public function activateUser(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->activateUser(...),
            $raw
        );
    }
    
    public function archiveUser(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->archiveUser(...),
            $raw
        );
    }

    public function registerRack(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->registerRack(...),
            $raw
        );
    }

    public function populateRack(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->populateRack(...),
            $raw
        );
    }
    
    public function activateRack(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->activateRack(...),
            $raw
        );
    }

    public function archiveRack(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->archiveRack(...),
            $raw
        );
    }

    public function registerShelf(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->registerShelf(...),
            $raw
        );
    }

    public function markShelfAsCrowded(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->markShelfAsCrowded(...),
            $raw
        );
    }

    public function removeShelf(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->removeShelf(...),
            $raw
        );
    }

    public function registerStorageSlot(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->registerShelf(...),
            $raw
        );
    }

    public function markStorageSlotAsCrowded(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->markShelfAsCrowded(...),
            $raw
        );
    }

    public function removeStorageSlot(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->removeStorageSlot(...),
            $raw
        );
    }

    public function addRackName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->addRackName(...),
            $raw
        );
    }

    public function setPrimaryRackName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->setPrimaryRackName(...),
            $raw
        );
    }

    public function removeRackName(
        array $raw
    ): ApiResult {
        return $this->handle(
            $this->api->removeRackName(...),
            $raw
        );
    }

    public function placeZoneToArea(
        array $raw
   ): ApiResult {
        return $this->handle(
            $this->api->placeZoneToArea(...),
            $raw
        );
    }
}