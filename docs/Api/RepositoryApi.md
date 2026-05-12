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


## [PhysicalTag](RepositoryAPI/PhysicalTagAPI.md)
`findByIdTag`
`findByStatus`
`add`
`updateStatus`

# **Inventory**
## [Item](RepositoryAPI/ItemAPI.md)
`findById`
`findByIdC`
`findByIdTag`
`findByIdPart`
`findByIdCar`
`findByStatus`
`findByCondition`
`findActiveByIdTag`
`add`
`updateIdC`
`updateIdTag`
`updatePartId`
`updateCarId`
`updateStatus`
`updateCondition`
`updateConditionNote`
## [Stock](RepositoryAPI/StockAPI.md)
`findById`
`findByIdC`
`findByIdPart`
`add`
`updateQty`
`incrementQty`
`decrementQty`
`delete`

# **Catalog**
## [Part](RepositoryAPI/PartAPI.md)
`findById`
`findByArticle`
`findByName`
`add`
`updateName`
`findOrCreate`
## [Car](RepositoryAPI/CarAPI.md)
`findById`
`findByVin`
`add`
`findOrCreate`

# **Media**
## [ItemPhoto](RepositoryAPI/ItemPhotoAPI.md)
`findById`
`findByIdCar`
`findByIdOwner`
`findByFile`
`add`
## [StockPhoto](RepositoryAPI/StockPhotoAPI.md)
`findById`
`findByIdCar`
`findByIdOwner`
`findByFile`
`add`
## [CarPhoto](RepositoryAPI/CarPhotoAPI.md)
`findById`
`findByIdCar`
`findByIdOwner`
`findByFile`
`add`

# **Audit**
## [History](RepositoryAPI/HistoryAPI.md)
`add`
## [Sales](RepositoryAPI/SalesAPI.md)
`add`
## [Owner](RepositoryAPI/OwnerAPI.md)
`findById`
`findByIdUser`
`findByPermission`
`findByName`
`add`
`updatePermission`