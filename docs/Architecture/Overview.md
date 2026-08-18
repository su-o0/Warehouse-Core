# Overview

```
                         Warehouse Core
                               │
                    ┌──────────┴──────────┐
                    │                     │
                 Domain             Infrastructure
                    │                     │
          ┌─────────┼─────────┐    ┌─────┴─────┐
          │         │         │    │           │
       Entity    Service   Rules  Connection  Journal
                    │
               Transaction
                    │
               Repository
                    │
                   SQL
```
---
# 
Warehouse Core is a domain-oriented inventory system.

The system separates:

- domain model;
- business operations;
- persistence;
- transaction orchestration;
- infrastructure;
- external interfaces.

The composition root is Bootstrap.