# System Model 
*sync docs<>code*
Entity Domain + Action API
**[System Decompositon]** 

*CONTRACTS* → *FLOW* → *STATE* → *RULES* → *DOMAIN MODEL* → *BOUNDARIES*

*КОНТРАКТЫ* → *ПОТОК* → *СОСТОЯНИЕ* → *ПРАВИЛА* → *МОДЕЛЬ ДОМЕНА* → *ГРАНИЦЫ*

## ENTRY POINTS
```
Rack.Id: номер стелажа (бирка на стойке стелаже)
Shelf.Id: номер полки (бирка на стойке стелаже)
Container.Id: номер контейнера (бирка на коробке)
PhysicalTag.Id: номер бирки на запчасти
```
Всё остальное - внутренние Id системы

## CONTRACTS 
[What system can do]

System Of Records

#### Setup 
*createArea* - Создать Область 
*createUser* - Создать Пользователя

#### Fill

*createZone* - Создать Зону
*addRack* - Добавить Зону
*addShelf* - Добавить Зону

*createItem* - Добавить Элемент
*createStock* - Добавить Кучу
*createConteiner* - Добавить Контейнер

*placeItem* - Поместить Элемент
*placeStock* - Поместить Кучу
*placeContainer* - Поместить Контейнер

*moveItem* - Переместить Элемент 
*moveStock* - Переместить Кучу 
*moveContainer* - Переместить Контейнер

#### Sell

*sellItem* - Продать Элемент 
*sellStock* - Продать Часть из Кучи
*returnItem* - Возврат Элемента
*returnStock* - Возврат Части из Кучи

#### Query

#### Audit
*getSells* - История продаж

## FLOW
[How information moves]
Setup
Fill
Sell
Query
Audit

## RULES
[What is allowed]

Rack, Shelf, Container, PhysicalTag - уникальные сущности, имеющие точку входа в реальный мир. 
Placement описывает физическое расположение объектов.
Placement применяется только к физически хранимым объектам.
Placement — единственный источник истини о местонахождении обьектов.
Zone, Container — необязательная физическая группировка объектов.
 всегда имеет Placement.
Item/Stock имеют Placement, ContainerId.
Item имеет PhysicalTag.
Part должен иметь минимум 1 PartPhoto.
Item должен иметь минимум 1 ItemPhoto.
Stock должен иметь минимум 1 StockPhoto.
Vehicle должен иметь минимум 1 VehiclePhoto.
Viewer: Find
Salesman: Query/Sell
Worker: Setup/Fill/Query/Sell
Admin: full access
```
## DOMAIN MODEL 
```
*Placement* - Расположение
*Container* - Физическая групировка
*PhysicalTag* - Физические идентификатор
*Item* - Уникальная запчасть
*Stock* - Идентичная запчасть
*Part* - Каталогжное определение
*Vehicle* - Каталог 
*ItemPhoto* - Фото Элементов
*StockPhoto* - Фото Кучи
*CarPhoto* - Фото Авто 
*SalesArhive* - Продажи
*History* - История
*Owner* - Пользователи
```
## BOUNDARIES
[Who is responsible for what]
```
WarehouseCore -> entry point
Repository -> SQL abstraction
Service -> business logic (contracts implementation)
```


## Telemetry — Delete guard

`Action::Delete` разрешён к выполнению только для роли `root`.
Это должно быть явной проверкой на уровне Service-слоя
(`$user->roleId === Role::Root`), а не молчаливой договорённостью —
иначе через время кто-то откроет доступ к физическому удалению
обычному admin, потому что нигде в коде это не запрещено явно.