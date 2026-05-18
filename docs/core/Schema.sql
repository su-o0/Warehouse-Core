-- Owner - Пользователь 
CREATE TABLE `Owner` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`Name`           VARCHAR(32) NOT NULL
  ,`UserId`         BIGINT NULL
  ,`Permission`     ENUM('Admin','Worker','Salesman') NOT NULL DEFAULT 'Salesman'
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,PRIMARY KEY (`Id`)
  ,UNIQUE (`Name`)
  ,UNIQUE (`UserId`)
) ENGINE = InnoDB;

-- History - История операций
CREATE TABLE `History` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`Action`         VARCHAR(64) NOT NULL
  ,`EntityType`     VARCHAR(64) NOT NULL
  ,`EntityId`       INT NOT NULL
  ,`Note`           TEXT NULL
  ,`OwnerId`        INT NOT NULL
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,PRIMARY KEY (`Id`)
  ,FOREIGN KEY (`OwnerId`)         REFERENCES `Owner`(`Id`)
) ENGINE = InnoDB;

-- Location - Адресс
CREATE TABLE `Location` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`Address`        VARCHAR(32) NOT NULL
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,PRIMARY KEY (`Id`)
  ,UNIQUE (`Address`)
) ENGINE = InnoDB;

-- Container - Контейнер
CREATE TABLE `Container` (
  `Id`              INT NOT NULL
  ,`Type`           ENUM('Box','Pallet') NOT NULL
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

-- PhysicalTag - Физический идентификатор 
CREATE TABLE `PhysicalTag` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`Status`         ENUM('Free','Assigned','Lost','Broken') NOT NULL DEFAULT 'Free'
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

-- Part - Часть
CREATE TABLE `Part` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`Article`        VARCHAR(128) NOT NULL
  ,`Name`           VARCHAR(255) NULL
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,PRIMARY KEY (`Id`)
  ,UNIQUE (`Article`)
) ENGINE = InnoDB;

-- Car - Авто 
CREATE TABLE `Car` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`Vin`            CHAR(17) NOT NULL
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,PRIMARY KEY (`Id`)
  ,UNIQUE (`Vin`)
) ENGINE = InnoDB;

-- Item - Элемент
CREATE TABLE `Item` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`ContainerId`    INT NULL
  ,`PhysicalTagId`  INT NOT NULL
  ,`PartId`         INT NULL
  ,`CarId`          INT NULL
  ,`Status`         ENUM('Active','Sold','Archived','Lost') NOT NULL DEFAULT 'Active'
  ,`Condition`      ENUM('New','Good','Fair','Poor') NULL
  ,`ConditionNote`  Text NULL
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,PRIMARY KEY (`Id`)
  ,FOREIGN KEY (`ContainerId`)     REFERENCES `Container`(`Id`)
  ,FOREIGN KEY (`PhysicalTagId`)   REFERENCES `PhysicalTag`(`Id`)
  ,FOREIGN KEY (`PartId`)          REFERENCES `Part`(`Id`)
  ,FOREIGN KEY (`CarId`)           REFERENCES `Car`(`Id`)
) ENGINE = InnoDB;

-- Stock - Ассортимент
CREATE TABLE `Stock` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`ContainerId`    INT NULL
  ,`PartId`         INT NULL
  ,`Qty`            INT NOT NULL DEFAULT 1
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,PRIMARY KEY (`Id`)
  ,FOREIGN KEY (`ContainerId`)     REFERENCES `Container`(`Id`)
  ,FOREIGN KEY (`PartId`)          REFERENCES `Part`(`Id`)
) ENGINE = InnoDB;

-- Placement - Расположение Контейнера
CREATE TABLE `ContainerPlacement` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`LocationId`     INT NOT NULL
  ,`ContainerId`    INT NOT NULL
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,FOREIGN KEY (`LocationId`)      REFERENCES `Location`(`Id`)
  ,FOREIGN KEY (`ContainerId`)     REFERENCES `Container`(`Id`)
  ,UNIQUE (`ContainerId`)
  ,PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

-- Placement - Расположение Элемента
CREATE TABLE `ItemPlacement` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`LocationId`     INT NOT NULL
  ,`ItemId`         INT NOT NULL
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,FOREIGN KEY (`LocationId`)      REFERENCES `Location`(`Id`)
  ,FOREIGN KEY (`ItemId`)          REFERENCES `Item`(`Id`)
  ,UNIQUE (`ItemId`)
  ,PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

-- Placement - Расположение Асортимента
CREATE TABLE `StockPlacement` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`LocationId`     INT NOT NULL
  ,`StockId`        INT NOT NULL
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,FOREIGN KEY (`LocationId`)      REFERENCES `Location`(`Id`)
  ,FOREIGN KEY (`StockId`)         REFERENCES `Stock`(`Id`)
  ,UNIQUE (`StockId`)
  ,PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

-- SalesArchive - Архив продаж
CREATE TABLE `SalesArchive` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`ItemId`         INT NULL
  ,`StockId`        INT NULL
  ,`Qty`            INT NULL
  ,`OwnerId`        INT NOT NULL
  ,`CreatedAt`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,FOREIGN KEY (`ItemId`)          REFERENCES `Item`(`Id`)
  ,FOREIGN KEY (`StockId`)         REFERENCES `Stock`(`Id`)
  ,FOREIGN KEY (`OwnerId`)         REFERENCES `Owner`(`Id`)
  ,PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

-- ItemPhoto - Фото Элемента
CREATE TABLE `ItemPhoto` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`ItemId`         INT NOT NULL
  ,`OwnerId`        INT NOT NULL
  ,`File`           TEXT NOT NULL
  ,PRIMARY KEY (`Id`)
  ,FOREIGN KEY (`ItemId`)          REFERENCES `Item`(`Id`)
  ,FOREIGN KEY (`OwnerId`)         REFERENCES `Owner`(`Id`)
) ENGINE = InnoDB;

-- StockPhoto - Фото Ассортимента
CREATE TABLE `StockPhoto` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`StockId`        INT NOT NULL
  ,`OwnerId`        INT NOT NULL
  ,`File`           TEXT NOT NULL
  ,PRIMARY KEY (`Id`)
  ,FOREIGN KEY (`StockId`)         REFERENCES `Stock`(`Id`)
  ,FOREIGN KEY (`OwnerId`)         REFERENCES `Owner`(`Id`)
) ENGINE = InnoDB;

-- CarPhoto - Фото авто
CREATE TABLE `CarPhoto` (
  `Id`              INT NOT NULL AUTO_INCREMENT
  ,`CarId`          INT NOT NULL
  ,`OwnerId`        INT NOT NULL
  ,`File`           TEXT NOT NULL
  ,PRIMARY KEY (`Id`)
  ,FOREIGN KEY (`CarId`)           REFERENCES `Car`(`Id`)
  ,FOREIGN KEY (`OwnerId`)         REFERENCES `Owner`(`Id`)
) ENGINE = InnoDB;