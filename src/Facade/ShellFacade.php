<?php
namespace WarehouseCore\Facade;

use WarehouseCore\Bootstrap\Bootstrap;
use WarehouseCore\Registry\ApiHandlerRegistry;
use WarehouseCore\Output\Output;
use WarehouseCore\Payload\Result\ServiceResult;

use WarehouseCore\Context\ServiceContext;
use WarehouseCore\Payload\Enum\ProviderNameEnum;
use WarehouseCore\Security\Authorization;

final class ShellFacade {
    private ApiHandlerRegistry $api;
    private Output $output;

    public function __construct (
        private Bootstrap $setup,
        private ProviderNameEnum $provider
    ) {
        $this->output = Output::create(
            $this->provider
        );
    }

    public static function create(): self {
        return new self ( 
            Bootstrap::create(),
            ProviderNameEnum::Shell
        );
    }

    public function authenticate(): string {
        $authenticate_service = $this->setup->buildAuthentication();

        $result = $authenticate_service->authenticate($this->provider, 'root');

        if (!$result->success) {
            return $this->output->render($result);
        }

        $session = $result->entity;

        $this->api = $this->setup->buildApi(
            new ServiceContext(
                $session,
                Authorization::fromSession($session),
                $this->setup->buildService()
            )
        );

        return $this->output->render(
            ServiceResult::success()
        );
    }

    public function isAuthenticated(): bool {
        return isset($this->api);
    }
 
    public function createArea(): string {
        return $this->output->render(
            $this->api->createArea()
        );
    }

    public function activateArea(
        int $area_id
    ): string {
        return $this->output->render(
            $this->api->activateArea([
                'area_id' => $area_id
            ])
        );
    }

    public function archiveArea(
        int $area_id
    ): string {
        return $this->output->render(
            $this->api->archiveArea([
                'area_id' => $area_id
            ])
        );
    }

    public function markAreaAsCrowded(
        int $area_id
    ): string {
        return $this->output->render(
            $this->api->markAreaAsCrowded([
                'area_id' => $area_id
            ])
        );
    }

