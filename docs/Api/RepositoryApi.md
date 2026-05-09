# Repository API *SQL abstraction*

# **Logistics**
## Location
`findByAddress`
`findByIdA`
`add`
## Container
`findByIdC`
`findByIdA`
`add`
`updateIdA`
## PhysicalTag
`findByIdTag`
`findByStatus`
`add`
`updateStatus`
# **Inventory**
## Item
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
## Stock
`findById`
`findByIdC`
`findByIdPart`
`add`
`updateQty`
`incrementQty`
`decrementQty`
`delete`
# **Catalog**
## Part
`findById`
`findByArticle`
`findByName`
`add`
`updateName`
`findOrCreate`
## Car
`findById`
`findByVin`
`add`
`findOrCreate`
# **Media**
## ItemPhoto
`findById`
`findByIdCar`
`findByIdOwner`
`findByFile`
`add`
## StockPhoto
`findById`
`findByIdCar`
`findByIdOwner`
`findByFile`
`add`
## CarPhoto 
`findById`
`findByIdCar`
`findByIdOwner`
`findByFile`
`add`
# **Audit**
## History
`add`
## Sales
`add`
## Owner
`findById`
`findByIdUser`
`findByPermission`
`findByName`
`add`
`updatePermission`