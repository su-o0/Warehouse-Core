<?php
namespace WarehouseCore\Transaction\Zone;

use WarehouseCore\Contract\Transaction;
use WarehouseCore\Exception\ErrorMessage;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\ServiceResult;
use WarehouseCore\Repository\Identity\UserRepository;
use WarehouseCore\Repository\Topology\AreaRepository;
use WarehouseCore\Repository\Topology\ZoneRepository;

final class CreateZoneTransaction extends Transaction {
    public function __construct(
        \PDO $db,
        string $transaction_name,
        private AreaRepository $area_repository,
        private ZoneRepository $zone_repository
    ) {
        parent::__construct($db, $transaction_name);
    }

    public function handle(
        int $area_id,
        int $user_id
    ): mixed{
        return $this->run(function () use (
            $area_id,
            $user_id
        ) {
            try { 
                $area = $this->area_repository->getById(
                    $area_id
                );

                if($area === null) {
                    return new ServiceResult(
                        success: false,
                        message: ErrorMessage::AREA_NOT_FOUND
                    );
                }

                $this->zone_repository->add(
                    area_id: $area_id,
                    user_id: $user_id
                ); 
            }catch(RepositoryException $e) {
                return new ServiceResult(
                    success: false,
                    message: $e->getMessage()
                );
            }

            return new ServiceResult(
                success: true
            );
        });
    }
}