# Architecture Overview

This document provides a high-level overview of the Warehouse Core architecture, project structure, architectural boundaries, and major runtime flows.

It is intended as the primary entry point for understanding the codebase before modifying or extending it.

---

# 1. Project Structure

```text
[Warehouse Core]/
├── config/                         # Runtime configuration
│
├── docs/                           # Project documentation
│   ├── API/                        # API contracts
│   ├── Architecture/               # Architecture documentation
│   ├── core/                       # Core database schema
│   ├── Domain/                     # Domain model, rules, problems and maps
│   └── img/                        # Documentation assets
│
├── src/
│   ├── Api/                        # External API entry points
│   ├── Bootstrap/                  # Composition root and application assembly
│   ├── Config/                     # Typed configuration objects and configuration loading
│   ├── Connection/                 # Database connection and statement instrumentation
│   ├── Context/                    # Runtime service context
│   ├── Contract/                   # Architectural contracts and base abstractions
│   ├── Exception/                 # Domain, repository, service and infrastructure exceptions
│   ├── Facade/                     # High-level application facade
│   ├── Output/                     # Output abstraction and runtime renderers
│   ├── Payload/                    # Data crossing architectural boundaries
│   │   ├── Entity/                 # Transport / persistence-facing entities
│   │   ├── Map/                    # Type and payload mapping
│   │   ├── Request/                 # API request DTOs
│   │   ├── Result/                  # Service/API result DTOs
│   │   ├── Type/                    # Enumerated domain-facing types
│   │   └── Value/                   # Value objects
│   ├── Registry/                   # Dependency and component registries
│   ├── Repository/                 # Persistence and SQL access
│   ├── Security/                   # Authentication and authorization support
│   └── Service/                    # Business and operational services
│
└── test/                           # Automated tests
```

## Architectural responsibility by directory

| Directory         | Responsibility                                                        |
| ----------------- | --------------------------------------------------------------------- |
| `config/`         | Application configuration files                                       |
| `docs/`           | Architectural, domain and API documentation                           |
| `src/Api/`        | API operations exposed to callers                                     |
| `src/Bootstrap/`  | Composition root; assembles application dependencies                  |
| `src/Config/`     | Configuration loading and typed configuration                         |
| `src/Connection/` | PDO creation, connection management and SQL statement instrumentation |
| `src/Context/`    | Runtime context passed through service execution                      |
| `src/Contract/`   | Shared architectural abstractions                                     |
| `src/Exception/`  | Application exception hierarchy and infrastructure mapping            |
| `src/Facade/`     | High-level entry point to Warehouse Core operations                   |
| `src/Output/`     | Rendering and output dispatch                                         |
| `src/Payload/`    | Data transfer structures crossing architectural boundaries            |
| `src/Registry/`   | Centralized component registries                                      |
| `src/Repository/` | Persistence and database interaction                                  |
| `src/Security/`   | Authorization and security policy                                     |
| `src/Service/`    | Business operations and orchestration                                 |
| `test/`           | Repository, schema and service tests                                  |

---

# 2. Architectural Layers

Warehouse Core separates the domain model from persistence, business operations and external interfaces.

```text
Domain Model
     │
     ▼
Schema
     │
     ▼
Repository
     │
     ▼
Service
     │
     ▼
Facade
     │
     ▼
API / Runtime
```

The principal runtime dependency direction is:

```text
API
 │
 ▼
Facade
 │
 ▼
Service
 │
 ├──► Repository
 │
 └──► Transaction
        │
        ▼
      Connection
        │
        ▼
       PDO
        │
        ▼
     MySQL
```

The domain model and schema define what the system represents.

Repositories define how persistent state is accessed.

Services define what operations can be performed and enforce business rules.

The facade provides a high-level application entry point.

APIs adapt external requests to application operations.

---

# 3. Core Architectural Components

## 3.1 Bootstrap

**Location:** `src/Bootstrap/`

`Bootstrap` is the composition root of Warehouse Core.

It is responsible for assembling application dependencies rather than implementing business behavior.

```text
Bootstrap
├── Config
├── Connection
├── RepositoryRegistry
├── AuthenticationService
├── ServiceRegistry
├── ServiceContext
└── ApiRegistry
```

The application is constructed through dependency injection.

---

## 3.2 Connection

**Location:** `src/Connection/`

`Connection` owns database connection creation.

Warehouse Core uses:

```text
Connection
├── Main PDO
│   └── Statement
│
└── Journal PDO
    └── JournalRepository
```

The main PDO is configured with the custom `Statement` class.

The Journal uses a separate PDO connection so that SQL execution can be recorded without recursively journaling the Journal write itself.

---

## 3.3 Repository

**Location:** `src/Repository/`

Repositories are responsible for persistence and SQL interaction.

Repositories do not contain business rules.

Their responsibilities include:

* SQL execution;
* querying persistent state;
* inserting records;
* updating records;
* deleting records;
* mapping database rows to entities;
* relational persistence;
* explicit database access operations.

The common repository infrastructure is provided by:

