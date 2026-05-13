# Repository API 

## Logistics
[Location](#location)
[Placement](#placement)
[PhysicalTag](#physicalTag)
## Inventory
[Container](#container)
[Item](#item)
[Stock](#stock)
## Catalog
[Part](#part)
[Car](#car)
## Media
[ItemPhoto](#itemphoto)
[StockPhoto](#stockphoto)
[CarPhoto](#carphoto)
## Audit 
[History](#history)
[Sales](#sales)
[Owner](#owner)

**----------------**

# *Location*
`findByAddress`
`findById`
`add`

# *Placement*
`findById`
`findByIdLocation`
`findByEntityType`
`findByEntity`
`isStateEntityType`
`add`
`updateEntity`
`delete`

# *Container*
`findById`
`findByType`
`add`
`updateType`
`delete`
`isStateType`

# *PhysicalTag*
`findByIdPhysicalTag`
`findByStatus`
`add`
`updateStatus`
`isStateStatus`

# *Item*
`findById`
`findByIdPhysicalTag`
`findByIdPart`
`findByIdCar`
`findByStatus`
`findByCondition`
`findActiveByIdTag`
`add`
`updateIdPhysicalTag`
`updatePartId`
`updateCarId`
`updateStatus`
`updateCondition`
`isStateStatus`
`isStateCondition`

# *Stock*
`findById`
`findByIdPart`
`add`
`updateQty`
`incrementQty`
`decrementQty`
`delete`

# *Part*
`findById`
`findByArticle`
`findByName`
`add`
`updateName`
`findOrCreate`

# *Car*
`findById`
`findByVin`
`add`
`findOrCreate`

# *ItemPhoto*
`findById`
`findByIdItem`
`findByIdOwner`
`findByFile`
`add`

# *StockPhoto*
`findById`
`findByIdItem`
`findByIdOwner`
`findByFile`
`add`

# *CarPhoto*
`findById`
`findByIdItem`
`findByIdOwner`
`findByFile`
`add`

# SalesArhive

# History

# *Owner*
`findById`
`findByIdUser`
`findByPermission`
`findByName`
`add`
`updatePermission`
`isStatePermission`