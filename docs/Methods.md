# Repository API methods

# _Location_
- getById()
- getAll()
- findByAddress()
- findByCreatedByUserId()
- add()
- updateAddress()
- delete()

# _ContainerPlacement_
- getById()
- findByLocationId()
- findByContainerId()
- add() 
- updateLocationId()
- delete()

# _ItemPlacement_
- getById()
- findByItemId()
- findByLocationId()
- findByContainerId()
- addByLocationId()
- addByContainerId()
- updateLocationId()
- updateContainerId()
- delete()

# _StockPlacement_
- getById()
- findByStockId()
- findByLocationId()
- findByContainerId()
- addByLocationId()
- addByContainerId()
- updateLocationId()
- updateContainerId()
- delete()

# _Container_
- getById()
- findByType()
- findByCreatedByUserId()
- add()
- updateType()
- delete()

# _Item_
- getById()
- findByPhysicalTagId()
- findByPartId()
- findByVehicleId()
- findByOwnerId()
- findByStatus()
- findByCondition()
- findByCreatedByUserId()
- add()
- updatePhysicalTagId()
- updatePartId()
- updateVehicleId()
- updateStatus()
- updateCondition()
- updateConditionNote()
- delete()

# _Stock_
- getById()
- findByPartId()
- findByStatus()
- findByCreatedByUserId()
- add()
- updatePartId()
- updateQty()
- updateStatus()
- incrementQty()
- decrementQty()
- delete()

# _Part_
- getById()
- findByArticle()
- findByName()
- add()
- updateName()
- delete()

# _Vehicle_
- getById()
- findByVin()
- add()
- getAll()
- delete()

# _ItemPhoto_
- getById()
- findByItemId()
- findByFile()
- findByCreatedByUserId()
- add()
- delete()

# _StockPhoto_
- getById()
- findByStockId()
- findByFile()
- findByCreatedByUserId()
- add()
- delete()

# _VehiclePhoto_
- getById()
- findByVehicleId()
- findByFile()
- findByCreatedByUserId()
- add()
- delete()

# _Telemetry_
- getById()
- findByEntityType()
- findByEntityTypeAndId()
- findByAction()
- findByUserId() 
- add()
 
# _ItemSalesArhive_
- getById()
- findByItemId()
- findByUserId()
- add() 
- delete()

# _StockSalesArhive_
- getById()
- findByStockId()
- findByUserId()
- add() 
- delete()

# _User_
- getById()
- getAll()
- findByName()
- findByRoleId()
- add()
- updateName()
- updateStatus()
- updateRoleId()
- delete()

# _UserIdentity_
- getById()
- getAll()
- findByUserId()
- findByProvider()
- findByProviderAndId()
- add()
- delete()

# _Owner_
- getById()
- getAll()
- getByUserId()
- add()
- delete()

# _PhysicalTag_
- getById()
- findByStatus()
- add()
- updateStatus()
- delete()

---