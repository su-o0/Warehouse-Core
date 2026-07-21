<?php
namespace WarehouseCore\Api\Identity;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\ErrorCode;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Payload\Request\CreatePhysicalTagRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Service\Identity\PhysicalTagService;
use WarehouseCore\Service\Query\GetService;

final class CreatePhysicalTagApi {
    public function __construct(
        public string $api_name,
        private PhysicalTagService $physical_tag,
        private GetService $get,
    ) { }

    public function handle(
        CreatePhysicalTagRequest $request
    ): ServiceResult {
        try {
            $result = $this->get->getPhysicalTag($request->id);    
            
            return new ServiceResult(
                success: false,
                message: ErrorMessage::PHYSICAL_TAG_ALREADY_EXISTS
            );
        } catch (DomainException $e) {
            if ($e->errorCode !== ErrorCode::PHYSICAL_TAG_NOT_FOUND) {
                throw $e;
            }

            return $this->physical_tag->create(
                $request->id,
            );
        }


    }
}