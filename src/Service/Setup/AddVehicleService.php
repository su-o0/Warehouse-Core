<?  
namespace WarehouseCore\Service\Setup;

use WarehouseCore\Exception\DomainException;
use WarehouseCore\Exception\RepositoryException;
use WarehouseCore\Payload\Result\SetupResult;
use WarehouseCore\Repository\Catalog\VehicleRepository;

class AddVehicleService {
    public function __construct(
        private VehicleRepository $vehicle_repository
    ) {}

    public function execute(
        string $vin
    ): SetupResult {

        $vehicle_entity = $this->vehicle_repository->findByVin($vin);
        if($vehicle_entity !== null)
            return new SetupResult(
                success: false,
                message: DomainException::VEHICLE_ALREADY_EXISTS()->getMessage()
            );

        try {
            $this->vehicle_repository->add($vin);
        }catch(RepositoryException $e) {
            return new SetupResult(
                success: false,
                message: $e->getMessage()
            );
        }

        return new SetupResult(
            success: true
        );
    }
}