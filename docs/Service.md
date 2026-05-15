# Scenario 
scenario - UseCases 

Атомарные бизнес операции 
```
SetupService
├── Setup
│   ├── addAddress
│   ├── addContainer
│   ├── addPhysicalTag
│   ├── addCar
│   ├── addItem
│   └── addStock
│
├── Placement
│   ├── placeContainerToLocation
│   ├── placeItemIntoContainer
│   └── placeStockIntoContainer
│
├── Movement
│   ├── moveContainer
│   ├── moveItem
│   └── moveStock
│
├── Inventory
│   ├── incrementStockQty
│   ├── decrementStockQty
│   ├── markItemSold
│   ├── archiveItem
│   └── returnItem
│
├── Query
│   ├── getAllLocation
│   ├── getLocationContent
│   ├── getContainerContent
│   ├── findItem
│   ├── findStock
│   └── findByTag
│
└── Audit
    ├── addOwner
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