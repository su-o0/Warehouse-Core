# Repository Api

## **Location** 
### Найти IdA по строке адреса.
`find` ( *string Adress* )
return  
    `null` - не существует
    `int Id` - найден

### Найти строку адреса по IdA.
`findById` ( *int Id* )
return 
    `null` - не существует 
    `string Address` - найден

### Добавить новый адрес. Адрес должен быть уникальным.
`add` ( *string Adress* )
return 
    `null` - не существует 
    `int Id` - найден или создан 


## **Container**
### Найти все IdC по IdA.
`findAllByAddressId` ( *int addressId* )
return 
    `null` - не существует 
    `array` - найден 

### Найти адресс IdA контейнера по IdC.
`findById` ( *int containerId* )
return
    `null` - не существует 
    `array` - найден 

### Добавить новый контейнер. Контейнер должен быть уникальным.
`add` ( *int containerId*, *int addressId*, *string type*)
*type* — допустимые значения: Bulk | Box | Area 
return 
    `true` - в случае успеха
    `false` - в случае успеха
throw 
    `RuntimeException` - если не верный *type* 
    `RuntimeException` - Контейнер `containerId` уже существует
    `RuntimeException` - Адрес `addressId` не найден в Location

### Изменить адресс контейнера
`move` ( *int containerId*, *int addressIdTo*)
return 
    `true` - в случае успеха
    `false` - в случае неудачи
throw 
    `RuntimeException` - Контейнер `containerId` не найден
    `RuntimeException` - Адрес `addressId` не найден в Location


## **Item**
### Найти Item по номеру Бирки
`findById` ( *int itemId* )
return 
    `null` - не найден
    `array` - найден

### Переместить элемент в контейнер
`move` ( *int itemId*, *int toContainerId* ) 
return 
    `true` - в случае успеха
    `false` - в случае неудачи
throw
    `RuntimeException` - Item `itemId` не найден
    `RuntimeException` - Контейнер `toContainerId` не найден

### Найти элемент по контейнер IdC
`findByContainerId` ( *int containerId* )
return 
    `null` - ничего не найдено
    `array` - найдено

### Найти элемент по IdPart
`findByPartId` ( *int partId* )
return 
    `null` - ничего не найдено
    `array` - найдено

### Найти элемент по IdCar
`findByCarId` ( *int carId* )
return 
    `null` - ничего не найдено
    `array` - найдено

### Добавить элемент
`add` ( *int id*, *int containerId*, *int partId*, *?int carId*, *?string condition*, *string conditionNote* )
return 
    `int` - номер ItemId
throw  
    `RuntimeException` - Condition type `condition` должен быть New|Good|Fair|Poor
    `RuntimeException` - Ошибка связи данных

### Удалить элемент
`delete` ( *int itemId* ) 
return   
    `true` - в случае успеха
    `false` - в случае неудачи
throw
    `RuntimeException` - Элемент `itemId` не найден
    `RuntimeException` - Ошибка связи данных

### Изменить IdPart элемента
`changePartId` (*int itemId*)
return   
    `true` - в случае успеха
    `false` - в случае неудачи
throw
    `RuntimeException` - Элемент `itemId` не найден

### Изменить Idcar элемента
`changeCarId` (*int itemId*)
return   
    `true` - в случае успеха
    `false` - в случае неудачи
throw
    `RuntimeException` - Элемент `itemId` не найден

## Изменить Condition элемента
`changeCondition` (*int itemId*)
return   
    `true` - в случае успеха
    `false` - в случае неудачи
throw
    `RuntimeException` - Элемент `itemId` не найден

## **Stock**
### Найти ассортимент по контейнеру
`findByContainerId` ( *int containerId* )
return
    `null` - не найден
    `array` - найден

### Найти ассортимент по IdPart 
`findByPartId` ( *int partId* )
return
    `null` - не найден
    `array` - найден

