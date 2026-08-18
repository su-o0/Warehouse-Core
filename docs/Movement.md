### Movement Model

# Rack Movement
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

# Item/Stock Movement
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
│   ├── Item
│   └── Stock
│
└── Zone

After:

Area
├── Zone
│
└── Zone
    ├── Item
    └── Stock
```
---

*From Zone To Shelf*
```
Before:

Area
├── Zone
│   ├── Item
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
        ├── Item
        └── Stock
```
---

*From Zone To Container*
```
Before:

Area
├── Zone
│   ├── Item
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
            ├── Item
            └── Stock
```
---

*From Shelf To Shelf*
```
Before:

Area
├── Rack
│   └── Shelf
│       ├── Item
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
        ├── Item
        └── Stock
```
---

*From Shelf To Zone*
```
Before:

Area
├── Rack
│   └── Shelf
│       ├── Item
│       └── Stock
│
└── Zone

After:

Area
├── Rack
│   └── Shelf
│
└── Zone
    ├── Item
    └── Stock
```
---

*From Shelf To Container*
```
Before:

Area
├── Rack
│   └── Shelf
│       ├── Item
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
        ├── Item
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
│           ├── Item
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
│           ├── Item
│           └── Stock
│
└── Rack
    └── Shelf
        └── Container
            ├── Item
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
│           ├── Item
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
│           ├── Item
│           └── Stock
│
└── Zone
    ├── Item
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
            ├── Item
            └── Stock
After:

Area
└── Rack
    └── Shelf
        ├── Item
        └── Stock
```