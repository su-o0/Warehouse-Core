# Domain Model 

```
Core
│
├── Audit
│   ├── Journal
│   │
│   ├── MovementHistory
│   │   ├── ContainerMovementArchive
│   │   ├── ItemMovementArchive
│   │   ├── RackMovementArchive
│   │   ├── StockMovementArchive
│   │   └── ZoneMovementArchive
│   │
│   ├── PlacementHistory
│   │   ├── ContainerPlacementArchive
│   │   ├── ItemPlacementArchive
│   │   ├── RackPlacementArchive
│   │   ├── StockPlacementArchive
│   │   └── ZonePlacementArchive
│   │
│   └── SalesHistory
│       ├── ItemSalesArchive
│       └── StockSalesArchive
│
├── Catalog
│   ├── AreaName
│   ├── Part
│   ├── PartName
│   ├── PartNumber
│   ├── RackName
│   ├── UserName
│   ├── Vehicle
│   └── ZoneName
│
├── Identity
│   ├── AreaAccess
│   ├── Membership
│   │   └── Owner
│   │
│   ├── Provider
│   ├── User
│   └── UserIdentity
│
├── Inventory
│   ├── Container
│   ├── Item
│   ├── PhysicalTag
│   ├── Rack
│   └── Stock
│
├── Media
│   ├── Photo
│   │   ├── ContainerPhoto
│   │   ├── ItemPhoto
│   │   ├── PartPhoto
│   │   ├── RackPhoto
│   │   ├── StockPhoto
│   │   ├── UserPhoto
│   │   ├── VehiclePhoto
│   │   └── ZonePhoto
│   │
│   ├── StoredFile
│   │
│   └── Video
│       ├── ItemVideo
│       ├── PartVideo
│       ├── StockVideo
│       └── VehicleVideo
│
├── Processing
│   ├── ContainerProcessingStep
│   ├── ItemProcessingStep
│   ├── PartProcessingStep
│   ├── RackProcessingStep
│   ├── StockProcessingStep
│   ├── UserProcessingStep
│   └── ZoneProcessingStep
│
├── Security
│   ├── Password
│   └── Role
│
└── Topology
    ├── Placement
    │   ├── ContainerPlacement
    │   ├── ItemPlacement
    │   ├── RackPlacement
    │   ├── StockPlacement
    │   └── ZonePlacement
    │
    └── Structure
        ├── Area
        ├── Shelf
        ├── StorageSlot
        └── Zone
```
---
```
Area
AreaAccess
AreaName
Container
ContainerMovementArchive
ContainerPhoto
ContainerPlacement
ContainerPlacementArchive
ContainerProcessingStep
Item
ItemMovementArchive
ItemPhoto
ItemPlacement
ItemPlacementArchive
ItemProcessingStep
ItemSalesArchive
ItemVideo
Journal
Owner
Part
PartName
PartNumber
PartPhoto
PartProcessingStep
PartVideo
Password
PhysicalTag
Provider
Rack
RackMovementArchive
RackName
RackPhoto
RackPlacement
RackPlacementArchive
RackProcessingStep
Role
Shelf
Stock
StockMovementArchive
StockPhoto
StockPlacement
StockPlacementArchive
StockProcessingStep
StockSalesArchive
StockVideo
StorageSlot
StoredFile
User
UserIdentity
UserName
UserPhoto
UserProcessingStep
Vehicle
VehiclePhoto
VehicleVideo
Zone
ZoneMovementArchive
ZoneName
ZonePhoto
ZonePlacement
ZonePlacementArchive
ZoneProcessingStep
```
---
```
Subdomain
├── Audit
├── Catalog
├── Identity
├── Inventory
├── Media
├── Processing 
├── Security
└── Topology
```
---
```
Audit
├── ContainerMovementArchive
├── ContainerPlacementArchive
├── ItemMovementArchive
├── ItemPlacementArchive
├── ItemSalesArchive
├── Journal
├── RackMovementArchive
├── RackPlacementArchive
├── StockMovementArchive
├── StockPlacementArchive
├── StockSalesArchive
├── ZoneMovementArchive
└── ZonePlacementArchive


Catalog
├── AreaName
├── Part
├── PartName
├── PartNumber
├── RackName
├── UserName
├── Vehicle
└── ZoneName


Identity
├── AreaAccess
├── Owner
├── Provider
├── User
└── UserIdentity


Inventory
├── Container
├── Item
├── PhysicalTag
├── Rack
└── Stock


Media
├── ContainerPhoto
├── ItemPhoto
├── ItemVideo
├── PartPhoto
├── PartVideo
├── RackPhoto
├── StockPhoto
├── StockVideo
├── StoredFile
├── UserPhoto
├── VehiclePhoto
├── VehicleVideo
└── ZonePhoto


Processing
├── ContainerProcessingStep
├── ItemProcessingStep
├── PartProcessingStep
├── RackProcessingStep
├── StockProcessingStep
├── UserProcessingStep
└── ZoneProcessingStep


Security
├── Password
└── Role


Topology
├── Area
├── ContainerPlacement
├── ItemPlacement
├── RackPlacement
├── Shelf
├── StockPlacement
├── StorageSlot
├── Zone
└── ZonePlacement
```