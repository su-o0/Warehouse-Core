# Architecture Diagram

```mermaid
graph TD
  subgraph Config
    config[Config files (api, service, repository, database)]
  end

  subgraph Infra
    conn[Connection::get()\n(PDO)]
    db[(MySQL)]
  end

  subgraph RepositoryLayer
    repoRegistry[RepositoryRegistry]
    repoClasses[Repositories\n(Item, Stock, Container, User, ...)]
  end

  subgraph ServiceLayer
    serviceRegistry[ServiceRegistry]
    serviceClasses[Services\n(ItemService, StockService, PlacementService, ...)]
    auth[Authorization]
    context[ServiceContext\n(Session + Authorization + ServiceRegistry)]
  end

  subgraph ApiFacade
    apiRegistry[ApiRegistry]
    apiHandler[ApiHandler]
    facade[ShellFacade / Facades / Output]
  end

  subgraph External
    shell[Shell/Web/JSON clients]
  end

  config --> conn
  conn --> db
  conn --> repoRegistry
  config --> repoRegistry
  repoRegistry --> repoClasses
  repoClasses -- used by --> serviceClasses
  serviceRegistry --> serviceClasses
  repoRegistry --> serviceRegistry
  config --> serviceRegistry
  serviceRegistry --> context
  context --> apiRegistry
  apiRegistry --> apiHandler
  apiHandler --> facade
  facade --> shell
  shell --> apiHandler
  style db fill:#ffeebb,stroke:#333
  style repoRegistry fill:#e0f7fa,stroke:#00796b
  style serviceRegistry fill:#e8f5e9,stroke:#2e7d32
  style apiHandler fill:#fff3e0,stroke:#ef6c00
```