### Добавить ассортимент 
`add` ( *int containerId*, *int partId*, *int qty* )
return 
    `int` - номер StockId
throw 
    `RuntimeException` - Ошибка связи данных

### Обновить количество асортимента 
`updateQty` ( *int containerId*, *int partId*, *int qty*)
return 
    `true` - в случае успеха
    `false` - в случае неудачи
throw
    `RuntimeException` - Ошибка связи данных

### Добавить к количеству асортимента
`incrementQty` ( *int containerId*, *int partId*, *int qty* )
return 
    `true` - в случае успеха
    `false` - в случае неудачи
throw
    `RuntimeException` - Ошибка связи данных

### Убавить от количества асортимента
`decrementQty` ( *int containerId*, *int partId*, *int qty* )
return 
    `true` - в случае успеха
    `false` - в случае неудачи
throw
    `RuntimeException` - Ошибка связи данных

### Удалить асортимент контейнера по IdPart 
`delete` ( *int containerId*, *int partId* )
return 
    `true` - в случае успеха
    `false` - в случае неудачи
throw
    `RuntimeException` - Ошибка связи данных

## **Part**
### Найти по IdPart
`find` ( *int id* )
return 
    `null` - не найден
    `array` - найден

### Найти по Article
`findByArticle` ( *int article* )
return 
    `null` - не найден
    `array` - найден

### Добавить Part
`add` ( *string article*, *?string name*)
return 
    `int` - IdPart
throw 
    `RuntimeException` - Артикул `article` уже существует
    `RuntimeException` - Ошибка связи данных

### Найти или Добавить
`findOrCreate` ( *string article*, *?string name*)
return 
    `array` - найден

## **Car**
### Найти по IdCar
`find` ( *int id* )
return 
    `null` - не найден
    `array` - найден

### Найти по Vin
`findByVin` ( *string vin* )
return 
    `null` - не найден
    `array` - найден

### Добавить
`add` ( *string vin* )
return 
    `int` - IdPart
throw 
    `RuntimeException` - Vin уже существует

### Найти или Добавить
`findOrCreate` ( *string vin* )
return 
    `array` - найден

## **ItemPhoto**
### Найти по Id
`find` ( *int id* )
return 
    `null` - не найден
    `array` - найден

### Найти по IdItem
`findByItemId` ( *int itemId* )
return 
    `null` - не найден
    `array` - найден

### Найти по OwnerId
`findByOwnerId` ( *int ownerId* )
return 
    `null` - не найден
    `array` - найден
    
### Найти по File
`findByFile` ( *string File* )
return 
    `null` - не найден
    `array` - найден
   
### Добавить
`add` ( *int itemId*, *int ownerId*, *string file* )
return 
    `int` - Id
throw 
    `RuntimeException` - Ошибка связи данных

## **StockPhoto**
### Найти по Id
`find` ( *int id* )
return 
    `null` - не найден
    `array` - найден

### Найти по IdStock
`findByStockId` ( *int stockId* )
return 
    `null` - не найден
    `array` - найден

### Найти по OwnerId
`findByOwnerId` ( *int ownerId* )
return 
    `null` - не найден
    `array` - найден
    
### Найти по File
`findByFile` ( *string File* )
return 
    `null` - не найден
    `array` - найден
   
### Добавить
`add` ( *int stockId*, *int ownerId*, *string file* )
return 
    `int` - Id
throw 
    `RuntimeException` - Ошибка связи данных

## **CarPhoto**
### Найти по Id
`find` ( *int id* )
return 
    `null` - не найден
    `array` - найден

### Найти по CarId
`findByCarId` ( *int carId* )
return 
    `null` - не найден
    `array` - найден
    
### Найти по File
`findByFile` ( *string File* )
return 
    `null` - не найден
    `array` - найден
   
### Добавить
`add` ( *int carId*, *string file* )
return 
    `int` - Id
throw 
    `RuntimeException` - Ошибка связи данных

