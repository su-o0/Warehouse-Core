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
PhysicalTag: *Free*/*Assigned*/*Lost*/*Broken*
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
PhysicalTag, Container Location уникальные сущности, имеют точку входа в реальный мир
Placement описивает расположение Container, Item, Stock
Placement только физически хранимые объекты.
Placement это ЕДИНСТВЕННЫЙ способ пространственного соединения
Container, Item, Stock обязательно располагаются в одном Location 
Container это необязательная физическая группировка
PhysicalTag может быть только в одном Placement
Item может быть только в одном контейнере 
Каждый Item имеет PhysicalTag
Item должен иметь 1 ItemPhoto 
Stock должен иметь 1 StockPhoto 
Car должен иметь 1 CarPhoto 

Salesman может: Query/Sell
Worker может: Setup/Fill/Query/Sell/
Admin может: всё

## DOMAIN MODEL 
*Location* - Space - Площадь
*Placement* - Ыpatial binding - Расположение
*Container* - Ыhysical grouping - Физическая групировка 
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

