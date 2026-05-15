# Repository API 

## Topology
[Location](#location)

[PhysicalTag](#physicaltag)

[ContainerPlacement](#containerplacement)

[ItemPlacement](#itemplacement)

[StockPlacement](#stockplacement)

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


isState -> isValid

------



# _Location_
[Source File](../../src/Repository/Topology/LocationRepository.php)
### `findByAddress(string $address)`
#### Return
- `null` — not found
- `array` — location data

---

### `findById(int $id)`
#### Return
- `null` — not found
- `array` — location data

---

### `add(string $address)`
#### Return
- `int` — created Location Id
#### Throws
- `StorageException` — `LOCATION_ALREADY_EXISTS`

---
### `getAll()` 
#### Return
- `array` — All Location Id

------ 


# _PhysicalTag_
[Source File](../../src/Repository/Topology/PhysicalTagRepository.php)
### `findById(int $Id)`
#### Return 
- `null` — not found
- `array` — location data

---

### `findByStatus(string $Status)`
#### Return 
- `null` — not found
- `array` — location data

--- 
### `add(int $Id, string $Status)`
#### Return
- `int` — created Location Id
#### Throws
- `StorageException` - `PHYSICAL_TAG_INVALID_STATUS`

---

### `updateStatus(int $Id, string $Status)`
#### Return
- `bool` - true on success, false on failure
#### Throws 
- `StorageException` - `PHYSICAL_TAG_INVALID_STATUS`
- `StorageException` - `PHYSICAL_TAG_ALREADY_EXISTS`

---

### `isStateStatus(string $Status)`
#### Return 
- `bool` - true on success, false on failure


------


# _ContainerPlacement_
[Source File](../../src/Repository/Topology/ContainerPlacementRepository.php)
### `findById(int $Id)`
#### Return
- `null` — not found
- `array` — container placement data

--- 

### `findByLocationId(int $LocationId)`
#### Return
- `null` — not found
- `array` — containers placement data

---

### `findByContainerId(string $ContainerId)`
#### Return
- `null` — not found
- `array` — container placement data

---

### `add(int $LocationId, string $ContainerId)`
#### Return
- `int` — created containers placement Id
#### Throws
- `StorageException` — `DB_RELATION_ERROR`

---

### `delete(int $Id)`

#### Return
- `bool` - true on success, false on failure
#### Throws
- `StorageException` — `CONTAINER_PLACEMENT_NOT_FOUND`


------


# _ItemPlacement_
[Source File](../../src/Repository/Topology/ItemPlacementRepository.php)
### `findById(int $Id)`
#### Return
- `null` — not found
- `array` — item placement data

---

### `findByLocationId(int $LocationId)`
#### Return
- `null` — not found
- `array` — items placement data

---

### `findByItemId(string $ItemId)`
#### Return
- `null` — not found
- `array` — item placement data

---

### `add(int $LocationId, string $ItemId)`
#### Return
- `int` — created ItemPlacement Id
#### Throws 
- `StorageException` - `DB_RELATION_ERROR`
---

### `delete(int $Id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `StorageException` — `ITEM_PLACEMENT_NOT_FOUND`


------


# _StockPlacement_
[Source File](../../src/Repository/Topology/StockPlacementRepository.php)
### `findById(int $Id)`
#### Return
- `null` — not found
- `array` — stock placement data

---

### `findByLocationId(int $LocationId)`
#### Return
- `null` — not found
- `array` — stock placement data

---

### `findByStockId(string $StockId)`
#### Return
- `null` — not found
- `array` — stock placement data

---

### `add(int $LocationId, string $StockId)`
#### Return
- `int` — created stockPlacement Id
#### Throws 
- `StorageException` - `DB_RELATION_ERROR`

---

### `delete(int $Id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `StorageException` — `STOCK_PLACEMENT_NOT_FOUND`


------


# _Container_
[Source File](../../src/Repository/Inventory/ContainerRepository.php)
### `findById(int $Id)`
#### Return 
- `null` — not found
- `array` — container data

---

### `findByType(int $Type)`
#### Return
- `null` — not found
- `array` — containers data
#### Throws
- `StorageException` - `CONTAINER_INVALID_TYPE`

---

### `add(int $Id, string $Type)`
#### Return
- `int` — created container Id
#### Throws
- `StorageException` - `CONTAINER_INVALID_TYPE`
- `StorageException` - `CONTAINER_ALREADY_EXISTS`

---

### `updateType(int $Id, string $Type)`
#### Return 
- `bool` - true on success, false on failure
#### Throws
- `StorageException` - `CONTAINER_INVALID_TYPE`
- `StorageException` - `CONTAINER_NOT_FOUND`

---

### `delete(int $Id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `StorageException` - `CONTAINER_NOT_FOUND`

---

### `isValidType(string $Type)`
#### Return 
- `bool` - true on success, false on failure


------


# _Item_
[Source File](../../src/Repository/Inventory/ItemRepository.php)
### `findById(int $Id)`
#### Return 
- `null` — not found
- `array` — item data

---

### `findByPhysicalTagId(int $PhysicalTagId)`
#### Return 
- `null` — not found
- `array` — items data

---

### `findByContainerId(int $ContainerId)`
#### Return 
- `null` — not found
- `array` — items data

---

### `findByPartId(int $PartId)`
#### Return 
- `null` — not found
- `array` — items data

---

### `findByCarId(string $CarId)`
#### Return 
- `null` — not found
- `array` — items data

---

### `findByStatus(string $Status)`
#### Return 
- `null` — not found
- `array` — items data

---

### `findByCondition(string $Condition)`
#### Return 
- `null` — not found
- `array` — item data

---

### `findByPhysicalTagIdStatus(int $PhysicalTagId, string $Status)`
#### Return 
- `null` — not found
- `array` — item data

---

### `add(int $PhysicalTagId, int $PartId, ?int $CarId = null)`
#### Return 
- `int` — created container Id
#### Throws 
- `StorageException` - `ITEM_PHYSICAL_TAG_ALREADY_USED`
- `StorageException` - `DB_RELATION_ERROR`

---

### `updatePhysicalTagId(int $Id, int $PhysicalTagId)`
#### Return
- `bool` - true on success, false on failure
#### Throws 
- `StorageException` - `ITEM_NOT_FOUND`
- `StorageException` - `DB_RELATION_ERROR`

---

### `updateContainerId(int $Id, int $ContainerId)`
#### Return
- `bool` - true on success, false on failure
#### Throws 
- `StorageException` - `ITEM_NOT_FOUND`
- `StorageException` - `DB_RELATION_ERROR`

---

### `updatePartId(int $Id, int $IdPart)`
#### Return 
- `bool` - true on success, false on failure
### Throws 
- `StorageException` - `ITEM_NOT_FOUND`
- `StorageException` - `DB_RELATION_ERROR`

---

### `updateCarId(int $Id, int $CarId)`
#### Return 
- `bool` - true on success, false on failure
### Throws 
- `StorageException` - `ITEM_NOT_FOUND`
- `StorageException` - `DB_RELATION_ERROR`

---

### `updateStatus(int $Id, string $Status)`
#### Return 
- `bool` - true on success, false on failure
### Throws 
- `StorageException` - `ITEM_NOT_FOUND`
- `StorageException` - `ITEM_INVALID_STATUS`

---

### `updateCondition(int $Id, string $Condition, ?string $ConditionNote = null)`
#### Return 
- `bool` - true on success, false on failure
### Throws 
- `StorageException` - `ITEM_NOT_FOUND`
- `StorageException` - `ITEM_INVALID_CONDITION`

---

### `isStateStatus(string $Status)`
#### Return 
- `bool` - true on success, false on failure

---

### `isStateCondition(string $Condition)`
#### Return 
- `bool` - true on success, false on failure


------


# _Stock_
[Source File](../../src/Repository/Inventory/StockRepository.php)
### `findById(int $Id)`

---

### `findByPartId(int $PartId)`

---

### `findByContainerId(int $ContainerId)`

---

### `add(int $Qty, ?int $PartId = null)`

---

### `updateContainerId(int $Id, int $ContainerId)`

---

### `updatePartId(int $Id, string $PartId)`

---

### `updateQty(int $Id, int $Qty)`

---

### `incrementQty(int $Id, int $Qty = 1)`

---

### `decrementQty(int $Id, int $Qty = 1)`

---

### `delete(int $Id)`


------


# _Part_
[Source File](../../src/Repository/Catalog/PartRepository.php)
### `findById(string $Id)`

---

### `findByArticle(string $Article)`

---

### `findByName(string $Name)`

---

### `add(string $Article, ?string $Name = null)`

---

### `updateName(int $Id, string $Name)`

---

### `findOrCreate(string $Article, ?string $Name = null)`


------


# _Car_
[Source File](../../src/Repository/Catalog/CarRepository.php)
### `findById(string $Id)`

---

### `findByVin(string $Vin)`

---

### `findByName(string $Name)`

---

### `add(string $Vin)`

---

### `findOrCreate(string $vin)`


------


# _ItemPhoto_
[Source File](../../src/Repository/Media/ItemPhotoRepository.php)


------


# _Stockhoto_
[Source File](../../src/Repository/Media/StockPhotoRepository.php)


------


# _Carhoto_
[Source File](../../src/Repository/Media/CarPhotoRepository.php)


------


# _History_
[Source File](../../src/Repository/Audit/HistoryRepository.php)


------


# _Sales_
[Source File](../../src/Repository/Audit/SalesArhiveRepository.php)


------


# _Owner_
[Source File](../../src/Repository/Audit/OwnerRepository.php)
### `findById(int $Id)`

---

### `findByIdUser(int $IdUser)`

---

### `findByPermission(string $Permission)`

---

### `findByName(string $Name)`

---

### `add(int $IdUser, string $Permission, string $Name)`

---

### `updatePermission(int $Id, string $Permission)`

---

### `isStatePermission(string $Permission)`