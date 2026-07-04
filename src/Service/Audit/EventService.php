<?php 
namespace WarehouseCore\Service\Audit;

use WarehouseCore\Repository\Audit\EventRepository;

final class EventService {
    public function __construct(
        private EventRepository $repository
    ) { }

}