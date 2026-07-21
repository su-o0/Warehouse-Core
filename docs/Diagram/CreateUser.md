# CreatUser diagram 

```text 
Facade
    │
   \ /
ApiHandler
    │
   \ /
CreateUserApi
   ├──────────────► FindService
   │                   │
   │                   ├── Authorization
   │                   └── UserzRepository
   │
   └──────────────► UserService
                       │
                       ├── Authorization
                       └── RoleRepository