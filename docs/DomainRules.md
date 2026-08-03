# Domain model

```
Location
ContainerPlacement
ItemPlacement
StockPlacement
Container
Item
Stock
ItemProcessingStep
Part
PartNumber
PartName
Vehicle
StoredFile
PartPhoto
ItemPhoto
StockPhoto
VehiclePhoto
Telemetry
ItemSalesArhive
StockSalesArhive
ItemMovement
ContainerMovement
StockMovement
Role
User
UserIdentity
Owner
PhysicalTag
```
---
```md
Topology 
Inventory
Media
Identity

```
## Identity 
- CreateUser
- CreateUserIdentity
- CreatePhysicalTag

## Location 
- CreateLocation
- ActivateLocation
- ArchiveLocation
- DeleteLocation 

## Placement
- PlaceContainer 
- PlaceItem
- PlaceStock
- PlaceItemToContainer
- PlaceStockToContainer
- RemoveContainer
- RemoveItem
- RemoveStock

## Movemet
- MoveContainer
- MoveItem
- MoveStock
- ExtractItem
- ExtractStock

## Inventory
- AssignPhysicalTag
- CreateContainer
- CreateContainer

# Query
- GetLocation
- ListLocation

