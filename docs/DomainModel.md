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
    *IdLocation*
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
    *IdPhysicalTag*
    *IdPart*
    *IdCar*
    *Status* > (Active, Sold, Archived, Lost)
    *Condition* > (New, Good, Fair, Poor)
    *ConditionNote*
    *CreatedAt*
**Stock**
    *Id*
    *IdPart*
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
    *IdItem*
    *IdOwner*
    *File*
**StockPhoto**
    *Id*
    *IdStock*
    *IdOwner*
    *File*
**CarPhoto**
    *Id*
    *IdCar*
    *IdOwner*
    *File*    

## Audit
**SalesArhive**
    *Id*
    *IdPart*
    *IdItem*
    *IdStock*
    *Qty*
    *SaleOwner*
    *CreatedAt*
**History**
    *Id*
    *Action*
    *ActionOwner*
    *EntityType*
    *EntityId*
    *Note*
    *CreatedAt*
**Owner**
    *Id*
    *IdUser*
    *Permission* > ( admin, worker )
    *Name*
    *CreatedAt*