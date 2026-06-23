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
Event
ItemSalesArhive
StockSalesArhive
User
Owner
PhysicalTag
```
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
├── Event
├── ItemSalesArhive
└── StockSalesArhive

Identity
├── User
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
└── CreatedAt

Item
├── Id
├── PhysicalTagId
├── PartId
├── VehicleId
├── OwnerId
├── Status > (Created, Active, Sold, Archived, Lost)
├── Condition > (New, Good, Fair, Poor)
├── ConditionNote
└── CreatedAt

Stock
├── Id
├── PartId
├── Qty
├── Status > (Created, Active, Crowded, Archived, Lost)
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
└── File

StockPhoto
├── Id
├── StockId
└── File

VehiclePhoto
├── Id
├── VehicleId
└── File    
```

## Audit
*domain events + sales ledger*
```text
Event
├── Id
├── EntityType
├── EntityId
├── Action
├── Payload
├── OwnerId
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
User
├── Id
├── TelegramId
├── Name
├── RoleId
└── CreatedAt

Owner
├── Id
├── Name
├── UserId
└── CreatedAt

PhysicalTag  
├── Id
├── Status > (Free, Assigned, Lost, Broken)
└── CreatedAt
```