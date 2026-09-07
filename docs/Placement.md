### Placement Model

```
Area
├── Zone
│   ├── Rack
│   │   └── Shelf
│   │       ├── Container
│   │       │   ├── Item
│   │       │   └── Stock
│   │       │
│   │       ├── Item
│   │       └── Stock
│   │
│   ├── Container
│   │   ├── Item
│   │   └── Stock
│   │
│   ├── Item
│   └── Stock
│
└── Rack
    └── StorageSlot
        └── Item
```


# Rack Placement
```
Rack -> Area
Rack -> Zone
```
---
```
Area
├── Zone
│   └── Rack
│
└── Rack
```
---

# Container Placement
```
Container -> Zone
Container -> Shelf
```
---
```
Area
├── Rack
│   └── Shelf
│       └── Container
│
└── Zone
    └── Container
```

# Stock Placement
```
Stock -> Zone
Stock -> Shelf
Stock -> Container
```
---
```
Area
├── Zone
│    ├── Rack
│    │   └── Shelf
│    │       ├── Container
│    │       │   ├── Item
│    │       │   └── Stock
│    │       │
│    │       ├── Item
│    │       └── Stock
│    │
│    └── Container
│        ├── Item
│        └── Stock
│
└── Rack
    └── StorageSlot
        └── Item
```

# Item Placement
```
Item -> Zone
Item -> StorageSlot
Item -> Shelf
Item -> Container
```
---
```
Area
├── Zone
│    ├── Rack
│    │   └── Shelf
│    │       ├── Container
│    │       │   ├── Item
│    │       │   └── Stock
│    │       │
│    │       ├── Item
│    │       └── Stock
│    │
│    └── Container
│        ├── Item
│        └── Stock
│
└── Rack
    └── StorageSlot
        └── Item
```