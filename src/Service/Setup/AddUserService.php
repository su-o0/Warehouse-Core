<?php
namespace WarehouseCore\Service\Setup;

use WarehouseCore\Payload\Result\AddUserResult;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Exception\StorageException;

final class AddUserService {
    public function __construct(
        private UserRepository $user,
    ) { }

    public function execute(
        string $telegram_id,
        string $name, 
        int $roleId
    ): AddUserResult {
        try {
            $id = $this->user->add($telegram_id, $name, $roleId);
        }
        catch (StorageException $e) {
            return new AddUserResult(
                success: false,
                message: $e->getMessage()
            );
        }
        
        return new AddUserResult(
            success: true,
            userId: $id
        );
    }
} 