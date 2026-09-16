# Domain Core

```
Core
├── Entity
├── Type Enums
├── Reference Data
├── Value Objects
│   ├── Relationship
│   └── Audit
│   
└── Service

```
---
```
Entity
├── Area
├── Container
├── Item
├── Journal
├── Owner
├── Part
├── PhysicalTag
├── Rack
├── Shelf
├── Stock
├── StorageSlot
├── StoredFile
├── User
├── Vehicle
└── Zone
```
---
```
Reference Data
├── Role
└── Provider
```
---
```
Type Enums
├── Area Status
├── Container Status
├── Container Type
├── ContainerProcessingStep Stage
├── Item Condition
├── Item Status
├── ItemProcessingStep Stage
├── Owner Status
├── Part Status
├── PartProcessingStep Stage
├── PhysicalTag Status
├── Provider Name
├── Rack Status
├── Rack Type
├── RackProcessingStep Stage
├── Role Name
├── Shelf Status
├── StorageSlot Status
├── Stock Status
├── StockProcessingStep Stage
├── User Status
├── UserProcessingStep Stage 
├── Zone Status
└── ZoneProcessingStep Stage
```
---
```
Value Objects
├── AreaName
│
├── Audit
│   ├── ContainerMovementArchive
│   ├── ContainerPlacementArchive
│   ├── ItemMovementArchive
│   ├── ItemPlacementArchive
│   ├── ItemSalesArchive
│   ├── RackMovementArchive
│   ├── RackPlacementArchive
│   ├── StockMovementArchive
│   ├── StockPlacementArchive
│   ├── StockSalesArchive
│   ├── ZoneMovementArchive
│   └── ZonePlacementArchive
│
├── ContainerProcessingStep
├── ItemProcessingStep
├── PartProcessingStep
├── Password
├── PartName
├── PartNumber
├── Photo
├── RackName
├── RackProcessingStep
├── StockProcessingStep
├── UserName
├── UserProcessingStep
├── Video
├── ZoneName
├── ZoneProcessingStep
│
└── Relationship
    ├── AreaAccess
    ├── ContainerPlacement
    ├── ItemPlacement
    ├── RackPlacement
    ├── StockPlacement
    ├── UserIdentity
    └── ZonePlacement
```
---
```
Service
│
├── Domain Services
│   ├── Area
│   ├── Container
│   ├── Identity
│   │   ├── Authentication
│   │   └── User
│   │
│   ├── Item
│   ├── Movement
│   ├── Owner
│   ├── Part
│   ├── Photo
│   ├── PhysicalTag
│   ├── Placement
│   ├── Rack
│   ├── Sales
│   ├── Shelf
│   ├── Stock
│   ├── Vehicle
│   ├── Video
│   └── Zone
│
└── Query
    ├── Find
    ├── Get
    └── List
```