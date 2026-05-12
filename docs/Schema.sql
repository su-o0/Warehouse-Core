-- Owner - Пользователь 
CREATE TABLE `Owner` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `IdUser`        BIGINT NOT NULL,
  `Permission`    ENUM('Admin','Worker','Salesman') NOT NULL DEFAULT 'Worker',
  `Name`          VARCHAR(255) NOT NULL,
  `CreatedAt`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE (`IdUser`)
) ENGINE = InnoDB;

-- SalesArchive - Архив продаж
CREATE TABLE `SalesArchive` (
  `Id`  INT NOT NULL AUTO_INCREMENT,
  `IdItem`        INT NULL,
  `IdStock`       INT NULL,
  `Qty`           INT NULL,
  `Price`         DECIMAL(10,2) NULL,
  `SaleOwner`     INT NOT NULL,
  `CreatedAt`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

-- History - История операций
CREATE TABLE `History` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `Action`        VARCHAR(64) NOT NULL,
  `Note`          TEXT NULL,
  `ActionOwner`   INT NOT NULL,
  `EntityType`    VARCHAR(64) NOT NULL,
  `EntityId`      INT NOT NULL,
  `CreatedAt`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`ActionOwner`) REFERENCES `Owner`(`Id`)
) ENGINE = InnoDB;

-- Location - Адресс
CREATE TABLE `Location` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `Address`       VARCHAR(32) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE (`Address`)
) ENGINE = InnoDB;

-- Placement - Расположение 
CREATE TABLE `Placement` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `IdLocation`    INT NOT NULL,
  `EntityType`    ENUM('Container','Item','Stock') NOT NULL,
  `EntityId`      INT NOT NULL,
  `CreatedAt`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`IdLocation`)  REFERENCES `Location`(`Id`)
) ENGINE = InnoDB;

-- Container - Контейнер
CREATE TABLE `Container` (
  `Id`            INT NOT NULL,
  `Type`          ENUM('Box','Pallet') NOT NULL,
  `CreatedAt`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

-- PhysicalTag - Физический идентификатор 
CREATE TABLE `PhysicalTag` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `Status`        ENUM('Free','Assigned','Lost','Broken') NOT NULL DEFAULT 'Free',
  `CreatedAt`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

-- Part - Часть
CREATE TABLE `Part` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `Article`       VARCHAR(128) NOT NULL,
  `Name`          VARCHAR(255) NULL,
  `CreatedAt`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE (`Article`)
) ENGINE = InnoDB;

-- Car - Авто 
CREATE TABLE `Car` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `Vin`           CHAR(17) NOT NULL,
  `CreatedAt`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE (`Vin`)
) ENGINE = InnoDB;

-- Item - Элемент
CREATE TABLE `Item` (
  `Id`            INT NOT NULL AUTO_INCREMENT, 
  `IdPhysicalTag` INT NOT NULL,
  `IdPart`        INT NULL,
  `IdCar`         INT NULL,
  `Status`        ENUM('Active','Sold','Archived','Lost') NOT NULL DEFAULT 'Active', 
  `Condition`     ENUM('New','Good','Fair','Poor') NULL, 
  `ConditionNote` Text NULL,
  `CreatedAt`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`IdPhysicalTag`)  REFERENCES `PhysicalTag`(`Id`),
  FOREIGN KEY (`IdPart`) REFERENCES `Part`(`Id`),
  FOREIGN KEY (`IdCar`)  REFERENCES `Car`(`Id`)
) ENGINE = InnoDB;

-- Stock - Ассортимент
CREATE TABLE `Stock` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `IdPart`        INT NULL,
  `Qty`           INT NOT NULL DEFAULT 1,
  `CreatedAt`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`), 
  FOREIGN KEY (`IdPart`) REFERENCES `Part`(`Id`)
) ENGINE = InnoDB;

-- ItemPhoto - Фото Элемента
CREATE TABLE `ItemPhoto` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `IdItem`        INT NOT NULL,
  `IdOwner`       INT NOT NULL,
  `File`          TEXT NOT NULL,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`IdItem`) REFERENCES `Item`(`Id`),
  FOREIGN KEY (`IdOwner`) REFERENCES `Owner`(`Id`)
) ENGINE = InnoDB;

-- StockPhoto - Фото Ассортимента
CREATE TABLE `StockPhoto` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `IdStock`       INT NOT NULL,
  `IdOwner`       INT NOT NULL,
  `File`          TEXT NOT NULL,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`IdStock`) REFERENCES `Stock`(`Id`),
  FOREIGN KEY (`IdOwner`) REFERENCES `Owner`(`Id`)
) ENGINE = InnoDB;

-- CarPhoto - Фото авто
CREATE TABLE `CarPhoto` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `IdCar`         INT NOT NULL,
  `IdOwner`       INT NOT NULL,
  `File`          TEXT NOT NULL,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`IdCar`) REFERENCES `Car`(`Id`),
  FOREIGN KEY (`IdOwner`) REFERENCES `Owner`(`Id`)
) ENGINE = InnoDB;