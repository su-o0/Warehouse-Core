### Movement Model

# Rack Movement
*From -> To*
```
Area -> Area
Area -> Zone
Zone -> Zone 
Zone -> Area
```
---

*From Area To Area*
```
Before: 

Area
└── Rack

After:

Area
└── Rack
```
---

*From Area To Zone*
```
Before: 

Area
├── Zone
│
└── Rack

After:

Area
└── Zone
    └── Rack
```
---

*From Zone To Zone*
```
Before: 

Area
├── Zone
│   └── Rack
│
└── Zone

After:

Area
├── Zone
│   
└── Zone
    └── Rack
```
---

*From Zone To Area*
```
Before: 

Area
└── Zone
    └── Rack

After:

Area
├── Zone
│
└── Rack
```
---

# Container Movement
*From -> To*
```
Zone -> Zone 
Zone -> Shelf
Shelf -> Shelf
Shelf -> Zone 
```
---

*From Zone To Zone*
```
Before: 

Area
├── Zone
│   └── Container
│
└── Zone

After:

Area
├── Zone
│   
└── Zone
    └── Container
```
---

*From Zone To Shelf*
```
Before: 

Area
├── Zone
│   └── Container
│
└── Rack
    └── Shelf

After:

Area
├── Zone
│
└── Rack
    └── Shelf
        └── Container
```
---

*From Shelf To Shelf*
```
Before: 

Area
├── Rack
│   └── Shelf
│       └── Container       
└── Rack
    └── Shelf

After:

Area
├── Rack
│   └── Shelf
│    
└── Rack
    └── Shelf
        └── Container
```
---

*From Shelf To Zone*
```
Before: 

Area
├── Zone
│
└── Rack
    └── Shelf
        └── Container

After:

Area
├── Zone
│   └── Container
│
└── Rack
    └── Shelf
```

# Stock Movement
*From -> To*
```
Zone -> Zone 
Zone -> Shelf
Zone -> Container
Shelf -> Shelf
Shelf -> Zone
Shelf -> Container
Container -> Container
Container -> Zone
Container -> Shelf
```
---

*From Zone To Zone*
```
Before:

Area
├── Zone
│   └── Stock
│
└── Zone

After:

Area
├── Zone
│
└── Zone
    └── Stock
```
---

*From Zone To Shelf*
```
Before:

Area
├── Zone
│   └── Stock
│
└── Rack
    └── Shelf

After:

Area
├── Zone
│
└── Rack
    └── Shelf
        └── Stock
```
---

*From Zone To Container*
```
Before:

Area
├── Zone
│   └── Stock
│
└── Rack
    └── Shelf

After:

Area
├── Zone
│
└── Rack
    └── Shelf
        └── Container
            └── Stock
```
---

*From Shelf To Shelf*
```
Before:

Area
├── Rack
│   └── Shelf
│       └── Stock
│
└── Rack
    └── Shelf

After:

Area
├── Rack
│   └── Shelf
│
└── Rack
    └── Shelf
        └── Stock
```
---

*From Shelf To Zone*
```
Before:

Area
├── Rack
│   └── Shelf
│       └── Stock
│
└── Zone

After:

Area
├── Rack
│   └── Shelf
│
└── Zone
    └── Stock
```
---

*From Shelf To Container*
```
Before:

Area
├── Rack
│   └── Shelf
│       └── Stock
│
└── Zone

After:

Area
├── Rack
│   └── Shelf
│
└── Zone
    └── Container
        └── Stock
```
---

*From Container To Container*
``` 
Before:

Area
├── Rack
│   └── Shelf
│       └── Container
│           └── Stock
│
└── Rack
    └── Shelf
        └── Container

After:

Area
├── Rack
│   └── Shelf
│       └── Container
│
└── Rack
    └── Shelf
        └── Container
            └── Stock
```
---

*From Container To Zone*
``` 
Before:

Area
├── Rack
│   └── Shelf
│       └── Container
│           └── Stock
│
└── Zone

After:

Area
├── Rack
│   └── Shelf
│       └── Container
│
└── Zone
    └── Stock
```
---

*From Container To Shelf*
``` 
Before:

Area
└── Rack
    └── Shelf
        └── Container
            └── Stock
After:

Area
└── Rack
    └── Shelf
        ├── Container
        └── Stock
```

