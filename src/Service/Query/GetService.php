<?php 
namespace WarehouseCore\Service\Query;

use WarehouseCore\Repository\Topology\LocationRepository;

final class GetService {
    public function __construct(
        private LocationRepository $location_repository
    ) { }
}