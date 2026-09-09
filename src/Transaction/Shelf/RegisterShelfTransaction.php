<?php
namespace WarehouseCore\Transaction\Shelf;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Payload\Entity\RackEntity;
use WarehouseCore\Payload\Enum\RackStatusEnum;
use WarehouseCore\Payload\Enum\ShelfStatusEnum;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Topology\ShelfRepository;

final class RegisterShelfTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private ShelfRepository $shelf_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        RackEntity $rack,
        int $shelf_level,
        int $user_id,
    ): mixed{
        return $this->run(function () use (
            $rack,
            $shelf_level,
            $user_id
        ) {
            $id = $this->shelf_repository->add(
                rack_id: $rack->id,
                shelf_level: $shelf_level,
                user_id: $user_id
            );

            if ($rack->status === RackStatusEnum::Active) {
                $this->shelf_repository->updateStatus(
                    id: $id,
                    status: ShelfStatusEnum::Active->value
                );
            }

            return ServiceResult::success();
        });
    }
}