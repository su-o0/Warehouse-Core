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

        return $this->output->render(new ServiceResult(success: true));
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
                'id' => $area_id
            ])
        );
    }

    public function archiveArea(
        int $area_id
    ): string {
        return $this->output->render(
            $this->api->archiveArea([
                'id' => $area_id
            ])
        );
    }

    public function markAreaAsCrowded(
        int $area_id
    ): string {
        return $this->output->render(
            $this->api->markAreaAsCrowded([
                'id' => $area_id
            ])
        );
    }

    public function grantAreaAccess(
        int $area_id,
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->grantAreaAccess([
                'first_id' => $area_id,
                'second_id' => $user_id
            ])
        );
    }

    public function revokeAreaAccess(
        int $area_id,
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->revokeAreaAccess([
                'first_id' => $area_id,
                'second_id' => $user_id
            ])
        );
    }

    public function addAreaName(
        int $area_id,
        string $name
    ): string {
        return $this->output->render(
            $this->api->addAreaName([
                'id' => $area_id,
                'value' => $name
            ])
        );
    }

    public function removeAreaName(
        int $area_id,
    ): string {
        return $this->output->render(
            $this->api->removeAreaName([
                'id' => $area_id
            ])
        );
    }

    public function setPrimaryAreaName(
        int $area_id,
        int $record_id,
    ): string {
        return $this->output->render(
            $this->api->setPrimaryAreaName([
                'id' => $area_id,
                'record_id' => $record_id
            ])
        );
    }

    public function listArea(): string {
        return $this->output->render(
            $this->api->listArea()
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
                'id' => $zone_id,
                'value' => $name
            ])
        );
    }

    public function setPrimaryZoneName(
        int $zone_id,
        int $record_id,
    ): string {
        return $this->output->render(
            $this->api->setPrimaryZoneName([
                'id' => $zone_id,
                'record_id' => $record_id
            ])
        );
    }

    public function removeZoneName(
        int $zone_id,
    ): string {
        return $this->output->render(
            $this->api->removeZoneName([
                'id' => $zone_id
            ])
        );
    }
    
    public function createZone(
        int $area_id
    ): string {
        return $this->output->render(
            $this->api->createZone([
                'id' => $area_id
            ])
        );
    }

    public function activateZone(
        int $zone_id
    ): string {
        return $this->output->render(
            $this->api->activateZone([
                'id' => $zone_id
            ])
        );
    }

    public function archiveZone(
        int $zone_id
    ): string {
        return $this->output->render(
            $this->api->archiveZone([
                'id' => $zone_id
            ])
        );
    }

    public function markZoneAsCrowded(
        int $zone_id
    ): string {
        return $this->output->render(
            $this->api->markZoneAsCrowded([
                'id' => $zone_id
            ])
        );
    }

    public function listZoneByArea(
        int $area_id
    ): string {
        return $this->output->render(
            $this->api->listZoneByArea([
                'id' => $area_id
            ])
        );
    }

    public function listAreaNames(
        int $area_id
    ): string {
        return $this->output->render(
            $this->api->listAreaNames([
                'id' => $area_id
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
                'id' => $user_id,
                'value' => $role
            ])
        );
    }

    public function dismissUserRole(
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->dismissUserRole([
                'id' => $user_id
            ])
        );
    }

    public function addUserName(
        int $user_id,
        string $name
    ): string {
        return $this->output->render(
            $this->api->addUserName([
                'id' => $user_id,
                'value' => $name
            ])
        );
    }

    public function setPrimaryUserName(
        int $user_id,
        int $record_id
    ): string {
        return $this->output->render(
            $this->api->setPrimaryUserName([
                'id' => $user_id,
                'record_id' => $record_id
            ])
        );
    }

    public function removeUserName(
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->removeUserName([
                'id' => $user_id
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
                'id' => $user_id
            ])
        );
    }

    public function listUserNames(
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->listUserNames([
                'id' => $user_id
            ])
        );
    }

    public function activateUser(
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->activateUser([
                'id' => $user_id
            ])
        );
    }

    public function archiveUser(
        int $user_id
    ): string {
        return $this->output->render(
            $this->api->archiveUser([
                'id' => $user_id
            ])
        );
    }
}