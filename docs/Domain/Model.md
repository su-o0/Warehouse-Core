# Domain Model 

```
Core
│
├── Topology
│   ├── Placement
│   │   ├── RackPlacement
│   │   ├── ContainerPlacement
│   │   ├── ItemPlacement
│   │   └── StockPlacement
│   │
│   └── Structure
│       ├── Area
│       └── Zone
│
├── Inventory
│   ├── Rack
│   ├── Shelf
│   ├── Container
│   ├── Item
│   ├── Stock
│   └── PhysicalTag
│
├── Processing
│   ├── ItemProcessingStep
│   └── PartProcessingStep
│
├── Catalog
│   ├── AreaName
│   ├── ZoneName
│   ├── RackName
│   ├── Part
│   ├── PartNumber
│   ├── PartName
│   └── Vehicle
│
├── Media
│   ├── Photo
│   │   ├── PartPhoto
│   │   ├── ItemPhoto
│   │   ├── StockPhoto
│   │   └── VehiclePhoto
│   │
│   ├── Video
│   │   ├── PartVideo
│   │   ├── ItemVideo
│   │   ├── StockVideo
│   │   └── VehicleVideo
│   │
│   └── StoredFile
│
├── Audit
│   ├── PlacementHistory
│   │   ├── RackPlacementArchive
│   │   ├── ContainerPlacementArchive
│   │   ├── ItemPlacementArchive
│   │   └── StockPlacementArchive
│   │
│   ├── MovementHistory
│   │   ├── RackMovementArchive
│   │   ├── ContainerMovementArchive
│   │   ├── ItemMovementArchive
│   │   └── StockMovementArchive
│   │
│   ├── SalesHistory
│   │   ├── ItemSalesArchive
│   │   └── StockSalesArchive
│   │
│   └── Telemetry
│
└── Identity
    ├── Membership
    │   └── Owner
    │
    ├── AreaAccess
    ├── Role
    ├── Provider
    ├── User
    └── UserIdentity
```
---
```
Subdomain
├── Topology
├── Inventory
├── Processing 
├── Catalog
├── Media
├── Audit
└── Identity
```
---
```
Area
Zone
RackPlacement
ContainerPlacement
ItemPlacement
StockPlacement
Rack
Shelf
Container
Item
Stock
PhysicalTag
ItemProcessingStep
AreaName
ZoneName
RackName
Part
PartNumber
PartName
Vehicle
PartPhoto
ItemPhoto
StockPhoto
VehiclePhoto
PartVideo
ItemVideo
StockVideo
VehicleVideo
StoredFile
RackPlacementArchive
ContainerPlacementArchive
ItemPlacementArchive
StockPlacementArchive
RackMovementArchive
ContainerMovementArchive
ItemMovementArchive
StockMovementArchive
ItemSalesArchive
StockSalesArchive
Telemetry
Owner
AreaAccess
Role
Provider
User
UserIdentity

```
---
```
Topology
├── Area
├── Zone
├── RackPlacement
├── ContainerPlacement
├── ItemPlacement
└── StockPlacement

Inventory
├── Rack
├── Shelf
├── Container
├── Item
├── Stock
└── PhysicalTag

Processing
└── ItemProcessingStep

Catalog
├── AreaName
├── ZoneName
├── Part
├── PartNumber
├── PartName
└── Vehicle

Media
├── PartPhoto
├── ItemPhoto
├── StockPhoto
├── VehiclePhoto
├── PartVideo
├── ItemVideo
├── StockVideo
├── VehicleVideo
└── StoredFile

Audit
├── RackPlacementArchive
├── ContainerPlacementArchive
├── ItemPlacementArchive
├── StockPlacementArchive
├── RackMovementArchive
├── ContainerMovementArchive
├── ItemMovementArchive
├── StockMovementArchive
├── ItemSalesArchive
├── StockSalesArchive
└── Telemetry

Identity
├── Role
├── Provider
├── User
├── UserIdentity
├── Owner
└── AreaAccess
```