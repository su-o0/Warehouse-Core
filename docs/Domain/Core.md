# Domain Core

```
Core
├── Enitity
├── Value Objects
├── Relationship
├── Audit Record
├── Domain Service
└── Event 
```
---
```
Enitity
├── Area
├── Zone
├── Rack
├── Shelf
├── Container
├── Item
├── Stock
├── PhysicalTag
├── Part
├── Vehicle
├── StoredFile
├── Telemetry
├── User
└── UserIdentity
```
---
```
Value Objects
├── Role
├── Provider
├── ItemProcessingStep
├── PartProcessingStep
├── AreaName
├── ZoneName
├── RackName
├── PartNumber
├── PartName
├── PartPhoto
├── ItemPhoto
├── StockPhoto
├── VehiclePhoto
├── PartVideo
├── ItemVideo
├── StockVideo
├── VehicleVideo
├── AreaStatus
├── ZoneStatus
├── RackStatus
├── ShelfStatus
├── ContainerStatus
├── ItemStatus
├── StockStatus
├── PartStatus
├── PhysicalTagStatus
├── ItemProcessingStepStage
├── PartProcessingStepStage
├── UserStatus
└── UserIdentityProvider
```
---
```
Relationship
├── AreaAccess
├── Owner
├── RackPlacement
├── ContainerPlacement
├── ItemPlacement
└── StockPlacement
```
---
```
Audit Record
├── RackPlacementArchive
├── ContainerPlacementArchive
├── ItemPlacementArchive
├── StockPlacementArchive
├── RackMovementArchive
├── ContainerMovementArchive
├── ItemMovementArchive
├── StockMovementArchive
├── ItemSalesArchive
└── StockSalesArchive
```
---
```
Domain Service
├── PlacementService
├── MovementService
├── ProcessingService
└── StoredFileService
```
---
```
Event
├── UpdateTopology
├── UpdateInventory
├── Placement
├── Movement
├── Processing
├── StoredFile
└── UpdateDefantion
```