<?php
namespace WarehouseCore\Service\Identity;

use WarehouseCore\Repository\Identity\PhysicalTagRepository;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\RepositoryException;

use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\PhysicalTagStatus;
use WarehouseCore\Security\Authorization;
use WarehouseCore\Service\Query\GetService;

final class PhysicalTagService {
    public function __construct(
        public string $service_name,
        private Authorization $authorization,
        private PhysicalTagRepository $physical_tag_repository,
    ) { }

    public function create(
        int $physical_tag_id
    ): ServiceResult {

        if(!$this->authorization->canCreatePhysicalTag()) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::AUTHENTICATION_FAILED
            );
        }

        try {
            $physical_tag_id = $this->physical_tag_repository->add($physical_tag_id);

            return new ServiceResult(
                success: true,
                entity: $physical_tag_id
            );

        }catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }
    }

    private function changeStatus(
        int $physical_tag_id,
        PhysicalTagStatus $status
    ): ServiceResult {
        try {
            $result = $this->physical_tag_repository->updateStatus(
                $physical_tag_id,
                $status->value
            );
        }catch(RepositoryException $e) {
            return new ServiceResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new ServiceResult(
            success: $result
        );
    }

    public function SetFree(
        int $physical_tag_id
    ): ServiceResult {
        return $this->changeStatus(
            $physical_tag_id,
            PhysicalTagStatus::Free
        );
    }

    public function SetAssigned(
        int $physical_tag_id
    ): ServiceResult {
        return $this->changeStatus(
            $physical_tag_id,
            PhysicalTagStatus::Assigned
        );
    }

    public function SetLost(
        int $physical_tag_id
    ): ServiceResult {
        return $this->changeStatus(
            $physical_tag_id,
            PhysicalTagStatus::Lost
        );
    }

    public function SetBroken(
        int $physical_tag_id
    ): ServiceResult {
        return $this->changeStatus(
            $physical_tag_id,
            PhysicalTagStatus::Broken
        );
    }
}