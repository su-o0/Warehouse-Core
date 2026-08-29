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
                'id' => $area_id,
                'name' => $name
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
        int $record_id,
    ): string {
        return $this->output->render(
            $this->api->setPrimaryAreaName([
                'record_id' => $record_id
            ])
        );
    }

    public function listArea(): string {
        return $this->output->render(
            $this->api->listArea()
        );
    }

    // public function createUser(
    //     string $name, 
    //     string $role
    // ): string {
    //     $result = $this->api->createUser([
    //         'name' => $name,
    //         'role' => $role
    //     ]);

    //     return $this->output->render($result);
    // }

    // public function createContainer(
    //     int $id,
    //     string $type
    // ): string {
    //     $result = $this->api->createContainer([
    //         'id' => $id,
    //         'type' => $type
    //     ]);

    //     return $this->output->render($result);
    // }

    // public function createPhysicalTag(
    //     int $id,
    // ): string {
    //     $result = $this->api->createPhysicalTag([
    //         'id' => $id,
    //     ]);

    //     return $this->output->render($result);
    // }

    // public function placeItem(
    //     int $id,
    //     string $target_type,
    //     int $target_id
    // ) : string {
    //     $result = $this->api->placeItem([
    //         'entity' => 'Item',
    //         'target' => $target_type,
    //         'entity_id' => $id,
    //         'target_id' => $target_id
    //     ]);

    //     return $this->output->render($result);
    // }
}