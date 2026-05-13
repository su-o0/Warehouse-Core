# Repository API 

## Topology

[Location](#location)

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

**----------------**

# _Location_
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
- `RuntimeException` — address already exists

# _ContainerPlacement_
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
- `RuntimeException` — Ошибка связи данных

---

### `delete(int $Id)`

#### Return
- `bool` - true on success, false on failure

#### Throws
- `RuntimeException` — not found
