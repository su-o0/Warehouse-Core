<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Repository\Identity\UserIdentityRepository;
use WarehouseCore\Repository\Identity\UserRepository;

use WarehouseCore\Exception\DomainException;

use WarehouseCore\Payload\Result\SetupResult;

final class UserIdentityService {
    public function __construct(
        private UserRepository $user_repository,
        private UserIdentityRepository $user_identity_repository
    ) { }

    public function create(
        int $user_id,
        string $provider,
        string $external_id
    ): SetupResult {

        $user = $this->user_repository->findById($user_id);
        if (!$user) {
            return new SetupResult(
                success: false,
                message: DomainException::USER_NOT_FOUND()->getMessage()
            );
        }

        $identity = $this->user_identity_repository->add(
            $user_id,
            $provider,
            $external_id
        );


        return new SetupResult(
            success: true
        );

    }

}