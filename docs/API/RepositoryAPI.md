# Repository API methods

 

## Topology
- [Location](#location)
- [ContainerPlacement](#containerplacement)
- [ItemPlacement](#itemplacement)
- [StockPlacement](#stockplacement)

## Inventory
- [Container](#container)
- [Item](#item)
- [Stock](#stock)

## Catalog
- [Part](#part)
- [PartAlias](#partalias)
- [Vehicle](#мehicle)

## Media
- [StoredFile](#storedfile)
- [PartPhoto](#partphoto)
- [ItemPhoto](#itemphoto)
- [StockPhoto](#stockphoto)
- [VehiclePhoto](#vehiclephoto)

## Audit 
- [Telemetry](#telemetry)
- [ItemSalesArhive](#itemsalesarhive)
- [StockSalesArhive](#stocksalesarhive)

## Identity
- [Role](#role)
- [User](#user)
- [UserIdentity](#useridentity)
- [Owner](#owner)
- [PhysicalTag](#physicaltag)

------


# _Location_
#### [Source File](../../src/Repository/Topology/LocationRepository.php)
---
- getById()
- getAll()
- findByAddress()
- findByCreatedByUserId()
- add()
- updateAddress()
- delete()

### `getById(int $id)` 
#### Return
- `null` — not found
- `AddressValue` — location data

---

### `getAll()` 
#### Return
- `array of AddressValue` — array of location data

---

### `findByAddress(string $address)`
#### Return
- `null` — not found
- `AddressValue` — location data

---

### `findByCreatedByUserId(int $user_id)`
#### Return
- `null` — not found
- `array of AddressValue` — array of location data

---

### `add(int $user_id, string $address)`
#### Return
- `int` — created location id
#### Throws
- `RepositoryException` - database error 

---

### `updateAddress(int $id, string $address)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 


------ 

# _ContainerPlacement_
#### [Source File](../../src/Repository/Topology/ContainerPlacementRepository.php)
---
- getById()
- findByLocationId()
- findByContainerId()
- add() 
- updateLocationId()
- delete()

### `getById(int $id)`
#### Return
- `null` — not found
- `ContainerPlacementValue` — container placement data

--- 

### `getByContainerId(int $container_id)`
#### Return
- `null` — not found
- `ContainerPlacementValue` — container placement data

---

### `findByLocationId(int $location_id)`
#### Return
- `null` — not found
- `array of ContainerPlacementValue` — array of container placement data

---

### `add(int $location_id, int $container_id)`
#### Return
- `int` — created container placement id
#### Throws
- `RepositoryException` - database error 

---

### `updateLocationId(int $id, int $location_id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 


------

# _ItemPlacement_
#### [Source File](../../src/Repository/Topology/ItemPlacementRepository.php)
---
- getById()
- findByItemId()
- findByLocationId()
- findByContainerId()
- addByLocationId()
- addByContainerId()
- updateLocationId()
- updateContainerId()
- delete()

### `getById(int $id)`
#### Return
- `null` — not found
- `ItemPlacementValue` — item placement data

---

### `findByItemId(int $item_id)`
#### Return
- `null` — not found
- `ItemPlacementValue` — item placement data

---

### `findByLocationId(int $location_id)`
#### Return
- `null` — not found
- `array of ItemPlacementValue` — array of item placement data

---

### `findByContainerId(int $container_id)`
#### Return
- `null` — not found
- `array of ItemPlacementValue` — array of item placement data

---

### `addByLocationId(int $location_id, string $item_id)`
#### Return
- `int` — created item placement id
#### Throws 
- `RepositoryException` - database error 

---

### `addByContainerId(int $container_id, string $item_id)`
#### Return
- `int` — created item placement id
#### Throws 
- `RepositoryException` - database error 

---

### `updateLocationId(int $id, int $location_id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 

---

### `updateContainerId(int $id, int $container_id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 


------

# _StockPlacement_
#### [Source File](../../src/Repository/Topology/StockPlacementRepository.php)
---
- getById()
- findByStockId()
- findByLocationId()
- findByContainerId()
- addByLocationId()
- addByContainerId()
- updateLocationId()
- updateContainerId()
- delete()

### `getById(int $id)`
#### Return
- `null` — not found
- `StockPlacementValue` — stock placement data

---

### `findByStockId(int $stock_id)`
#### Return
- `null` — not found
- `StockPlacementValue` — stock placement data

---

### `findByLocationId(int $location_id)`
#### Return
- `null` — not found
- `array of StockPlacementValue` — array of stock placement data

---

### `findByContainerId(int $container_id)`
#### Return
- `null` — not found
- `array of StockPlacementValue` — array of stock placement data

---

### `addByLocationId(int $location_id, int $stock_id)`
#### Return
- `int` — created stock placement id
#### Throws 
- `RepositoryException` - database error 

---

### `addByContainerId(int $container_id, int $stock_id)`
#### Return
- `int` — created stock placement id
#### Throws 
- `RepositoryException` - database error 

---

### `updateLocationId(int $id, int $location_id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 

---

### `updateContainerId(int $id, int $container_id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 


------

# _Container_
#### [Source File](../../src/Repository/Inventory/ContainerRepository.php)
---
- getById()
- findByType()
- findByCreatedByUserId()
- add()
- updateType()
- delete()

### `getById(int $id)`
#### Return 
- `null` — not found
- `ContainerEntity` — container data

---

### `findByType(string $type)`
#### Return
- `null` — not found
- `array of ContainerEntity` — array of container data

---

### `findByCreatedByUserId(int $user_id)`
#### Return
- `null` — not found
- `array of ContainerEntity` — array of container data

---

### `add(int $user_id, int $id, string $type)`
#### Return
- `int` — created container id
#### Throws
- `RepositoryException` - database error 

---

### `updateType(int $id, string $type)`
#### Return 
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 


------

# _Item_
#### [Source File](../../src/Repository/Inventory/ItemRepository.php)
---
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

### `getById(int $id)`
#### Return 
- `null` — not found
- `ItemEntity` — item data

---

### `findByPhysicalTagId(int $physical_tag_id)`
#### Return 
- `null` — not found
- `array of ItemEntity` — array of item data

---

### `findByPartId(int $part_id)`
#### Return 
- `array of ItemEntity` — array of item data

---

### `findByVehicleId(int $vehicle_id)`
#### Return 
- `array of ItemEntity` — array of item data

---

### `findByOwnerId(int $owner_id)`
#### Return 
- `array of ItemEntity` — array of item data

---

### `findByStatus(string $status)`
#### Return 
- `array of ItemEntity` — array of item data

---

### `findByCondition(string $condition)`
#### Return 
- `array of ItemEntity` — array of item data

---

### `findByCreatedByUserId(int $user_id)`
#### Return 
- `array of ItemEntity` — array of item data

---

### `add(int $user_id, int $part_id, ?int $vehicle_id = null, int $owner_id)`
#### Return 
- `int` — created item id
#### Throws 
- `RepositoryException` - database error 

---

### `updatePhysicalTagId(int $id, int $physical_tag_id)`
#### Return
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 

---

### `updatePartId(int $id, int $part_id)`
#### Return
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 

---

### `updateVehicleId(int $id, int $part_id)`
#### Return 
- `bool` - true on success, false on failure
### Throws 
- `RepositoryException` - database error 

---

### `updateStatus(int $id, string $status)`
#### Return 
- `bool` - true on success, false on failure
### Throws 
- `RepositoryException` - database error 

---

### `updateCondition(int $id, string $condition)`
#### Return 
- `bool` - true on success, false on failure
### Throws 
- `RepositoryException` - database error 

---

### `updateConditionNote(int $id, string $condition_note)`
#### Return 
- `bool` - true on success, false on failure
### Throws 
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 


------

# _Stock_
#### [Source File](../../src/Repository/Inventory/StockRepository.php)
---
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

### `getById(int $id)`
#### Return 
- `null` — not found
- `StockEntity` — stock data

---

### `findByPartId(int $part_id)`
#### Return 
- `null` — not found
- `array of StockEntity` — array of stock data

---

### `findByStatus(string $status)`
#### Return 
- `null` — not found
- `array of StockEntity` — array of stock data

---

### `findByCreatedByUserId(int $user_id)`
#### Return 
- `null` — not found
- `array of StockEntity` — array of stock data

---

### `add(int $qty, ?int $part_id = null)`
#### Return 
- `int` — created stock id
#### Throws 
- `RepositoryException` - database error 

---

### `updatePartId(int $id, string $part_id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 

---

### `updateQty(int $id, int $qty)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 

---

### `updateStatus(int $id, string $status)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 

---

### `incrementQty(int $id, int $qty = 1)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 

---

### `decrementQty(int $id, int $qty = 1)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 


------



------

# _Part_
#### [Source File](../../src/Repository/Catalog/PartRepository.php)
---
- getById()
- findByArticle()
- findByName()
- add()
- updateName()
- delete()

### `getById(string $id)`
#### Return 
- `null` — not found
- `PartEntity` — part data

---

### `findByArticle(string $article)`
#### Return 
- `null` — not found
- `PartEntity` — part data

---

### `findByName(string $name)`
#### Return 
- `null` — not found
- `PartEntity` — part data

---

### `add(string $article, ?string $name = null)`
#### Return 
- `int` — created part id
#### Throws 
- `RepositoryException` - database error 

---

### `updateName(int $id, string $name)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 


------

# _Vehicle_
#### [Source File](../../src/Repository/Catalog/VehicleRepository.php)
--- 
- getById()
- getAll()
- findByVin()
- add()
- delete()

### `getById(string $id)`
#### Return 
- `null` — not found
- `VehicleEntity` — vehicle data

---

### `getAll()`
#### Return 
- `array of VehicleEntity` — array of vehicle data

---

### `findByVin(string $vin)`
#### Return 
- `null` — not found
- `VehicleEntity` — vehicle data

--

### `add(string $vin)`
#### Return 
--- `int` — created vehicle id  
#### Throws 
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 


------

# _ItemPhoto_
#### [Source File](../../src/Repository/Media/ItemPhotoRepository.php)
---
- getById()
- findByItemId()
- findByFile()
- findByCreatedByUserId()
- add()
- delete()

### `getById(int $id)`
#### Return 
- `null` — not found
- `PhotoEntity` — item photo data

---

### `findByItemId(int $item_id)`
#### Return 
- `null` — not found
- `array of PhotoEntity` — array of item photo data

---

### `findByFile(string $file)`
#### Return
- `null` — not found
- `array of PhotoEntity` — array of item photo data

---

### `findByCreatedByUserId(int $user_id)`
#### Return
- `null` — not found
- `array of PhotoEntity` — array of item photo data

---

### `add(int $user_id, int $item_id, string $file)`
#### Return 
--- `int` — created item photo id
#### Throws 
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 


------

# _StockPhoto_
#### [Source File](../../src/Repository/Media/StockPhotoRepository.php)
---
- getById()
- findByStockId()
- findByFile()
- findByCreatedByUserId()
- add()
- delete()

### `getById(int $id)`
#### Return 
- `null` — not found
- `PhotoEntity` — stock photo data

---

### `findByStockId(int $stock_id)`
#### Return 
- `null` — not found
- `array of PhotoEntity` — array of stock photo data

---

### `findByFile(string $file)`
#### Return
- `null` — not found
- `array of PhotoEntity` — array of stock photo data

---

### `findByCreatedByUserId(int $user_id)`
#### Return
- `null` — not found
- `array of PhotoEntity` — array of stock photo data

---

### `add(int $user_id, int $stock_id, int $file)`
#### Return 
--- `int` — created stock photo id
#### Throws 
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 


------

# _VehiclePhoto_
#### [Source File](../../src/Repository/Media/VehiclePhotoRepository.php)
---
- getById()
- findByVehicleId()
- findByFile()
- findByCreatedByUserId()
- add()
- delete()

### `getById(int $id)`
#### Return 
- `null` — not found
- `PhotoEntity` — vehicle photo data

---

### `findByVehicleId(int $vehicle_id)`
#### Return 
- `null` — not found
- `array of PhotoEntity` — array of vehicle photo data

---

### `findByOwnerId(int $owner_id)`
#### Return 
- `null` — not found
- `array of PhotoEntity` — array of vehicle photo data

---

### `findByFile(string $file)`
#### Return
- `null` — not found
- `array of PhotoEntity` — array of vehicle photo data

---

### `findByCreatedByUserId(int $user_id)`
#### Return
- `null` — not found
- `array of PhotoEntity` — array of vehicle photo data

---

### `add(int $user_id, int $vehicle_id, string $file)`
#### Return 
--- `int` — created vehicle photo id
#### Throws 
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 


------

# _Telemetry_
##### [Source File](../../src/Repository/Audit/TelemetryRepository.php)
---
- getById()
- findByEntityType()
- findByEntity()
- findByAction()
- findByUserId() 
- add()

### `getById(int $id)`
#### Return 
- `null` —  not found
- `TelemetryEntity` — telemetry data

---

### `findByEntityType(string $entity_type)`
#### Return 
- `array of TelemetryEntity` — array of telemetry data

---

### `findByEntity(string $entity_type, int $entity_id)`
#### Return 
- `array of TelemetryEntity` — array of telemetry data

---

### `findByAction(string $action)`
#### Return 
- `array of TelemetryEntity` — array of telemetry data

---

### `findByUserId(int $user_id)`
#### Return 
- `array of TelemetryEntity` — array of telemetry data

---

### `add(string $entity_type, int $entity_id, string $action, string $payload, int $user_id)`
#### Return 
--- `int` — created telemetry id
#### Throws 
- `RepositoryException` - database error 

------

# _ItemSalesArhive_
#### [Source File](../../src/Repository/Audit/ItemSalesArhiveRepository.php)
---
- getById()
- findByItemId()
- findByUserId()
- add() 
- delete()

### `getById(int $id)`
#### Return 
- `null` —  not found
- `ItemSalesArhiveValue` — item sales data

--- 

### `findByItemId(int $item_id)`
#### Return 
- `array of ItemSalesArhiveValue` — array of item sales data

--- 

### `findByUserId(int $user_id)`
#### Return 
- `array of ItemSalesArhiveValue` — array of item sales data

---

### `add(int $item_id, int $user_id)`
#### Return
- `int` — created item sales arhive id
#### Throws
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 


------

# _StockSalesArhive_
#### [Source File](../../src/Repository/Audit/StockSalesArhiveRepository.php)
---
- getById()
- findByItemId()
- findByUserId()
- add() 
- delete()

### `getById(int $id)`
#### Return 
- `null` —  not found
- `StockSalesArchiveValue` — stock sales data

---

### `findByItemId(int $item_id)`
#### Return 
- `array of StockSalesArchiveValue` — array of stock sales data

---

### `findByUserId(int $user_id)`
#### Return 
- `array of StockSalesArchiveValue` — array of stock sales data

---

### `add(int $stock_id, int $qty, int $user_id)`
#### Return
- `int` — created physical tag id
#### Throws
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 


------

# _Role_
#### [Source File](../../src/Repository/Catalog/PartRepository.php)
---
- getById()
- getAll()
- findByName()

### `getById(string $id)`
#### Return 
- `null` — not found
- `RoleEntity` — part data

---

### `getAll()`
#### Return 
- `array of RoleEntity` — array of role data

---

### `findByName(string $name)`
#### Return 
- `RoleEntity` — array of role data


------

# _User_
#### [Source File](../../src/Repository/Identity/UserRepository.php)
---
- getById()
- getAll()
- findByName()
- findByRoleId()
- add()
- updateName()
- updateStatus()
- updateRoleId()
- delete()

### `getById(int $id)`
#### Return 
- `null` — not found
- `UserEntity` — user data

---

### `getAll()`
#### Return 
- `array of UserEntity` — array of user data

---

### `findByName(string $name)`
#### Return 
- `null` — not found
- `UserEntity` — user data

---

### `findByRoleId(int $role_id)`
#### Return 
- `null` — not found
- `array of UserEntity` — array of user data

---

### `add(string $name, int $role_id)`
#### Return
- `int` — created user data id
#### Throws
- `RepositoryException` - database error 

---

### `updateName(int $id, string $name)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 

---

### `updateStatus(int $id, string $status)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 

---

### `updateRoleId(int $id, string $roleId)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 


--- 

# _UserIdentity_
#### [Source File](../../src/Repository/Identity/UserIdentityRepository.php)
---
- getById()
- getAll()
- findByUserId()
- findByProvider()
- findByProviderAndId()
- add()
- delete()

### `getById(int $id)`
#### Return 
- `null` — not found
- `UserIdentityEntity` — user data data

---

### `getAll()`
#### Return
- `array of UserIdentityEntity` — array of user data

---

### `findByUserId(int $user_id)`
#### Return 
- `null` — not found
- `array of UserIdentityEntity` — user data

---

### `findByProvider(string $provider)`
#### Return 
- `null` — not found
- `array of UserIdentityEntity` — user data

---

### `findByProviderAndId(string $provider, string $external_id)`
#### Return 
- `null` — not found
- `array of UserIdentityEntity` — array of user data

---

### `add(int $user_id, string $provider, string $external_id)`
#### Return
- `int` — created user data id
#### Throws
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 


--- 

# _Owner_
#### [Source File](../../src/Repository/Identity/OwnerRepository.php)
---
- getById()
- getAll()
- getByUserId()
- add()
- delete()

### `getById(int $id)`
#### Return 
- `null` — not found
- `OwnerEntity` — owner data

---

### `getAll(int $id)`
#### Return 
- `null` — not found
- `array of OwnerEntity` — array of owner data

---

### `getByUserId(int $user_id)`
#### Return 
- `null` — not found
- `OwnerEntity` — owner data

---

### `add(int $user_id)`
#### Return 
--- `int` — created owner id
#### Throws 
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 


------

# _PhysicalTag_
#### [Source File](../src/Repository/Identity/PhysicalTagRepository.php)
---
- getById()
- findByStatus()
- add()
- updateStatus()
- delete()

### `getById(int $id)`
#### Return 
- `null` — not found
- `PhysicalTagEntity` — physical tag data

---

### `findByStatus(string $status)`
#### Return 
- `null` — not found
- `array of PhysicalTagEntity` — physical tag data

--- 

### `add(int $id, string $status)`
#### Return
- `int` — created physicat tag id
#### Throws
- `RepositoryException` - database error 

---

### `updateStatus(int $id, string $status)`
#### Return
- `bool` - true on success, false on failure
#### Throws 
- `RepositoryException` - database error 

---

### `delete(int $id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws
- `RepositoryException` - database error 


------
