# Domain Schema

### Topology 
*where things are*
```
Topology
├── Area
├── Zone
├── RackPlacement
├── ContainerPlacement
├── ItemPlacement
└── StockPlacement
```
---
```
Area
├── Id
├── Status
│   ├── Created
│   ├── Active
│   ├── Crowded
│   └── Archived
│   
├── CreatedByUserId
└── CreatedAt

Zone
├── Id
├── AreaId
├── Status 
│   ├── Created
│   ├── Active
│   ├── Crowded
│   └── Archived
│   
├── CreatedByUserId
└── CreatedAt

RackPlacement
├── Id
├── AreaId
├── ZoneId
├── RackId
└── CreatedAt   

ContainerPlacement
├── Id
├── ZoneId
├── ShelfId
├── ContainerId
└── CreatedAt

ItemPlacement
├── Id
├── ZoneId
├── ShelfId
├── ContainerId
├── ItemId
└── CreatedAt

StockPlacement
├── Id
├── ZoneId
├── ShelfId
├── ContainerId
├── StockId
└── CreatedAt
```

### Inventory
*what exists* 
```
Inventory
├── Rack
├── Shelf
├── Container
├── Item
├── Stock
└── PhysicalTag
```
---
```
Rack 
├── Id
├── Status 
│   ├── Created
│   ├── Active
│   ├── Crowded
│   └── Archived
│   
├── CreatedByUserId
└── CreatedAt

Shelf 
├── Id
├── RackId
├── Status 
│   ├── Created
│   ├── Active
│   ├── Crowded
│   └── Archived
│   
├── CreatedByUserId
└── CreatedAt

Container 
├── Id
├── Type
│   ├── Box
│   └──Pallet
│   
├── Status
│   ├── Created
│   ├── Active
│   ├── Crowded
│   ├── Archived
│   └── Lost
│
├── CreatedByUserId
└── CreatedAt

Item
├── Id
├── PhysicalTagId
├── PartId
├── VehicleId
├── OwnerId
├── Status
│   ├── Created
│   ├── Processing
│   ├── Active
│   ├── Sold
│   ├── Archived
│   └── Lost
│
├── Condition
│   ├── New
│   ├── Good
│   ├── Fair
│   └── Poor
│
├── ConditionNote
├── CreatedByUserId
└── CreatedAt

Stock
├── Id
├── PartId
├── Qty
├── Status
│   ├── Created
│   ├── Active
│   ├── Crowded
│   ├── Archived
│   └── Lost
│
├── CreatedByUserId
└── CreatedAt

PhysicalTag  
├── Id
├── Status
│   ├── Free
│   ├── Assigned
│   ├── Lost
│   └── Broken
│
└── CreatedAt
```

### Processing
*What else needs to be done*
```
Processing
├── ItemProcessingStep
└── PartProcessingStep
```
---
```
ItemProcessingStep
├── Id
├── ItemId
├── Stage
│   ├── Identify
│   ├── Photo
│   ├── Inspection
│   └── Placement
│
├── Metadata
├── CreatedByUserId
└── CreatedAt

PartProcessingStep
├── Id
├── PartId
├── Stage
│   ├── Number
│   ├── Photo
│   └── Name
│
├── Metadata
├── CreatedByUserId
└── CreatedAt
```

### Catalog 
*Product definitions*
```
Catalog
├── AreaName
├── ZoneName
├── RackName
├── Part
├── PartNumber
├── PartName
└── Vehicle
```
---
```
AreaName
├── Id
├── AreaId
├── Value
├── CreatedByUserId
└── CreatedAt

ZoneName
├── Id
├── ZoneId
├── Value
├── CreatedByUserId
└── CreatedAt

RackName
├── Id
├── RackId
├── Value
├── CreatedByUserId
└── CreatedAt

Part
├── Id
├── Status
│   ├── Created
│   ├── Active
│   └── Archived 
│
CreatedByUserId
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
├── CreatedByUserId
└── CreatedAt   

Vehicle
├── Id
├── Vin
├── CreatedByUserId
└── CreatedAt
```

### Media
*Digital assets* 
```
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
```
---
```
PartPhoto
├── Id
├── PartId
├── StoredFileId
└── CreatedAt

ItemPhoto
├── Id
├── ItemId
├── StoredFileId
└── CreatedAt

StockPhoto
├── Id
├── StockId
├── StoredFileId
└── CreatedAt

VehiclePhoto
├── Id
├── VehicleId
├── StoredFileId  
└── CreatedAt

PartVideo
├── Id
├── PartId
├── StoredFileId
└── CreatedAt

ItemVideo
├── Id
├── ItemId
├── StoredFileId
└── CreatedAt

StockVideo
├── Id
├── StockId
├── StoredFileId
└── CreatedAt

VehicleVideo
├── Id
├── VehicleId
├── StoredFileId  
└── CreatedAt

StoredFile
├── Id
├── Path
├── Hash
├── MimeType
├── Size
├── CreatedByUserId
└── CreatedAt
```

### Audit
*History and telemetry*
```
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
```
---
```
ItemSalesArchive
├── Id
├── ItemId
├── UserId
├── CreatedByUserId
└── CreatedAt

StockSalesArchive
├── Id
├── StockId
├── Qty
├── UserId
├── CreatedByUserId
└── CreatedAt

RackPlacementArchive
├── Id
├── RackId
├── From
├── To
├── CreatedByUserId
└── CreatedAt

ContainerPlacementArchive
├── Id
├── ContainerId
├── From
├── To
├── CreatedByUserId
└── CreatedAt

ItemPlacementArchive
├── Id
├── ItemId
├── From
├── To
├── CreatedByUserId
└── CreatedAt

StockPlacementArchive
├── Id
├── StockId
├── From
├── To
├── CreatedByUserId
└── CreatedAt

RackMovementArchive
├── Id
├── RackId
├── From
├── To
├── CreatedByUserId
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

Telemetry
├── Id
├── EntityType
│   ├── Area
│   ├── Zone
│   ├── Rack
│   ├── Shelf
│   ├── Container
│   ├── Item
│   ├── Stock
│   ├── PhysicalTag
│   ├── Part
│   ├── Vehicle
│   ├── StoredFile
│   ├── Telemetry
│   ├── User
│   └── UserIdentity 
│    
├── EntityId
├── Metadata
├── CreatedByUserId
└── CreatedAt

```

### Identity
*Actors and ownership*
```
Identity
├── Role
├── Provider
├── User
├── UserIdentity
├── Owner
└── AreaAccess
```
---
```
Role
├── Id
├── Name
└── CreatedAt

Provider
├── Id
├── Name
└── CreatedAt

User
├── Id
├── Name
├── RoleId
├── Status
│   ├── Created
│   ├── Active
│   └── Archive
│
└── CreatedAt

UserIdentity
├── Id
├── UserId
├── ProviderId
├── ExternalId
└── CreatedAt

Owner
├── Id
├── UserId
├── CreatedByUserId
└── CreatedAt

AreaAccess
├── Id
├── AreaId
├── UserId
├── CreatedByUserId
└── CreatedAt
```