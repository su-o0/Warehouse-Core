<?php
namespace WarehouseCore\Api\Inventory;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Payload\Request\AssignPhysicalTagRequest;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Payload\Type\PhysicalTagStatus;
use WarehouseCore\Service\Identity\PhysicalTagService;
use WarehouseCore\Service\Inventory\ItemService;
use WarehouseCore\Service\Query\GetService;

final class AssignPhysicalTagApi {
    public function __construct(
        public string $api_name,
        private PhysicalTagService $physical_tag,
        private ItemService $item,
        private GetService $get
    ) { }

    public function handle(
        AssignPhysicalTagRequest $request
    ): ServiceResult {
        try {
            $physical_tag = $this->get->getPhysicalTag($request->physical_tag_id);         
        } catch (DomainException $e) {
            return new ServiceResult(success: false, message: $e->getMessage());
        }

        if($physical_tag->status != PhysicalTagStatus::Free) {
            return new ServiceResult(
                success: false,
                message: ErrorMessage::PHYSICAL_TAG_MUST_BE_FREE
            );
        }


        if($request->vehicle_id !== null) {
            try {
                $this->get->getOwner($request->owner_id);
            } catch (DomainException $e) {
                return new ServiceResult(success: false, message: $e->getMessage());
            }
        }

        if($request->vehicle_id !== null) {
            try {
                $this->get->getVehicle($request->vehicle_id);
            } catch (DomainException $e) {
                return new ServiceResult(success: false, message: $e->getMessage());
            }
        }

        $this->physical_tag->SetAssigned(
            $request->physical_tag_id
        );

        return $this->item->create(
            $request->physical_tag_id,
            $request->owner_id,
            $request->vehicle_id
        );
    }
}