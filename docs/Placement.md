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
│   └── Container
│       ├── Item
│       └── Stock
│
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

# Rack Placement
```
Rack
└── Area XOR Zone
```
---
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
Container
└── Shelf XOR Zone
```
---
```
Zone -> Container
         /\
        Shelf
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
Item
└── Shelf XOR Container

Stock
└── Shelf XOR Container
```
---
```
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