# Item Movement
*From -> To*
```
Zone -> Zone 
Zone -> Shelf
Zone -> StorageSlot
Zone -> Container
Shelf -> Shelf
Shelf -> Zone
Shelf -> StorageSlot
Shelf -> Container
Container -> Container
Container -> Zone
Container -> StorageSlot
Container -> Shelf
StorageSlot -> StorageSlot
StorageSlot -> Zone
StorageSlot -> Shelf
StorageSlot -> Container
```
---

*From Zone To Zone*
```
Before:

Area
├── Zone
│   └── Item
│
└── Zone

After:

Area
├── Zone
│
└── Zone
    └── Item
```
---

*From Zone To Shelf*
```
Before:

Area
├── Zone
│   └── Item
│
└── Rack
    └── Shelf

After:

Area
├── Zone
│
└── Rack
    └── Shelf
        └── Item
```
---

*From Zone To StorageSlot*
```
Before:

Area
├── Zone
│   └── Item
│
└── Rack
    └── StorageSlot

After:

Area
├── Zone
│
└── Rack
    └── StorageSlot
        └── Item
```
---

*From Zone To Container*
```
Before:

Area
├── Zone
│   └── Item
│
└── Rack
    └── Shelf

After:

Area
├── Zone
│
└── Rack
    └── Shelf
        └── Container
            └── Item
```
---

*From Shelf To Shelf*
```
Before:

Area
├── Rack
│   └── Shelf
│       └── Item
│
└── Rack
    └── Shelf

After:

Area
├── Rack
│   └── Shelf
│
└── Rack
    └── Shelf
        └── Item
```
---

*From Shelf To Zone*
```
Before:

Area
├── Rack
│   └── Shelf
│       └── Item
│
└── Zone

After:

Area
├── Rack
│   └── Shelf
│
└── Zone
    └── Item
```
---

*From Shelf To StorageSlot*
```
Before:

Area
├── Rack
│   └── Shelf
│       └── Item
│
└── Rack
    └── StorageSlot

After:

Area
├── Rack
│   └── Shelf
│
└── Rack
    └── StorageSlot
        └── Item
```
---

*From Shelf To Container*
```
Before:

Area
├── Rack
│   └── Shelf
│       └── Item
│
└── Zone

After:

Area
├── Rack
│   └── Shelf
│
└── Zone
    └── Container
        └── Item
```
---

*From Container To Container*
``` 
Before:

Area
├── Rack
│   └── Shelf
│       └── Container
│           └── Item
│
└── Rack
    └── Shelf
        └── Container

After:

Area
├── Rack
│   └── Shelf
│       └── Container
│
└── Rack
    └── Shelf
        └── Container
            └── Item
```
---

*From Container To Zone*
``` 
Before:

Area
├── Rack
│   └── Shelf
│       └── Container
│           └── Item
│
└── Zone

After:

Area
├── Rack
│   └── Shelf
│       └── Container
│
└── Zone
    └── Item
```
---

*From Container To StorageSlot*
``` 
Before:

Area
├── Rack
│   └── Shelf
│       └── Container
│           └── Item
│
└── Rack
    └── StorageSlot

After:

Area
├── Rack
│   └── Shelf
│       └── Container
│
└── Rack
    └── StorageSlot
        └── Item
```
---

*From Container To Shelf*
``` 
Before:

Area
└── Rack
    └── Shelf
        └── Container
            └── Item
After:

Area
└── Rack
    └── Shelf
        ├── Container
        └── Item
```

*From StorageSlot To StorageSlot*
``` 
Before:

Area
├── Rack
│   └── StorageSlot
│       └── Item
│
└── Rack
    └── StorageSlot

After:

Area
├── Rack
│   └── StorageSlot
│
└── Rack
    └── StorageSlot
        └── Item
```

*From StorageSlot To Zone*
``` 
Before:

Area
├── Rack
│   └── StorageSlot
│       └── Item
│
└── Zone

After:

Area
├── Rack
│   └── StorageSlot
│
└── Zone
    └── Item
```

*From StorageSlot To Shelf*
``` 
Before:

Area
├── Rack
│   └── StorageSlot
│       └── Item
│
└── Rack
    └── Shelf

After:

Area
├── Rack
│   └── StorageSlot
│
└── Rack
    └── Shelf
        └── Item
```

*From StorageSlot To Container*
``` 
Before:

Area
├── Rack
│   └── StorageSlot
│       └── Item
│
└── Rack
    └── Shelf
        └── Container

After:

Area
├── Rack
│   └── StorageSlot
│
└── Rack
    └── Shelf
        └── Container
            └── Item
```