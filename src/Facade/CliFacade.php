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
    
    /*
    public function createUserIdentity(
        int $user_id, 
        string $provider,
        string $external_id
    ): string {
        try {
            $provider_value = ProviderTypeMapper::fromString($provider);
        }catch(DomainException $e) {
            return $this->output->render(new ServiceResult(
                    success: false,
                    message: $e->getMessage()
                )
            );
        }

        $result = $this->service->find()->findUserById(
            $this->authorization_service,
            $user_id
        );

        if (!$result->success) {
            return $this->output->render($result);
        }

        $result = $this->service->find()->findUserIdentity(
            $this->authorization_service,
            $provider_value,
            $external_id
        );

        if($result->success){
            return $this->output->render( 
                new ServiceResult(
                    success: false,
                    message: DomainException::USER_IDENTITY_EXISTS()->getMessage()
                )
            );
        }

        $identity = $this->service->userIdentity()->create(
            $this->authorization_service,
            $user_id,
            $provider,
            $external_id
        );

        return $this->output->render($identity);
    }

    public function createItem(
        string $article,
        ?int $venicle_id = null
    ): string {
        $result = $this->service->find()->findPartIdByArticle(
            $this->authorization_service,
            $article
        );

        if(!$result->success) {
            return $this->output->render($result);
        }

        if($result->entity === null) {
            $result = $this->service->part()->create($article);
        }






    }
        */
}