    public function grantAreaAccess(
        int $area_id,
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->grantAreaAccess([
                'area_id' => $area_id,
                'user_id' => $user_id
            ])
        );
    }

    public function revokeAreaAccess(
        int $area_id,
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->revokeAreaAccess([
                'area_id' => $area_id,
                'user_id' => $user_id
            ])
        );
    }

    public function addAreaName(
        int $area_id,
        string $name
    ): string {
        return $this->output->render(
            $this->api->addAreaName([
                'area_id' => $area_id,
                'name' => $name
            ])
        );
    }

    public function removeAreaName(
        int $area_id,
    ): string {
        return $this->output->render(
            $this->api->removeAreaName([
                'area_id' => $area_id
            ])
        );
    }

    public function setPrimaryAreaName(
        int $area_id,
        int $record_id,
    ): string {
        return $this->output->render(
            $this->api->setPrimaryAreaName([
                'area_id' => $area_id,
                'record_id' => $record_id
            ])
        );
    }

    public function listArea(): string {
        return $this->output->render(
            $this->api->listArea()
        );
    }
    
    public function listZone(): string {
        return $this->output->render(
            $this->api->listZone()
        );
    }

    public function listUser(): string {
        return $this->output->render(
            $this->api->listUser()
        );
    }

    public function addZoneName(
        int $zone_id,
        string $name
    ): string {
        return $this->output->render(
            $this->api->addZoneName([
                'zone_id' => $zone_id,
                'name' => $name
            ])
        );
    }

    public function setPrimaryZoneName(
        int $zone_id,
        int $record_id,
    ): string {
        return $this->output->render(
            $this->api->setPrimaryZoneName([
                'zone_id' => $zone_id,
                'record_id' => $record_id
            ])
        );
    }

    public function removeZoneName(
        int $zone_id,
    ): string {
        return $this->output->render(
            $this->api->removeZoneName([
                'zone_id' => $zone_id
            ])
        );
    }
    
    public function createZone(): string {
        return $this->output->render(
            $this->api->createZone()
        );
    }

    public function activateZone(
        int $zone_id
    ): string {
        return $this->output->render(
            $this->api->activateZone([
                'zone_id' => $zone_id
            ])
        );
    }

    public function archiveZone(
        int $zone_id
    ): string {
        return $this->output->render(
            $this->api->archiveZone([
                'zone_id' => $zone_id
            ])
        );
    }

    public function markZoneAsCrowded(
        int $zone_id
    ): string {
        return $this->output->render(
            $this->api->markZoneAsCrowded([
                'zone_id' => $zone_id
            ])
        );
    }

    public function listZoneByArea(
        int $area_id
    ): string {
        return $this->output->render(
            $this->api->listZoneByArea([
                'area_id' => $area_id
            ])
        );
    }

    public function listAreaNames(
        int $area_id
    ): string {
        return $this->output->render(
            $this->api->listAreaNames([
                'area_id' => $area_id
            ])
        );
    }

    public function createUser(): string {
        return $this->output->render(
            $this->api->createUser()
        );
    }

    public function assignUserRole(
        int $user_id,
        string $role
    ): string {
        return $this->output->render(
            $this->api->assignUserRole([
                'user_id' => $user_id,
                'role' => $role
            ])
        );
    }

    public function dismissUserRole(
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->dismissUserRole([
                'user_id' => $user_id
            ])
        );
    }

    public function addUserName(
        int $user_id,
        string $name
    ): string {
        return $this->output->render(
            $this->api->addUserName([
                'user_id' => $user_id,
                'name' => $name
            ])
        );
    }

    public function setPrimaryUserName(
        int $user_id,
        int $record_id
    ): string {
        return $this->output->render(
            $this->api->setPrimaryUserName([
                'user_id' => $user_id,
                'record_id' => $record_id
            ])
        );
    }

    public function removeUserName(
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->removeUserName([
                'user_id' => $user_id
            ])
        );
    }

    public function addUserIdentity(
        int $user_id,
        string $provider,
        string $external_id
    ): string {
        return $this->output->render(
            $this->api->addUserIdentity([
                'user_id' => $user_id,
                'provider' => $provider,
                'external_id' => $external_id
            ])
        );
    }

    public function removeUserIdentity(
        int $user_id,
        string $provider
    ): string {
        return $this->output->render(
            $this->api->removeUserIdentity([
                'user_id' => $user_id,
                'provider' => $provider
            ])
        );
    }

    public function listUserIdentities(
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->listUserIdentities([
                'user_id' => $user_id
            ])
        );
    }

    public function listUserNames(
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->listUserNames([
                'user_id' => $user_id
            ])
        );
    }

    public function activateUser(
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->activateUser([
                'user_id' => $user_id
            ])
        );
    }

    public function archiveUser(
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->archiveUser([
                'user_id' => $user_id
            ])
        );
    }

    public function registerRack(
        string $rack_type
    ): string {
        return $this->output->render(
            $this->api->registerRack([
                'rack_type' => $rack_type
            ])
        );
    }

    public function populateRack(
        int $rack_id,
        int $count
    ): string {
        return $this->output->render(
            $this->api->populateRack([
                'rack_id' => $rack_id,
                'record_id' => $count
            ])
        );
    }

    public function activateRack(
        int $rack_id,
    ): string {
        return $this->output->render(
            $this->api->activateRack([
                'rack_id' => $rack_id,
            ])
        );
    }

    public function archiveRack(
        int $rack_id,
    ): string {
        return $this->output->render(
            $this->api->archiveRack([
                'rack_id' => $rack_id,
            ])
        );
    }

    public function registerShelf(
        int $rack_id,
    ): string {
        return $this->output->render(
            $this->api->registerShelf([
                'rack_id' => $rack_id,
            ])
        );
    }

    public function markShelfAsCrowded(
        int $rack_id,
        int $shelf_level,
    ): string {
        return $this->output->render(
            $this->api->markShelfAsCrowded([
                'rack_id' => $rack_id,
                'shelf_level' => $shelf_level,
            ])
        );
    }

    public function removeShelf(
        int $rack_id,
        int $shelf_level,
    ): string {
        return $this->output->render(
            $this->api->removeShelf([
                'rack_id' => $rack_id,
                'shelf_level' => $shelf_level,
            ])
        );
    }

    public function registerStorageSlot(
        int $rack_id,
    ): string {
        return $this->output->render(
            $this->api->registerStorageSlot([
                'rack_id' => $rack_id,
            ])
        );
    }

    public function markStorageSlotAsCrowded(
        int $rack_id,
        int $slot_position,
    ): string {
        return $this->output->render(
            $this->api->markStorageSlotAsCrowded([
                'rack_id' => $rack_id,
                'slot_position' => $slot_position,
            ])
        );
    }

    public function removeStorageSlot(
        int $rack_id,
        int $slot_position,
    ): string {
        return $this->output->render(
            $this->api->removeStorageSlot([
                'rack_id' => $rack_id,
                'slot_position' => $slot_position,
            ])
        );
    }

    public function addRackName(
        int $rack_id,
        string $name,
    ): string {
        return $this->output->render(
            $this->api->addRackName([
                'rack_id' => $rack_id,
                'name' => $name,
            ])
        );
    }

    public function setPrimaryRackName(
        int $rack_id,
        int $record_id,
    ): string {
        return $this->output->render(
            $this->api->addRackName([
                'rack_id' => $rack_id,
                'record_id' => $record_id,
            ])
        );
    }

    public function removeRackName(
        int $rack_id
    ): string {
        return $this->output->render(
            $this->api->addRackName([
                'rack_id' => $rack_id
            ])
        );
    }

    public function placeZoneToArea(
        int $zone_id,
        int $area_id
    ): string {
        return $this->output->render(
            $this->api->placeZoneToArea([
                'zone_id' => $zone_id,
                'area_id' => $area_id
            ])
        );
    }
}