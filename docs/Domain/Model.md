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
│   │   └── StockMovementArchive
│   │
│   ├── PlacementHistory
│   │   ├── ContainerPlacementArchive
│   │   ├── ItemPlacementArchive
│   │   ├── RackPlacementArchive
│   │   └── StockPlacementArchive
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
│   └── Membership
│       └── Owner
│
├── Inventory
│   ├── Container
│   ├── Item
│   ├── PhysicalTag
│   ├── Rack
│   ├── Shelf
│   └── Stock
│
├── Media
│   ├── Photo
│   │   ├── ItemPhoto
│   │   ├── PartPhoto
│   │   ├── StockPhoto
│   │   └── VehiclePhoto
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
│   ├── ItemProcessingStep
│   ├── PartProcessingStep
│   ├── RackProcessingStep
│   └── UserProcessingStep
│
├── Security
│   ├── Provider
│   ├── Role
│   ├── User
│   └── UserIdentity
│
└── Topology
    ├── Placement
    │   ├── ContainerPlacement
    │   ├── ItemPlacement
    │   ├── RackPlacement
    │   └── StockPlacement
    │
    └── Structure
        ├── Area
        └── Zone
```
---
```
Area
AreaAccess
AreaName
Container
ContainerMovementArchive
ContainerPlacement
ContainerPlacementArchive
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
PhysicalTag
Provider
Rack
RackMovementArchive
RackName
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
StockSalesArchive
StockVideo
StoredFile
User
UserIdentity
UserName
UserProcessingStep
Vehicle
VehiclePhoto
VehicleVideo
Zone
ZoneName
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
└── StockSalesArchive


Catalog
├── AreaName
├── Part
├── PartName
├── PartNumber
├── RackName
├── UserName
├── Vehicle
└── ZoneName


Inventory
├── Container
├── Item
├── PhysicalTag
├── Rack
├── Shelf
└── Stock


Identity
├── AreaAccess
└── Owner


Media
├── ItemPhoto
├── ItemVideo
├── PartPhoto
├── PartVideo
├── StockPhoto
├── StockVideo
├── StoredFile
├── VehiclePhoto
└── VehicleVideo


Processing
├── ItemProcessingStep
├── PartProcessingStep
├── RackProcessingStep
└── UserProcessingStep


Security
├── Provider
├── Role
├── User
└── UserIdentity


Topology
├── Area
├── ContainerPlacement
├── ItemPlacement
├── RackPlacement
├── StockPlacement
└── Zone
```