# Storage Domain
**inventory domain model**
*Location*
*Placement*
*Container*
*PhysicalTag*
*Item*
*Stock*
*Part*
*Car*
*ItemPhoto*
*StockPhoto*
*CarPhoto*
*SalesArhive*
*History*
*Owner*

# Logistics 
**Location** 
    *Id*
    *Address*
    *CreatedAt*
**ContainerPlacement**
    *Id*
    *LocationId*
    *ContainerId*
    *CreatedAt*
**ItemPlacement**
    *Id*
    *LocationId*
    *ItemId*
    *CreatedAt*
**StockPlacement**
    *Id*
    *LocationId*
    *StockId*
    *CreatedAt*
**PhysicalTag**  
    *Id*
    *Status* > (Free, Assigned, Lost, Broken)
    *CreatedAt*

# Inventory
**Container** 
    *Id*
    *Type* > (Box, Pallet)
    *CreatedAt*
**Item** 
    *Id*
    *PhysicalTagId*
    *ContainerId* 
    *PartId*
    *CarId*
    *Status* > (Active, Sold, Archived, Lost)
    *Condition* > (New, Good, Fair, Poor)
    *ConditionNote*
    *CreatedAt*
**Stock**
    *Id*
    *ContainerId* 
    *PartId*
    *Qty*
    *CreatedAt*

## Identity 
**Part**
    *Id*
    *Article*
    *Name*
    *CreatedAt*
**Car**
    *Id*
    *Vin*
    *CreatedAt*

# Media 
**ItemPhoto**
    *Id*
    *ItemId*
    *OwnerId*
    *File*
**StockPhoto**
    *Id*
    *StockId*
    *OwnerId*
    *File*
**CarPhoto**
    *Id*
    *CarId*
    *OwnerId*
    *File*    

## Audit
**SalesArhive**
    *Id*
    *ItemId*
    *StockId*
    *Qty*
    *OwnerId*
    *CreatedAt*
**History**
    *Id*
    *Action*
    *EntityType*
    *EntityId*
    *Note*
    *OwnerId*
    *CreatedAt*
**Owner**
    *Id*
    *UserId*
    *Permission* > ( admin, worker, Salesman )
    *Name*
    *CreatedAt*