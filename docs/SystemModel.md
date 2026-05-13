# System Model 
*sync docs<>code*

**[System Decompositon]** 
*CONTRACTS* → *FLOW* → *STATE* → *RULES* → *DOMAIN MODEL* → *BOUNDARIES*

*КОНТРАКТЫ* → *ПОТОК* → *СОСТОЯНИЕ* → *ПРАВИЛА* → *МОДЕЛЬ ДОМЕНА* → *ГРАНИЦЫ*

## ENTRY POINTS
Location.Id адрес полки (бирка на стеллаже)
Container.Id: номер контейнера (бирка на коробке)
PhysicalTag.Id: номер бирки (бирка на запчасти)

Всё остальное — внутренние Id системы
## CONTRACTS 
[What system can do]
Setup 
*addAdress* - Добавить адресс 
*addConteiner* - Добавить Контейнер
*addTag* - Добавить Бирку
Fill
*addItem* - Добавить Элемент
*addBulk* - Добавить Кучу из Частей
*moveItem* - Переместить Элемент 
*moveStock* - Переместить Кучу 
*moveContainer* - Переместить Контейнер
Sell
*sellItem* - Продать Элемент 
*sellStock* - Продать Часть из Кучи
*returnItem* - Возврат Элемента
*returnStock* - Возврат Части из Кучи
Query
*find* - Найти Элемент Или Кучу 
Audit
*addUser* - Добавить Пользователя
*getActions* - История операций 
*getSells* - История продаж

## STATE
Placement.EntityType: *Container*/*Item*/*Stock*
Container.Type: *Box*/*Pallet*
PhysicalTag.Status.: *Free*/*Assigned*/*Lost*/*Broken*
Item.Status: *Active*/*Sold*/*Archived*/*Lost*
Item.Condition: *New*/*Good*/*Fair*/*Poor*
Owner.Permission: *Admin*/*Worker*/*Salesman*

## FLOW
[How information moves]
Setup
Fill
Sell
Query
Audit

## RULES
[What is allowed]
PhysicalTag, Container, Location - уникальные сущности, имеющие точку входа в реальный мир.

Placement описывает физическое расположение объектов.

Placement применяется только к физически хранимым объектам:
Container, Item, Stock.

Placement — единственный источник Location.

Container — необязательная физическая группировка объектов.

Container всегда имеет Placement.

Item/Stock имеют либо Placement, либо ContainerId.

Location Item/Stock может определяться через Container.

Item имеет PhysicalTag.

Item должен иметь минимум 1 ItemPhoto.
Stock должен иметь минимум 1 StockPhoto.
Car должен иметь минимум 1 CarPhoto.

Salesman: Query/Sell
Worker: Setup/Fill/Query/Sell
Admin: full access

## DOMAIN MODEL 
*Location* - Space - Площадь
*Placement* - Spatial binding - Расположение
*Container* - Shysical grouping - Физическая групировка 
*PhysicalTag* - identity 
*Item* - Shysical object - Обьект
*Stock* - quantity - Куча
*Part* - Каталог
*Car* - Каталог 
*ItemPhoto* - Фото Элементов
*StockPhoto* - Фото Кучи
*CarPhoto* - Фото Авто 
*SalesArhive* - Продажи
*History* - История
*Owner* - Пользователи

## BOUNDARIES
[Who is responsible for what]
*StorageApi* → entry point
*Scenario* → business logic (contracts implementation)
*Repository* → SQL abstraction

