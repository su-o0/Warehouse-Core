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
├── Item Condition
├── Item Status
├── ItemProcessingStep Stage
├── Owner Status
├── Part Status
├── PartProcessingStep Stage
├── PhysicalTag Status
├── Provider Name
├── Rack Status
├── Role Name
├── Shelf Status
├── Stock Status
├── User Status
├── UserProcessingStep Stage 
└── Zone Status
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
│   └── StockSalesArchive
│
├── ItemProcessingStep
├── PartName
├── PartNumber
├── PartProcessingStep
├── Photo
├── RackName
│
├── Relationship
│   ├── AreaAccess
│   ├── ContainerPlacement
│   ├── ItemPlacement
│   ├── RackPlacement
│   ├── StockPlacement
│   └── UserIdentity
│
├── UserName
├── UserProcessingStep
├── Video
└── ZoneName
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