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
├── AreaId
├── ZoneId
├── RackId
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

StockPlacement
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
│   ├── nActive
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
├── AreaId
├── Value
├── IsPrimary
├── CreatedByUserId
└── CreatedAt

ZoneName
├── ZoneId
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
└── Journal
```
---
```
ItemSalesArchive
├── ItemId
├── UserId
├── CreatedByUserId
└── CreatedAt

StockSalesArchive
├── StockId
├── Qty
├── UserId
├── CreatedByUserId
└── CreatedAt

RackPlacementArchive
├── RackId
├── ToAreaId
├── ToZoneId
├── CreatedByUserId
└── CreatedAt

ContainerPlacementArchive
├── ContainerId
├── ToZoneId
├── ToShelfId
├── CreatedByUserId
└── CreatedAt

ItemPlacementArchive
├── ItemId
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

RackMovementArchive
├── RackId
├── FromAreaId
├── FromZoneId
├── ToAreaId
├── ToZoneId
├── CreatedByUserId
└── CreatedAt

ContainerMovementArchive
├── ContainerId
├── FromZoneId
├── FromShelfId
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
└── Name

Provider
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

Owner
├── Id
├── UserId
├── Status
│   ├── Active
│   └── Archived
│
├── CreatedByUserId
└── CreatedAt

AreaAccess
├── AreaId
├── UserId
├── CreatedByUserId
└── CreatedAt
```