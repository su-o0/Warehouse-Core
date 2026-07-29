<?php
namespace WarehouseCore\Facade;

use WarehouseCore\Bootstrap\Bootstrap;
use WarehouseCore\Api\ApiHandler;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Payload\Type\ProviderType;
use WarehouseCore\Payload\Map\ProviderTypeMapper;

use WarehouseCore\Registry\OutputFactory;
use WarehouseCore\Output\Output;
use WarehouseCore\Payload\Result\ServiceResult;

use WarehouseCore\Context\ServiceContext;
use WarehouseCore\Security\Authorization;

final class CliFacade {
    private ApiHandler $api;
    private Output $output;

    public function __construct (
        private Bootstrap $setup,
        private ProviderType $provider
    ) {
        $this->output = OutputFactory::Output($this->provider);
    }

    public static function create(): self {
        return new self ( 
            Bootstrap::create(),
            ProviderType::Cli
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

    public function createUser(
        string $name, 
        string $role
    ): string {
        $result = $this->api->createUser([
            'name' => $name,
            'role' => $role
        ]);

        return $this->output->render($result);
    }

    public function createLocation(
        string $zone,
        string $rack,
        string $shelf
    ): string {
        $result = $this->api->createLocation([
            'zone' => $zone,
            'rack' => $rack,
            'shelf' => $shelf
        ]);

        return $this->output->render($result);
    }

    public function createContainer(
        int $id,
        string $type
    ): string {
        $result = $this->api->createContainer([
            'id' => $id,
            'type' => $type
        ]);

        return $this->output->render($result);
    }

    public function createPhysicalTag(
        int $id,
    ): string {
        $result = $this->api->createPhysicalTag([
            'id' => $id,
        ]);

        return $this->output->render($result);
    }

    public function activateLocation(
        int $id,
    ): string {
        $result = $this->api->activateLocation([
            'id' => $id,
        ]);

        return $this->output->render($result);
    }

    public function archiveLocation(
        int $id,
    ) : string {
        $result = $this->api->archiveLocation([
            'id' => $id,
        ]);

        return $this->output->render($result);
    }

    public function getLocation(
        int $id,
    ) : string {
        $result = $this->api->getLocation([
            'id' => $id,
        ]);

        return $this->output->render($result);
    }

    public function listLocations(): string {
        $result = $this->api->listLocations();

        return $this->output->render($result);
    }
}