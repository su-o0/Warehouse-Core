docs/ 
├── Domain.md *Storage Domain model*
├── named.md *Definition*
├── Readme.md 
├── RepositoryApi.md 
├── Scenario.md *Busines API*
├── Schema.md *this*
└── schema.sql *Storage DB SQL schema*

docs/
├── Api
│   ├── RepositoryApi.md *SQL abstraction API Layer*
│   └── StorageApi.md *Bisuness API Layer*
├── DomainModel.md *single source of truth*
├── named.md *Definition*
├── Readme.md **
├── Scenario.md 
├── Schema.md
└── Schema.sql 

docs
├── Api
│   ├── Repository
│   │   ├── ContainerAPI.md
│   │   └── LocationAPI.md
│   ├── RepositoryApi.md *SQL abstraction API* 
│   ├── Scenario.md *Busines API*
│   └── StorageApi.md 
├── DomainModel.md *Domain model*
├── Lifecycle
│   ├── Address.md
│   ├── Item.md
│   └── Tag.md
├── Named.md *Definition*
├── Readme.md
├── Schema.md *this*
├── Schema.sql *MySQL DB*
└── SystemModel.md *sync docs/code*


src
├── Bootstrap *Composition*
│   ├── SetupRepository.php *Composition Repository*
│   └── SetupScenario.php *Composition Scenario*
├── Connection
│   └── Connection.php *Соединение с Базой*
├── Repository *SQL domain abstraction API*
│   ├── CarPhotoRepository.php 
│   ├── CarRepository.php 
│   ├── ContainerRepository.php
│   ├── HistoryRepository.php
│   ├── ItemPhotoRepository.php
│   ├── ItemRepository.php
│   ├── LocationRepository.php
│   ├── OwnerRepository.php
│   ├── PartRepository.php
│   ├── PhysicalTagRepository.php
│   ├── SalesArhiveRepository.php
│   ├── StockPhotoRepository.php
│   └── StockRepository.php
├── Scenario *Busines API*
│   ├── AddAddressScenario.php
│   ├── AddContainerScenario.php
│   ├── AddItemScenario.php
│   ├── AddStockScenario.php
│   ├── AddTagScenario.php
│   └── GetAddressContentScenario.php
└── StorageApi.php *Composition Root*