# Domain
Storage architecture model
```md
Topology
├── Location
├── ContainerPlacement
├── ItemPlacement
├── StockPlacement
└── PhysicalTag

Inventory
├── Container
├── Item
└── Stock

Catalog
├── Part
└── Car

Media
├── ItemPhoto
├── StockPhoto
└── CarPhoto

Audit
├── SalesArhive
├── History
└── Owner
```
----------------

# Topology 
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
├── ItemId
└── CreatedAt

StockPlacement
├── Id
├── LocationId
├── StockId
└── CreatedAt

PhysicalTag  
├── Id
├── Status > (Free, Assigned, Lost, Broken)
└── CreatedAt
```

# Inventory
```text
Container 
├── Id
├── Type > (Box, Pallet)
└── CreatedAt

Item 
├── Id
├── PhysicalTagId
├── ContainerId 
├── PartId
├── CarId
├── Status > (Active, Sold, Archived, Lost)
├── Condition > (New, Good, Fair, Poor)
├── ConditionNote
└── CreatedAt

Stock
├── Id
├── ContainerId 
├── PartId
├── Qty
└── CreatedAt
```

## Catalog 
```text
Part
├── Id
├── Article
├── Name
└── CreatedAt

Car
├── Id
├── Vin
└── CreatedAt
```

# Media 
```
ItemPhoto
├── Id
├── ItemId
├── OwnerId
└── File

StockPhoto
├── Id
├── StockId
├── OwnerId
└── File

CarPhoto
├── Id
├── CarId
├── OwnerId
└── File    
```
## Audit
```text
SalesArhive
├── Id
├── ItemId
├── StockId
├── Qty
├── OwnerId
└── CreatedAt

History
├── Id
├── Action
├── EntityType
├── EntityId
├── Note
├── OwnerId
└── CreatedAt

Owner
├── Id
├── Name
├── UserId
├── Permission > ( admin, worker, Salesman )
└── CreatedAt
```