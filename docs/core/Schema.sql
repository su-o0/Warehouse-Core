-- =========================
-- IDENTITY
-- =========================
CREATE TABLE roles (
    id TINYINT PRIMARY KEY AUTO_INCREMENT
    ,name VARCHAR(64) NOT NULL UNIQUE
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,name VARCHAR(255) NOT NULL
    ,role_id TINYINT NOT NULL
    ,status ENUM('Created','Active','Archived') NOT NULL DEFAULT 'Created'
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE user_identities (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,user_id BIGINT NOT NULL
    ,provider ENUM('Cli', 'Telegram', 'Web') NOT NULL
    ,external_id VARCHAR(255) NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,UNIQUE KEY uq_provider_external (provider, external_id)
    ,FOREIGN KEY (user_id) REFERENCES users(id)
);      

CREATE TABLE owners (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,user_id BIGINT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE physical_tags (
    id BIGINT PRIMARY KEY
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
    id BIGINT PRIMARY KEY
    ,type ENUM('Box','Pallet') NOT NULL
    ,status ENUM('Created','Active','Crowded','Archived', 'Lost') NOT NULL DEFAULT 'Created'
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

CREATE TABLE items (
    id BIGINT PRIMARY KEY AUTO_INCREMENT

    ,physical_tag_id BIGINT NULL
    
    ,part_id BIGINT NOT NULL
    ,vehicle_id BIGINT NULL
    ,owner_id BIGINT NOT NULL
    
    ,status ENUM('Created','Tagged','Placed','Active','Sold','Archived', 'Lost') NOT NULL DEFAULT 'Created'
    ,condition ENUM('New','Good','Fair','Poor') NULL
    ,condition_note TEXT NULL

    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
    ,FOREIGN KEY (physical_tag_id) REFERENCES physical_tags(id)
    ,FOREIGN KEY (part_id) REFERENCES parts(id)
    ,FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
    ,FOREIGN KEY (owner_id) REFERENCES owners(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_item_owner (owner_id)
    ,INDEX idx_item_vehicle (vehicle_id)
);

CREATE TABLE stock (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    
    ,part_id BIGINT NOT NULL
    ,qty INT NOT NULL DEFAULT 0
    ,status ENUM('Created','Active','Crowded','Archived', 'Lost') NOT NULL DEFAULT 'Created'

    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
    ,FOREIGN KEY (part_id) REFERENCES parts(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_stock_part (part_id)
);

-- =========================
-- TOPOLOGY (PLACEMENT LAYER)
-- =========================

CREATE TABLE locations (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,address VARCHAR(255) NOT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
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
    ,location_id BIGINT NULL
    ,container_id BIGINT NULL
    ,item_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (location_id) REFERENCES locations(id)
    ,FOREIGN KEY (item_id) REFERENCES items(id)
    ,FOREIGN KEY (container_id) REFERENCES containers(id)

    ,UNIQUE KEY uq_item_location (item_id)
);

CREATE TABLE stock_placements (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,location_id BIGINT NULL
    ,container_id BIGINT NULL
    ,stock_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
    ,FOREIGN KEY (location_id) REFERENCES locations(id)
    ,FOREIGN KEY (stock_id) REFERENCES stock(id)
    ,FOREIGN KEY (container_id) REFERENCES containers(id)

    ,UNIQUE KEY uq_stock_location (stock_id)
);

-- =========================
-- MEDIA
-- =========================

CREATE TABLE item_photos (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,item_id BIGINT NOT NULL
    ,file VARCHAR(512) NOT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (item_id) REFERENCES items(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

CREATE TABLE stock_photos (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,stock_id BIGINT NOT NULL
    ,file VARCHAR(512) NOT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (stock_id) REFERENCES stock(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

CREATE TABLE vehicle_photos (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,vehicle_id BIGINT NOT NULL
    ,file VARCHAR(512) NOT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
    ,FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
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

INSERT INTO roles (name)
VALUES ('root'), ('admin'), ('worker'), ('salesman'), ('viewer');

INSERT INTO users (name, role_id, status)
VALUES ('root', 1, 'Active');

INSERT INTO user_identities (user_id, provider, external_id)
VALUES (1, 'Cli', 'admin');