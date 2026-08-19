# Domain Schema

### Audit
*History and telemetry*
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
```
---
```
ContainerMovementArchive
├── ContainerId
├── FromZoneId
├── FromShelfId
├── ToZoneId
├── ToShelfId
├── CreatedByUserId
└── CreatedAt

ContainerPlacementArchive
├── ContainerId
├── ToZoneId
├── ToShelfId
├── CreatedByUserId
└── CreatedAt

ItemMovementArchive
├── ItemId
├── FromZoneId
├── FromShelfId
├── FromContainerId
├── ToZoneId
├── ToShelfId
├── ToContainerId
├── CreatedByUserId
└── CreatedAt
    
ItemPlacementArchive
├── ItemId
├── ToZoneId
├── ToShelfId
├── ToContainerId
├── CreatedByUserId
└── CreatedAt

ItemSalesArchive
├── ItemId
├── UserId
├── CreatedByUserId
└── CreatedAt

Journal
├── Id
├── PreviousHash
├── Hash
├── Statement
├── Parameters
├── Metadata
├── StartedAt
├── FinishedAt
├── AffectedRows
├── Success
├── Exception
├── TransactionId
└── CreatedAt

RackMovementArchive
├── RackId
├── FromAreaId
├── FromZoneId
├── ToAreaId
├── ToZoneId
├── CreatedByUserId
└── CreatedAt

RackPlacementArchive
├── RackId
├── ToAreaId
├── ToZoneId
├── CreatedByUserId
└── CreatedAt

StockMovementArchive
├── StockId
├── FromZoneId
├── FromShelfId
├── FromContainerId
├── ToZoneId
├── ToShelfId
├── ToContainerId
├── CreatedByUserId
└── CreatedAt

StockPlacementArchive
├── StockId
├── ToZoneId
├── ToShelfId
├── ToContainerId
├── CreatedByUserId
└── CreatedAt

StockSalesArchive
├── StockId
├── Qty
├── UserId
├── CreatedByUserId
└── CreatedAt
```

### Catalog 
*Product definitions*
```
Catalog
├── AreaName
├── Part
├── PartName
├── PartNumber
├── RackName
├── Vehicle
└── ZoneName
```
---
```
AreaName
├── AreaId
├── Value
├── IsPrimary
├── CreatedByUserId
└── CreatedAt

Part
├── Id
├── Status
│   ├── Created
│   ├── Processing
│   ├── Active
│   └── Archived 
│
├── CreatedByUserId
└── CreatedAt

PartNumber
├── PartId
├── Value
├── IsPrimary
├── CreatedByUserId
└── CreatedAt

PartName
├── PartId
├── Value
├── IsPrimary
├── CreatedByUserId
└── CreatedAt   

RackName
├── Id
├── RackId
├── Value
├── IsPrimary
├── CreatedByUserId
└── CreatedAt

Vehicle
├── Id
├── Vin
├── CreatedByUserId
└── CreatedAt

ZoneName
├── ZoneId
├── Value
├── IsPrimary
├── CreatedByUserId
└── CreatedAt
```

### Inventory
*what exists* 
```
Inventory
├── Container
├── Item
├── PhysicalTag
├── Rack
├── Shelf
└── Stock
```
---
```
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

PhysicalTag  
├── Id
├── Status
│   ├── Free
│   ├── Assigned
│   ├── Lost
│   └── Broken
│
└── CreatedAt

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
```

### Identity
*Actors and ownership*
```
Identity
├── AreaAccess
└── Owner
```
---
```
AreaAccess
├── AreaId
├── UserId
├── CreatedByUserId
└── CreatedAt

Owner
├── Id
├── UserId
├── Status
│   ├── Active
│   └── Archived
│
├── CreatedByUserId
└── CreatedAt
```

### Media
*Digital assets* 
```
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
```
---
```
ItemPhoto
├── ItemId
├── StoredFileId
└── CreatedAt

ItemVideo
├── ItemId
├── StoredFileId
└── CreatedAt

PartPhoto
├── PartId
├── StoredFileId
└── CreatedAt

PartVideo
├── PartId
├── StoredFileId
└── CreatedAt

StockPhoto
├── StockId
├── StoredFileId
└── CreatedAt

StockVideo
├── StockId
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

VehiclePhoto
├── VehicleId
├── StoredFileId  
└── CreatedAt

VehicleVideo
├── VehicleId
├── StoredFileId  
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
├── ItemId
├── Stage
│   ├── Identify
│   ├── Capture
│   ├── Inspection
│   └── Placement
│
├── Metadata
├── CreatedByUserId
└── CreatedAt

PartProcessingStep
├── PartId
├── Stage
│   ├── Identify
│   └── Capture
│
├── Metadata
├── CreatedByUserId
└── CreatedAt
```

### Security
*Authentication and authorization*
```
Security
├── Provider
├── Role
├── User
└── UserIdentity
```
---
```
Provider
└── Name

Role
└── Name

User
├── Id
├── Name
├── Role
├── Status
│   ├── Active
│   └── Archived
│
└── CreatedAt

UserIdentity
├── Id
├── UserId
├── Provider
├── ExternalId
└── CreatedAt
```

### Topology 
*where things are*
```
Topology
├── Area
├── ContainerPlacement
├── ItemPlacement
├── RackPlacement
├── StockPlacement
└── Zone
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

ContainerPlacement
├── ZoneId
├── ShelfId
├── ContainerId
└── CreatedAt

ItemPlacement
├── ZoneId
├── ShelfId
├── ContainerId
├── ItemId
└── CreatedAt

RackPlacement
├── AreaId
├── ZoneId
├── RackId
└── CreatedAt   

StockPlacement
├── ZoneId
├── ShelfId
├── ContainerId
├── StockId
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
```