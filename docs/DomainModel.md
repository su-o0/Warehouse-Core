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
**Placement**
    *Id*
    *LocationId*
    *EntityType* > (Container, Item, Stock)
    *EntityId*
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
    *ItemID*
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
    *PartId*
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