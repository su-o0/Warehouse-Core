# Architecture

# Decomposition 

```text
DomainModel 
\/
Schema
\/
Repository > Repository Api 
\/
Service > Service Api
\/
Facade > Warehouse Api
\/
Cli/Web/Telegram/Mobile
```

Warehouse Core follows a two-layer architecture:
Warehouse Core = Hybrid Inventory System, Dual inventory system:
- Serialized tracking > Item
- Bulk tracking       > Stock


```text 
Service
└── Repository
```

# Repository

Responsible for persistence and database access.
Repository layer does not contain business logic.

Responsibilities:

- SQL abstraction
- persistence
- relational integrity
- data access

# Service

Responsible for operational behavior and business rules.

Responsibilities:
- business rules
- operational API
- placement
- movement
- inventory operations
- query operations
- audit operations

Service layer orchestrates repositories and provides readable operational access to warehouse state.

# Ownership

Service API enforces operational permissions.

Roles:

#### Admin

Full system access.

Can:

- setup
- placement
- movement
- inventory operations
- query
- audit
- ownership management

#### Worker

Operational warehouse access.

Can:

- setup
- placement
- movement
- inventory operations
- query
#### Salesman

Sales-oriented access.

Can:

- query
- inventory operations