```text
src/Contract/Repository.php
```

Domain-specific repositories extend this infrastructure.

Example:

```text
ItemRepository
├── find...
├── getId...
├── add...
├── update...
└── delete...
```

The Repository layer provides readable persistence operations while keeping SQL implementation details inside the repository boundary.

---

## 3.4 Transaction

**Location:** `src/Contract/Transaction.php`

Transaction management is separated from the individual Repository.

A business operation may require multiple repositories:

```text
ItemService
 ├── ItemRepository
 └── ItemProcessingStepRepository
```

Therefore transaction boundaries belong to the operation that coordinates multiple persistence operations rather than to an individual repository.

Transaction infrastructure provides:

```text
Transaction
├── transaction()
├── beginTransaction()
├── commit()
└── rollback()
```

---

## 3.5 Transaction Registry

**Location:** `src/Registry/TransactionRegistry.php`

`TransactionRegistry` is intended to provide a centralized definition and orchestration point for business transaction operations.

Its purpose is to prevent transaction workflows from being distributed arbitrarily across individual services and repositories.

Conceptually:

```text
Service
   │
   ▼
TransactionRegistry
   │
   ├── Repository A
   ├── Repository B
   └── Repository C
```

The registry defines the persistence workflow required by a business operation and provides a consistent transaction boundary.

---

## 3.6 Service

**Location:** `src/Service/`

Services represent operational behavior of Warehouse Core.

Responsibilities include:

* business rules;
* operational workflows;
* inventory operations;
* placement;
* movement;
* querying;
* ownership;
* processing;
* audit-related operations.

Services orchestrate repositories rather than performing SQL directly.

```text
Service
├── RepositoryRegistry
└── TransactionRegistry
```

---

## 3.7 Repository Registry

**Location:** `src/Registry/RepositoryRegistry.php`

`RepositoryRegistry` provides centralized access to repository instances.

Conceptually:

```text
RepositoryRegistry
├── Topology
├── Inventory
├── Processing
├── Catalog
├── Media
├── Identity
└── Audit
```

Repositories share the application's database connection infrastructure while remaining separated by persistence responsibility.

---

## 3.8 Payload

**Location:** `src/Payload/`

`Payload` contains structures used to move typed data across application boundaries.

```text
Payload
├── Entity
├── Map
├── Request
├── Result
├── Type
└── Value
```

### Entity

Represents structured data returned from or passed between architectural components.

### Request

Represents validated input to API operations.

### Result

Represents service/API operation results.

### Type

Contains strongly typed enumerations and categorical values.

### Value

Contains value objects representing domain values.

### Map

Contains conversion logic between external and internal representations.

---

# 4. Domain Organization

Warehouse Core is organized around the physical reality of a warehouse.

The domain is divided into major areas:

```text
Topology
├── Area
├── Zone
├── RackPlacement
├── ContainerPlacement
├── ItemPlacement
└── StockPlacement

Inventory
├── Rack
├── Shelf
├── Container
├── Item
├── Stock
└── PhysicalTag

Processing
├── ItemProcessingStep
└── PartProcessingStep

Catalog
├── AreaName
├── ZoneName
├── RackName
├── Part
├── PartNumber
├── PartName
└── Vehicle

Media
├── PartPhoto
├── ItemPhoto
├── StockPhoto
├── VehiclePhoto
├── PartVideo
├── ItemVideo
├── StockVideo
├── VehicleVideo
└── StoredFile

Identity
├── Role
├── Provider
├── User
├── UserIdentity
├── Owner
└── AreaAccess

Audit
├── Placement Archives
├── Movement Archives
├── Sales Archives
└── Journal
```

The detailed domain model is documented separately in:

```text
docs/Domain/
```

---

# 5. Inventory Model

Warehouse Core uses a dual inventory model.

```text
Inventory
├── Item
└── Stock
```

### Item

Serialized inventory.

Each physical item represents an individually identifiable physical object.

```text
Item
├── PhysicalTag
├── Part
├── Vehicle
└── Owner
```

### Stock

Bulk inventory.

Stock represents a quantity of equivalent inventory:

```text
Stock
├── Part
└── Qty
```

This distinction allows the system to model both individually tracked physical parts and quantity-based inventory.

---

# 6. Placement Model

Physical placement is represented through topology relationships rather than a denormalized textual address.

Conceptually:

```text
Area
└── Zone
    └── Rack
        └── Shelf
            └── Container
                ├── Item
                └── Stock
```

Objects may also exist directly at valid higher-level locations.

The placement model is described in:

```text
docs/Domain/Map.md
docs/Placement.md
```

The system derives a physical address from topology relationships instead of storing the complete address directly on the object.

---

# 7. Movement Model

Movement represents a change in physical placement.

The supported movement relationships are defined by the domain rather than by arbitrary coordinate changes.

