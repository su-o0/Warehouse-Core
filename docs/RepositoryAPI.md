# Repository API 

## Topology
- [Location](#location)
- [PhysicalTag](#physicaltag)
- [ContainerPlacement](#containerplacement)
- [ItemPlacement](#itemplacement)
- [StockPlacement](#stockplacement)

## Inventory
- [Container](#container)
- [Item](#item)
- [Stock](#stock)

## Catalog
- [Part](#part)
- [Car](#car)

## Media
- [ItemPhoto](#itemphoto)
- [StockPhoto](#stockphoto)
- [CarPhoto](#carphoto)

## Audit 
- [History](#history)
- [Sales](#sales)
- [Owner](#owner)


isState -> isValid

------


# _Location_
- [Source File](../src/Repository/Topology/LocationRepository.php)
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
- `int` — created location Id
#### Throws
- `StorageException` — `LOCATION_ALREADY_EXISTS`

---

### `getAll()` 
#### Return
- `array` — all location

------ 

# _PhysicalTag_
- [Source File](../src/Repository/Topology/PhysicalTagRepository.php)
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
- `int` — created Location id
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

### `isValidStatus(string $Status)`
#### Return 
- `bool` - true on success, false on failure


------

# _ContainerPlacement_
- [Source File](../src/Repository/Topology/ContainerPlacementRepository.php)
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
- `int` — created containers placement id
#### Throws
- `StorageException` — `DB_RELATION_ERROR`

---

### `updateLocationId(int $Id, int $LocationId)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `StorageException` — `DB_RELATION_ERROR`
- `StorageException` - `CONTAINER_PLACEMENT_NOT_FOUND`

---

### `delete(int $Id)`

#### Return
- `bool` - true on success, false on failure
#### Throws
- `StorageException` — `CONTAINER_PLACEMENT_NOT_FOUND`


------

# _ItemPlacement_
- [Source File](../src/Repository/Topology/ItemPlacementRepository.php)
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
- `int` — created ItemPlacement id
#### Throws 
- `StorageException` - `DB_RELATION_ERROR`

---

### `updateLocationId(int $Id, int $LocationId)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `StorageException` — `DB_RELATION_ERROR`
- `StorageException` - `ITEM_PLACEMENT_NOT_FOUND`

---

### `delete(int $Id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `StorageException` — `ITEM_PLACEMENT_NOT_FOUND`


------

# _StockPlacement_
- [Source File](../src/Repository/Topology/StockPlacementRepository.php)
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
- `int` — created stockPlacement id
#### Throws 
- `StorageException` - `DB_RELATION_ERROR`

---

### `updateLocationId(int $Id, int $LocationId)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `StorageException` — `DB_RELATION_ERROR`
- `StorageException` - `STOCK_PLACEMENT_NOT_FOUND`

---

### `delete(int $Id)`
#### Return
- `bool` - true on success, false on failure
#### Throws
- `StorageException` — `STOCK_PLACEMENT_NOT_FOUND`


------

# _Container_
- [Source File](../src/Repository/Inventory/ContainerRepository.php)
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
- `int` — created container id
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
- [Source File](../src/Repository/Inventory/ItemRepository.php)
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
- `int` — created container id
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

### `updateContainerId(int $Id, ?int $ContainerId = null)`
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

### `isValidStatus(string $Status)`
#### Return 
- `bool` - true on success, false on failure

---

### `isValidCondition(string $Condition)`
#### Return 
- `bool` - true on success, false on failure


------

# _Stock_
- [Source File](../src/Repository/Inventory/StockRepository.php)
### `findById(int $Id)`
#### Return 
- `null` — not found
- `array` — stock data

---

### `findByPartId(int $PartId)`
#### Return 
- `null` — not found
- `array` — stock data

---

### `findByContainerId(int $ContainerId)`
#### Return 
- `null` — not found
- `array` — stock data

---

### `add(int $Qty, ?int $PartId = null)`
#### Return 
- `int` — created stock id
#### Throws 
- `StorageException` - `DB_RELATION_ERROR`

---

### `updateContainerId(int $Id, ?int $ContainerId = null)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `StorageException` - `STOCK_NOT_FOUND`
- `StorageException` - `DB_RELATION_ERROR`

---

### `updatePartId(int $Id, string $PartId)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `StorageException` - `STOCK_NOT_FOUND`
- `StorageException` - `DB_RELATION_ERROR`

---

### `updateQty(int $Id, int $Qty)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `StorageException` - `STOCK_NOT_FOUND`
- `StorageException` - `DB_RELATION_ERROR`

---

### `incrementQty(int $Id, int $Qty = 1)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `StorageException` - `STOCK_NOT_FOUND`
- `StorageException` - `DB_RELATION_ERROR`

---

### `decrementQty(int $Id, int $Qty = 1)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `StorageException` - `STOCK_NOT_FOUND`
- `StorageException` - `DB_RELATION_ERROR`

---

### `delete(int $Id)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `StorageException` - `STOCK_NOT_FOUND`
- `StorageException` - `DB_RELATION_ERROR`


------

# _Part_
- [Source File](../src/Repository/Catalog/PartRepository.php)
### `findById(string $Id)`
#### Return 
- `null` — not found
- `array` — part data

---

### `findByArticle(string $Article)`
#### Return 
- `null` — not found
- `array` — part data

---

### `findByName(string $Name)`
#### Return 
- `null` — not found
- `array` — part data

---

### `add(string $Article, ?string $Name = null)`
#### Return 
- `int` — created part id
#### Throws 
- `StorageException` - `PART_ALREADY_EXISTS`
- `StorageException` - `DB_RELATION_ERROR`

---

### `updateName(int $Id, string $Name)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `StorageException` - `PART_NOT_FOUND`

---

### `findOrCreate(string $Article, ?string $Name = null)`
#### Return 
- `array` — part data


------

# _Car_
- [Source File](../src/Repository/Catalog/CarRepository.php)
### `findById(string $Id)`
#### Return 
- `null` — not found
- `array` — car data

---

### `findByVin(string $Vin)`
#### Return 
- `null` — not found
- `array` — car data

---

### `findByName(string $Name)`
#### Return 
- `null` — not found
- `array` — car data

---

### `add(string $Vin)`
#### Return 
--- `int` — created car id  
#### Throws 
- `StorageException` - `CAR_ALREADY_EXISTS`

### `findOrCreate(string $vin)`
#### Return 
- `array` — car data


------

# _ItemPhoto_
- [Source File](../src/Repository/Media/ItemPhotoRepository.php)
### `findById(int $Id)`
#### Return 
- `null` — not found
- `array` — itemphoto data

---

### `findByItemPId(int $ItemPId)`
#### Return 
- `null` — not found
- `array` — itemphoto data

---

### `findByOwnerId(int $OwnerId)`
#### Return 
- `null` — not found
- `array` — itemphoto data

---

### `findByFile(string $File)`
#### Return
- `null` — not found
- `array` — itemphoto data

---
### `add(int $ItemPId, int $OwnerId, string $File)`
#### Return 
--- `int` — created itemphoto id
#### Throws 
- `StorageException` - `ITEM_PHOTO_ALREADY_EXISTS`
- `StorageException` - `DB_RELATION_ERROR`


------

# _Stockhoto_
- [Source File](../src/Repository/Media/StockPhotoRepository.php)
### `findById(int $Id)`
#### Return 
- `null` — not found
- `array` — stockphoto data

---

### `findByStockId(int $StockId)`
#### Return 
- `null` — not found
- `array` — stockphoto data

---

### `findByOwnerId(int $OwnerId)`
#### Return 
- `null` — not found
- `array` — stockphoto data

---

### `findByFile(string $File)`
#### Return
- `null` — not found
- `array` — stockphoto data

---

### `add(int $StockId, int $OwnerId, string $File)`
#### Return 
--- `int` — created stockphoto id
#### Throws 
- `StorageException` - `STOCK_PHOTO_ALREADY_EXISTS`
- `StorageException` - `DB_RELATION_ERROR`


------

# _Carhoto_
- [Source File](../src/Repository/Media/CarPhotoRepository.php)
### `findById(int $Id)`
#### Return 
- `null` — not found
- `array` — carphoto data

---

### `findByCarId(int $CarId)`
#### Return 
- `null` — not found
- `array` — carphoto data

---

### `findByOwnerId(int $OwnerId)`
#### Return 
- `null` — not found
- `array` — carphoto data

---

### `findByFile(string $File)`
#### Return
- `null` — not found
- `array` — carphoto data

---
### `add(int $CarId, int $OwnerId, string $File)`
#### Return 
--- `int` — created carphoto id
#### Throws 
- `StorageException` - `CAR_PHOTO_ALREADY_EXISTS`
- `StorageException` - `DB_RELATION_ERROR`


------

# _History_
- [Source File](../src/Repository/Audit/HistoryRepository.php)
### `add(string $Action, string $EntityType, int $EntityId, int $OwnerId, ?string $Note = null)`
#### Return 
--- `int` — created owner id
#### Throws
- `StorageException` - `DB_RELATION_ERROR`


------

# _Sales_
- [Source File](../src/Repository/Audit/SalesArhiveRepository.php)
### `add(?int $itemId, ?int $stockId, int $partId, int $containerId, ?int $carId, int $saleOwnerId)`
#### Return 
- `bool` - true on success, false on failure
#### Throws
- `StorageException` - `DB_RELATION_ERROR`


------

# _Owner_
- [Source File](../src/Repository/Audit/OwnerRepository.php)
### `findById(int $Id)`
#### Return 
- `null` — not found
- `array` — owner data

---

### `findByIdUser(int $IdUser)`
#### Return 
- `null` — not found
- `array` — owner data

---

### `findByPermission(string $Permission)`
#### Return 
- `null` — not found
- `array` — owner data

---

### `findByName(string $Name)`
#### Return 
- `null` — not found
- `array` — owner data

---

### `add(int $IdUser, string $Permission, string $Name)`
#### Return 
--- `int` — created owner id
#### Throws 
- `StorageException` - `OWNER_NAME_ALREADY_EXISTS`
- `StorageException` - `OWNER_USERID_ALREADY_EXISTS`
- `StorageException` - `OWNER_INVALID_PERMISSION`
- `StorageException` - `DB_RELATION_ERROR`

---

### `updatePermission(int $Id, string $Permission)`
#### Return 
- `bool` - true on success, false on failure
#### Throws 
- `StorageException` - `OWNER_NOT_FOUND`
- `StorageException` - `OWNER_INVALID_PERMISSION`

---

### `isValidPermission(string $Permission)`
#### Return 
- `bool` - true on success, false on failure

---

### `getAll()` 
#### Return
- `array` — all owner


------