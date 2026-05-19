# Directory list and Naming

```text
.
├── Cli.php
├── composer.json
├── config
│   ├── database.php
│   └── tables.php
├── config.php
├── docs
│   ├── Architecture.md
│   ├── core
│   │   └── Schema.sql
│   ├── DomainModel.md
│   ├── img
│   │   ├── MySQL-8.0-orange.svg
│   │   ├── PHP-8.5-blue.svg
│   │   └── status-in development-yellow.svg
│   ├── Placement.md
│   ├── README.md
│   ├── RepositoryAPI.md
│   ├── Schema.md
│   ├── ServiceApi.md
│   ├── Service.md
│   └── SystemModel.md
├── Make.php
├── shema.txt
└── src
   ├── Bootstrap
   │   ├── SetupRepository.php
   │   └── SetupService.php
   ├── Connection
   │   └── Connection.php
   ├── Exception
   │   ├── ErrorCode.php
   │   └── StorageException.php
   ├── Payload
   │   └── HistoryActions.php
   ├── Repository
   │   ├── Audit
   │   │   ├── HistoryRepository.php
   │   │   ├── OwnerRepository.php
   │   │   └── SalesArhiveRepository.php
   │   ├── Catalog
   │   │   ├── CarRepository.php
   │   │   └── PartRepository.php
   │   ├── Inventory
   │   │   ├── ContainerRepository.php
   │   │   ├── ItemRepository.php
   │   │   └── StockRepository.php
   │   ├── Media
   │   │   ├── CarPhotoRepository.php
   │   │   ├── ItemPhotoRepository.php
   │   │   └── StockPhotoRepository.php
   │   └── Topology
   │       ├── ContainerPlacementRepository.php
   │       ├── ItemPlacementRepository.php
   │       ├── LocationRepository.php
   │       ├── PhysicalTagRepository.php
   │       └── StockPlacementRepository.php
   ├── Service
   │   ├── Audit
   │   │   ├── GetAllOwnerService.php
   │   │   ├── GetHistoryService.php
   │   │   └── GetSales.php
   │   ├── Inventory
   │   │   ├── DecrementStockQtyService.php
   │   │   ├── DeleteStockService.php
   │   │   ├── IncrementStockQtyService.php
   │   │   └── SetItemConditionService.php
   │   ├── Media
   │   │   ├── AddCarPhotoService.php
   │   │   ├── AddItemPhotoService.php
   │   │   ├── AddStockPhotoService.php
   │   │   ├── DeleteCarPhotoService.php
   │   │   ├── DeleteItemPhotoService.php
   │   │   └── DeleteStockPhotoService.php
   │   ├── Movement
   │   │   ├── MoveContainerService.php
   │   │   ├── MoveService.php
   │   │   ├── PutIntoContainerService.php
   │   │   └── RemoveFromContainerService.php
   │   ├── Placement
   │   │   └── SetPlacementService.php
   │   ├── Query
   │   │   ├── FindPhysicalTagService.php
   │   │   ├── GetAllCarService.php
   │   │   ├── GetAllLocationService.php
   │   │   ├── GetContainerContentService.php
   │   │   └── GetLocationContentService.php
   │   └── Setup
   │       ├── AddCar.php
   │       ├── AddContainerService.php
   │       ├── AddItemService.php
   │       ├── AddLocationService.php
   │       ├── AddOwnerService.php
   │       ├── AddPhysicalTagService.php
   │       └── AddStockService.php
   └── StorageApi.php