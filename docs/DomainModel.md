# Domain
Warehouse Core architecture model
```
Location
ContainerPlacement
ItemPlacement
StockPlacement
Container
Item
Stock
Part
Vehicle
ItemPhoto
StockPhoto
VehiclePhoto
Telemetry
ItemSalesArhive
StockSalesArhive
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

Catalog
├── Part
└── Vehicle

Media
├── ItemPhoto
├── StockPhoto
└── VehiclePhoto

Audit
├── Telemetry
├── ItemSalesArhive
└── StockSalesArhive

Identity
├── Role
├── User
├── UserIdentity
├── Owner
└── PhysicalTag
```
----------------

# Topology 
*where things are*
```text
Location
├── Id
├── Address
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
├── Status > (Created, Tagged, Placed, Active, Sold, Archived, Lost)
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

## Catalog 
*definitions*
```text
Part
├── Id
├── Article
├── Name
└── CreatedAt

Vehicle
├── Id
├── Vin
└── CreatedAt
```

# Media
*normalized* 
```
ItemPhoto
├── Id
├── ItemId
├── File
├── CreatedByUserId
└── CreatedAt

StockPhoto
├── Id
├── StockId
├── File
├── CreatedByUserId
└── CreatedAt

VehiclePhoto
├── Id
├── VehicleId
└── File    
├── CreatedByUserId
└── CreatedAt
```

## Audit
*domain events + sales ledger*
```text
Telemetry
├── Id
├── EntityType > (Location, Container, Item, Stock, User, UserIdentity, Owner, PhysicalTag, ItemPhoto, StockPhoto, VehiclePhoto, Part, Vehicle)
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

```
### Identity
*actors + ownership*
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