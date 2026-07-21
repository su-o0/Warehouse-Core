<?php 
namespace WarehouseCore\Service\Query;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\ServiceException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\ProviderType;
use WarehouseCore\Payload\Value\AddressValue;
use WarehouseCore\Repository\Catalog\PartAliasRepository;
use WarehouseCore\Repository\Catalog\PartRepository;
use WarehouseCore\Repository\Identity\RoleRepository;
use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Topology\LocationRepository;
use WarehouseCore\Security\Authorization;

final class FindService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private RoleRepository $role,
        private UserIdentityRepository $user_identity_repository,
        private UserRepository $user_repository,
        private LocationRepository $location_repository,
        private PartRepository $part_repository,
        private PartAliasRepository $part_alias_repository,
    ) { }

    public function findLocationByAddress(
        AddressValue $address
    ): ServiceResult {
        $result = $this->location_repository->findByAddress(
            $address->getValue()
        );

        if($result === null) {
            return new ServiceResult(
                success: true, 
                entity: null,
                message: ErrorMessage::LOCATION_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }
    public function findRoleByName(
        string $role
    ): ServiceResult {
        $result = $this->role->findByName($role);

        if($result === null) {
            return new ServiceResult(
                success: true, 
                entity: null,
                message: ErrorMessage::ROLE_NOT_FOUND
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }

    public function findPartIdByArticle(
        string $article
    ): ServiceResult {
         if (!$this->authorization->canFindArticle()) {
            return new ServiceResult(
                success: false,
                message: ServiceException::FORBIDDEN()->getMessage()
            );
        }

        $part = $this->part_repository->findByArticle($article);

        if ($part !== null) {
            return new ServiceResult(
                success: true,
                entity: $part->id
            );
        }
        
        $alias = $this->part_alias_repository->findByArticle($article);

        if ($alias !== null) {
            return new ServiceResult(
                success: true,
                entity: $alias->part_id
            );
        }

        return new ServiceResult(
            success: true,
            entity: null
        );
    }

    public function findUserIdentity(
        ProviderType $provider,
        string $external_id
    ): ServiceResult {
        if(!$this->authorization->canFindUser()){
            return new ServiceResult(
                success: false,
                message: ServiceException::FORBIDDEN()->getMessage()
            );
        }

        $result = $this->user_identity_repository->findByProviderAndId(
            $provider->value,
            $external_id
        );

        if($result === null) {
            return new ServiceResult(
                success: false,
                entity: null
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }


    public function getAllLocations(): array {
        return $this->location_repository->getAll();
    }

    public function findUserByName(
        string $name,
    ): ServiceResult {
        if(!$this->authorization->canFindUser()){
            return new ServiceResult(
                success: false,
                message: ServiceException::FORBIDDEN()->getMessage()
            );
        }

        $result = $this->user_repository->findByName($name);
        
        if($result === null) {
            return new ServiceResult(
                success: false,
                message: DomainException::USER_NOT_FOUND()->getMessage()
            );
        }

        return new ServiceResult(
            success: true,
            entity: $result
        );
    }
    
}