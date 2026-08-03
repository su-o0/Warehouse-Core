# Warehouse Core architecture domain model
---
    
```
Location
ContainerPlacement
ItemPlacement
StockPlacement
Container
Item
Stock
ItemProcessingStep
Part
PartNumber
PartName
Vehicle
StoredFile
PartPhoto
ItemPhoto
StockPhoto
VehiclePhoto
Telemetry
ItemSalesArchive
StockSalesArchive
ContainerMovementArchive
ItemMovementArchive
StockMovementArchive
Role
User
UserIdentity
Owner
PhysicalTag
```
---

```md
Topology
├── Location
├── ContainerPlacement
├── ItemPlacement
└── StockPlacement

Inventory
├── Container
├── Item
└── Stock

Processing
└── ItemProcessingStep

Catalog
├── Part
├── PartAlias
└── Vehicle

Media
├── StoredFile
├── PartPhoto
├── ItemPhoto
├── StockPhoto
└── VehiclePhoto

Audit
├── Telemetry
├── ItemSalesArhive
├── StockSalesArhive
├── ItemMovementArhive
├── ContainerMovementArhive
└── StockMovementArhive

Identity
├── Role
├── User
├── UserIdentity
├── Owner
└── PhysicalTag
```
---

# Topology 
*where things are*
```text
Location
├── Id
├── Address
├── Status > (Created, Active, Archived)
├── CreatedByUserId
└── CreatedAt   

ContainerPlacement
├── Id
├── LocationId
├── ContainerId
└── CreatedAt

ItemPlacement
├── Id
├── LocationId
├── ContainerId
├── ItemId
└── CreatedAt

StockPlacement
├── Id
├── LocationId
├── ContainerId
├── StockId
└── CreatedAt
```

# Inventory
*what exists* 
```text
Container 
├── Id
├── Type > (Box, Pallet)
├── Status > (Created, Active, Crowded, Archived, Lost)
├── CreatedByUserId
└── CreatedAt

Item
├── Id
├── PhysicalTagId
├── PartId
├── VehicleId
├── OwnerId
├── Status > (Created, Processing, Active, Sold, Archived, Lost)
├── Condition > (New, Good, Fair, Poor)
├── ConditionNote
├── CreatedByUserId
└── CreatedAt

Stock
├── Id
├── PartId
├── Qty
├── Status > (Created, Active, Crowded, Archived)
├── CreatedByUserId
└── CreatedAt
```

## Processing
*What else needs to be done*
```text
ItemProcessingStep
├── Id
├── ItemId
├── Stage > (Identify, Photo, Inspection, Placement)
├── Metadata
├── CreatedByUserId
└── CreatedAt
```

## Catalog 
*Product definitions*
```text
Part
├── Id
└── CreatedAt

PartNumber
├── Id
├── PartId
├── Value
├── IsPrimary
└── CreatedAt

PartName
├── Id
├── PartId
├── Value
├── IsPrimary
└── CreatedAt   

Vehicle
├── Id
├── Vin
└── CreatedAt
```

# Media
*Digital assets* 
```
StoredFile
├── Id
├── Path
├── Hash
├── MimeType
├── Size
├── CreatedByUserId
└── CreatedAt

PartPhoto
├── Id
├── PartId
├── FileId
└── CreatedAt

ItemPhoto
├── Id
├── ItemId
├── FileId
└── CreatedAt

StockPhoto
├── Id
├── StockId
├── FileId
└── CreatedAt

VehiclePhoto
├── Id
├── VehicleId
├── FileId  
└── CreatedAt
```

## Audit
*History and telemetry*
```text
Telemetry
├── Id
├── EntityType > (Location, ContainerPlacement, ItemPlacement, StockPlacement, Container, Item, Stock, ItemProcessingStep, Part, PartNumber, PartName, Vehicle, StoredFile, PartPhoto, ItemPhoto, StockPhoto, VehiclePhoto, ItemSalesArchive, StockSalesArchive, ItemMovementArchive, ContainerMovementArchive, StockMovementArchive, Role, User, UserIdentity, Owner, PhysicalTag) 
├── EntityId
├── Action > (Create, Update, Delete, Place, Replace, Move, Remove, ChangeType, ChangeCondition, ChangeStatus)
├── Payload
├── UserId
└── CreatedAt

ItemSalesArchive
├── Id
├── ItemId
├── UserId
└── CreatedAt

StockSalesArchive
├── Id
├── StockId
├── Qty
├── UserId
└── CreatedAt

ContainerMovementArchive
├── Id
├── ContainerId
├── From
├── To
├── CreatedByUserId
└── CreatedAt

ItemMovementArchive
├── Id
├── ItemId
├── From
├── To
├── CreatedByUserId
└── CreatedAt

StockMovementArchive
├── Id
├── StockId
├── From
├── To
├── CreatedByUserId
└── CreatedAt

```
### Identity
*Actors and ownership*
```
Role
├── Id
├── Name
└── CreatedAt

User
├── Id
├── Name
├── RoleId
├── Status > (Created, Active, Archive)
└── CreatedAt

UserIdentity
├── Id
├── UserId
├── Provider > (Cli, Telegram, Web)
├── ExternalId
└── CreatedAt

Owner
├── Id
├── UserId
└── CreatedAt

PhysicalTag  
├── Id
├── Status > (Free, Assigned, Lost, Broken)
└── CreatedAt
```