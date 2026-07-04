<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Repository\Identity\UserIdentityRepository;

final class UserIdentityService {
    public function __construct(
        private UserIdentityRepository $repository
    ) { }

}