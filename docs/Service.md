# Scenario 
scenario - UseCases 

Атомарные бизнес операции 
```
SetupService
├── Setup
│   ├── addAddress -> добавляет новий адресс
│   ├── addContainer -> добавлет новий контейнер
│   ├── addPhysicalTag -> добавляет новий физический идентификатор
    ├── addOwner -> добавить пользователя 
│   ├── addCar -> добавляет новое авто
│   ├── addItem -> добавляет новый элемент
│   └── addStock -> добавляет новый асортимент 
│
├── Placement 
│   └── setPlacement -> помещает элемент/асортимент/контейнер в адресс
│
├── Movement
│   ├── move -> перемещает  элемент/асортимент из адресса на адресс 
│   ├── moveContainer -> перемещает контейнер из адресса на адресс 
│   ├── putIntoContainer -> помещяет  элемент/асортимент в контейнер по этому адресу  
│   └── removeFromContainer -> перемещает элемент/асортимент/ из контейнера на адресс 
│
├── Inventory
│   ├── incrementStockQty
│   ├── decrementStockQty
│   ├── deleteStock
│   ├── setItemCondition
│   ├── markItemSold
│   ├── archiveItem
│   └── returnItem
│
├── Query
│   ├── getAllLocation
│   ├── getAllCar
│   ├── getLocationContent
│   ├── getContainerContent
│   ├── findPhysicalTag
│   ├── findStock
│   └── findByTag
│
├── Media
│   ├── addPhoto -> добавляет фото элемента/асортимента/авто
│   └── deletePhoto -> удаляет фото элемента/асортимента/авто
│
└── Audit
    ├── setOwnerPermisition
    ├── deleteOwner
    ├── getHistory
    └── getSales
```

```
                        addOwner
                        getHistory
                        getSales
                            /\
                           Audit
                             |
     ___________________ SetupService ___________________
    /          |             |                  |         \
  Setup        |         Placement              |      Movement
    \/         |             \/                 |         \/
addAddress     |     placeContainerToLocation   |     moveContainer
addContainer   |     placeItemToLocation        |     moveItem
addPhysicalTag |     placeStockToLocation       |     moveStock
addPart        |     placeItemIntoContainer     |
addCar         |     placeStockIntoContainer    |
addItem        |                                |
addStock       |                                |
             Query                          Inventory
               \/                               \/
            getAddressContent             incrementStockQty
            getContainerContent           decrementStockQty
            findItem                      markItemSold
            findStock                     archiveItem
            findByTag                     returnItem