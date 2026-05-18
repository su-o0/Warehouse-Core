<?  
namespace StorageApi\Service\Setup;
use StorageAPI\Repository\Catalog\CarRepository;

class AddCar {
    public function __construct(
        private CarRepository $Car
    ) {}

    public function execute(string $Vin): void {
        echo "Добавление автомобиля с VIN $Vin\n";
        $ExistingCar = $this->Car->findByVin($Vin);
        if($ExistingCar !== null)
            throw new \RuntimeException("Автомобиль с VIN $Vin уже существует");

        $this->Car->add($Vin);
        echo "Автомобиль успешно добавлен\n";
    }
}