```text
Rack
├── Area → Area
├── Area → Zone
├── Zone  → Zone
└── Zone  → Area

Container
├── Zone  → Zone
├── Zone  → Shelf
├── Shelf → Shelf
└── Shelf → Zone

Item / Stock
├── Zone      → Zone
├── Zone      → Shelf
├── Zone      → Container
├── Shelf     → Shelf
├── Shelf     → Zone
├── Shelf     → Container
├── Container → Container
├── Container → Zone
└── Container → Shelf
```

Movement rules and physical state transitions are documented separately.

---

# 8. Audit and Journal

Warehouse Core distinguishes between domain history and SQL execution history.

## Domain audit

Archives represent business history:

```text
PlacementArchive
MovementArchive
SalesArchive
```

They answer questions such as:

* where an object was;
* where it moved from;
* where it moved to;
* who performed an operation;
* when the operation occurred;
* what was sold.

## Journal

`Journal` records database statement execution.

```text
Journal
├── Id
├── PreviousHash
├── Hash
├── Statement
├── Parameters
├── Metadata
├── StartedAt
├── FinishedAt
├── AffectedRows
├── Success
├── Exception
├── TransactionId
└── CreatedAt
```

Journal records form a hash-linked sequence.

The Journal is written through a separate database connection to avoid recursive statement journaling.

---

# 9. Security

Security is divided into authentication and authorization concerns.

```text
Authentication
├── User
├── UserIdentity
└── Provider

Authorization
├── Role
└── AreaAccess
```

The service layer performs operational authorization according to the current `ServiceContext`.

---

# 10. Runtime Flow

A typical application operation follows this direction:

```text
External Runtime
      │
      ▼
ApiHandler
      │
      ▼
ApiRegistry
      │
      ▼
API Operation
      │
      ▼
ShellFacade
      │
      ▼
Service
      │
      ├──────────────► Repository
      │
      └──────────────► TransactionRegistry
                              │
                              ▼
                         Repository(s)
                              │
                              ▼
                           Connection
                              │
                              ▼
                             PDO
                              │
                              ▼
                            MySQL
```

Authentication establishes the execution context:

```text
ShellFacade
      │
      ▼
AuthenticationService
      │
      ▼
Session
      │
      ▼
ServiceContext
      ├── Session
      ├── Authorization
      └── ServiceRegistry
```

---

# 11. Documentation Structure

The `docs/` directory is organized by purpose.

```text
docs/
├── API/
│   ├── CliApi.md
│   ├── RepositoryAPI.md
│   └── ServiceApi.md
│
├── Architecture/
│   └── Overview.md
│
├── Domain/
│   ├── Core.md
│   ├── Map.md
│   ├── Model.md
│   ├── Problems.md
│   ├── Rules.md
│   └── Schema.md
│
├── core/
│   └── Schema.sql
│
├── Diagram/
│   └── CreateUser.md
│
├── README.md
├── Architecture.md
├── DomainMap.md
├── DomainModel.md
├── DomainRules.md
├── ItemLifycycle.md
├── KnowledgeBase.md
├── Methods.md
├── Movement.md
├── Placement.md
├── Schema.md
├── Service.md
└── SystemModel.md
```

Documentation should describe **stable architectural concepts**, while implementation-specific details should remain close to the corresponding code and API documentation.

---

# 12. Architectural Principles

Warehouse Core follows several core principles.

### Separation of concerns

Each architectural layer has a defined responsibility.

### Dependency injection

Application dependencies are assembled in the composition root.

### Repository isolation

Repositories contain persistence logic and do not define business behavior.

### Service orchestration

Services coordinate business operations across repositories.

### Explicit transaction boundaries

Transactions encompass complete business operations rather than individual SQL statements.

### Physical state consistency

The system must not allow an object to have multiple physically contradictory placements.

### Derived physical addresses

Warehouse addresses are derived from topology relationships rather than duplicated as persistent strings.

### Dual inventory tracking

`Item` provides serialized tracking while `Stock` provides bulk quantity tracking.

### Auditable operations

Physical and database operations are recorded through domain archives and Journal respectively.

---

# 13. Technology

| Component             | Technology                                                  |
| --------------------- | ----------------------------------------------------------- |
| Language              | PHP 8.5                                                     |
| Database              | MySQL 8.0                                                   |
| Persistence           | PDO                                                         |
| Dependency management | Composer                                                    |
| Architecture          | Layered / domain-oriented monolith                          |
| Database audit        | Journal                                                     |
| Testing               | Repository integration, schema drift and service unit tests |

---

# 14. Testing

The project contains three primary testing directions:

```text
test/
├── Repository integration test
├── Schema drift test
└── Service unit test
```

Repository integration tests verify persistence behavior.

Schema drift tests verify consistency between the documented/database schema and implementation.

Service unit tests verify business behavior independently from infrastructure where possible.

---

# 15. Architectural Evolution

This document is a living architectural reference.

When introducing a new architectural component, update this document if the change affects:

* dependency direction;
* layer responsibility;
* transaction boundaries;
* persistence architecture;
* domain organization;
* runtime flow;
* project structure.

Detailed implementation documentation should remain in the appropriate specialized document rather than duplicating implementation details here.
