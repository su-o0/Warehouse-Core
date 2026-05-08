# Storage Domain
**inventory domain model**
*Location*
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
    *IdA*
    *Address*
**Container** 
    *IdC*
    *IdA*
    *Type* > (Bulk, Box, Area)
**PhysicalTag**  
    *IdTag*
    *Status* > (Free, Assigned, Lost, Broken)
    *CreatedAt*

# Inventory
**Item** 
    *Id*
    *IdC*
    *IdTag*
    *IdPart*
    *IdCar*
    *Status* > (Active, Sold, Archived, Lost)
    *Condition* > (New, Good, Fair, Poor)
    *ConditionNote*
    *CreatedAt*
**Stock**
    *Id*
    *IdC*
    *IdPart*
    *Qty*
    *CreatedAt*

## Catalog 
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
    *File*
    *Owner*
**CarPhoto**
    *Id*
    *IdCar*
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