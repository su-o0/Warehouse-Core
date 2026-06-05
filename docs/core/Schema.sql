-- =========================
-- IDENTITY
-- =========================

CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,telegram_id VARCHAR(64) UNIQUE
    ,name VARCHAR(255) NOT NULL
    ,role_id TINYINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE owners (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,name VARCHAR(255) NOT NULL
    ,user_id BIGINT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE physical_tags (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,status ENUM('Free','Assigned','Lost','Broken') NOT NULL DEFAULT 'Free'
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- CATALOG
-- =========================

CREATE TABLE parts (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,article VARCHAR(128) NOT NULL UNIQUE
    ,name VARCHAR(255) NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE vehicles (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,vin VARCHAR(64) NOT NULL UNIQUE
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- INVENTORY
-- =========================

CREATE TABLE containers (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,type ENUM('Box','Pallet') NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE items (
    id BIGINT PRIMARY KEY AUTO_INCREMENT

    ,physical_tag_id BIGINT
    ,container_id BIGINT NULL
    
    ,part_id BIGINT NOT NULL
    ,vehicle_id BIGINT NULL
    ,owner_id BIGINT NOT NULL
    
    ,status ENUM('Active','Sold','Archived','Lost') NOT NULL DEFAULT 'Active'
    ,condition_level ENUM('New','Good','Fair','Poor') NOT NULL DEFAULT 'Good'
    ,condition_note TEXT NULL

    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
    ,FOREIGN KEY (physical_tag_id) REFERENCES physical_tags(id)
    ,FOREIGN KEY (container_id) REFERENCES containers(id)
    ,FOREIGN KEY (part_id) REFERENCES parts(id)
    ,FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
    ,FOREIGN KEY (owner_id) REFERENCES owners(id)

    ,INDEX idx_item_owner (owner_id)
    ,INDEX idx_item_container (container_id)
    ,INDEX idx_item_vehicle (vehicle_id)
);

CREATE TABLE stock (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    
    ,container_id BIGINT NULL
    ,part_id BIGINT NOT NULL
    ,qty INT NOT NULL DEFAULT 0
    
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
    ,FOREIGN KEY (container_id) REFERENCES containers(id)
    ,FOREIGN KEY (part_id) REFERENCES parts(id)
    
    ,INDEX idx_stock_container (container_id)
    ,INDEX idx_stock_part (part_id)
);

-- =========================
-- TOPOLOGY (PLACEMENT LAYER)
-- =========================

CREATE TABLE locations (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,address VARCHAR(255) NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE container_placements (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,location_id BIGINT NOT NULL
    ,container_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
    ,FOREIGN KEY (location_id) REFERENCES locations(id)
    ,FOREIGN KEY (container_id) REFERENCES containers(id)

    ,UNIQUE KEY uq_container_location (container_id)
);

CREATE TABLE item_placements (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,location_id BIGINT NOT NULL
    ,item_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (location_id) REFERENCES locations(id)
    ,FOREIGN KEY (item_id) REFERENCES items(id)

    ,UNIQUE KEY uq_item_location (item_id)
);

CREATE TABLE stock_placements (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,location_id BIGINT NOT NULL
    ,stock_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
    ,FOREIGN KEY (location_id) REFERENCES locations(id)
    ,FOREIGN KEY (stock_id) REFERENCES stock(id)

    ,UNIQUE KEY uq_stock_location (stock_id)
);

-- =========================
-- MEDIA
-- =========================

CREATE TABLE item_photos (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,item_id BIGINT NOT NULL
    ,file VARCHAR(512) NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
    ,FOREIGN KEY (item_id) REFERENCES items(id)
);

CREATE TABLE stock_photos (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,stock_id BIGINT NOT NULL
    ,file VARCHAR(512) NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (stock_id) REFERENCES stock(id)
);

CREATE TABLE vehicle_photos (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,vehicle_id BIGINT NOT NULL
    ,file VARCHAR(512) NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
    ,FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
);

-- =========================
-- AUDIT
-- =========================

CREATE TABLE events (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,entity_type VARCHAR(64) NOT NULL
    ,entity_id BIGINT NOT NULL
    ,action VARCHAR(64) NOT NULL
    ,payload JSON NULL
    ,owner_id BIGINT NULL
    ,user_id BIGINT NULL

    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,INDEX idx_entity (entity_type, entity_id)
    ,INDEX idx_user (user_id)
);

CREATE TABLE item_sales_archive (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,item_id BIGINT NOT NULL
    ,user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (item_id) REFERENCES items(id)
    ,FOREIGN KEY (user_id) REFERENCES users(id)
    
    ,INDEX idx_item_sales_item (item_id)
);

CREATE TABLE stock_sales_archive (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,stock_id BIGINT NOT NULL
    ,qty INT NOT NULL
    ,user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (stock_id) REFERENCES stock(id)
    ,FOREIGN KEY (user_id) REFERENCES users(id)
    
    ,INDEX idx_stock_sales_stock (stock_id)
);