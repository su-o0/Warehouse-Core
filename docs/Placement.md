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
├── Zone
│   └── Rack
│
└── Rack
```


# Rack Placement
```
Rack ->  Area
         /\
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

# Item/Stock Placement
```
Item/Stock -> Zone
                /\
              Rack
                /\
Item/Stock -> Shelf
                /\
Item/Stock -> Container
```
---
```
Area
└── Zone
    ├── Rack
    │   └── Shelf
    │       ├── Container
    │       │   ├── Item
    │       │   └── Stock
    │       │
    │       ├── Item
    │       └── Stock
    │
    └── Container
        ├── Item
        └── Stock
```