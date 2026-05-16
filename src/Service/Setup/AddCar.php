<?  
namespace SuO0\StorageApi\Service\Setup;
use SuO0\StorageAPI\Repository\Catalog\CarRepository;

class AddCar {
    public function __construct(
        private CarRepository $Car
    ) {}

    public function execute(string $Vin): void {
        $ExistingCar = $this->Car->findByName($Name);
        if($ExistingCar !== null)
            throw new \RuntimeException("Автомобиль с именем $Name уже существует");

        $this->Car->add($Name);
        echo "Автомобиль $Name успешно добавлен\n";
    }
}