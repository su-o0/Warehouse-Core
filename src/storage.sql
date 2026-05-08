-- Owner - Пользователь 
CREATE TABLE `Owner` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `IdUser`        BIGINT NOT NULL,
  `Permission`    ENUM('admin','worker') NOT NULL DEFAULT 'worker',
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
  `IdA`           INT NOT NULL AUTO_INCREMENT,
  `Address`       VARCHAR(32) NOT NULL,
  PRIMARY KEY (`IdA`),
  UNIQUE (`Address`)
) ENGINE = InnoDB;

-- Container - Контейнер
CREATE TABLE `Container` (
  `IdC`           INT NOT NULL,
  `IdA`           INT NOT NULL,
  `Type`          ENUM('Box','Bulk','Area') NOT NULL,
  PRIMARY KEY (`IdC`),
  FOREIGN KEY (`IdA`) REFERENCES `Location`(`IdA`)
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
  `Id`            INT NOT NULL,
  `IdC`           INT NOT NULL,
  `IdPart`        INT NULL,
  `IdCar`         INT NULL,
  `Condition`     ENUM('New', 'Good', 'Fair', 'Poor') NULL, 
  `ConditionNote` Text NULL,
  `CreatedAt`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`IdC`)    REFERENCES `Container`(`IdC`),
  FOREIGN KEY (`IdPart`) REFERENCES `Part`(`Id`),
  FOREIGN KEY (`IdCar`)  REFERENCES `Car`(`Id`)
) ENGINE = InnoDB;

-- Stock - Ассортимент
CREATE TABLE `Stock` (
  `Id`            INT NOT NULL AUTO_INCREMENT,
  `IdC`           INT NOT NULL,
  `IdPart`        INT NULL,
  `Qty`           INT NOT NULL DEFAULT 1,
  `CreatedAt`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`IdC`) REFERENCES `Container`(`IdC`),
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
  `File`          TEXT NOT NULL,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`IdCar`) REFERENCES `Car`(`Id`)
) ENGINE = InnoDB;