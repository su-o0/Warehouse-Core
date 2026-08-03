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

Service API enfo
CREATE TABLE container_movement_archive (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,container_id BIGINT NOT NULL
    ,from VARCHAR(255) NOT NULL
    ,to VARCHAR(255) NOT NULL
    ,user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (container_id) REFERENCES containers(id)
    ,FOREIGN KEY (user_id) REFERENCES users(id)
    
    ,INDEX idx_container_movement_container (container_id)
);

CREATE TABLE item_movement_archive (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,item_id BIGINT NOT NULL
    ,from VARCHAR(255) NOT NULL
    ,to VARCHAR(255) NOT NULL
    ,user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (item_id) REFERENCES items(id)
    ,FOREIGN KEY (user_id) REFERENCES users(id)
    
    ,INDEX idx_item_movement_item (item_id)
);

CREATE TABLE stock_movement_archive (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,stock_id BIGINT NOT NULL
    ,from VARCHAR(255) NOT NULL
    ,to VARCHAR(255) NOT NULL
    ,user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (stock_id) REFERENCES stock(id)
    ,FOREIGN KEY (user_id) REFERENCES users(id)
    
    ,INDEX idx_stock_movement_stock (stock_id)
);
rces operational permissions.

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