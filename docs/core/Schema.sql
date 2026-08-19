-- =========================
-- IDENTITY
-- =========================
CREATE TABLE roles (
    name VARCHAR(64) PRIMARY KEY
);

CREATE TABLE providers (
    name VARCHAR(64) PRIMARY KEY
);

CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,name VARCHAR(255) NOT NULL
    ,role VARCHAR(64) NOT NULL
    ,status ENUM('Active','Archived') NOT NULL DEFAULT 'Active'
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,FOREIGN KEY (role) REFERENCES roles(name)
);

CREATE TABLE user_identities (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,user_id BIGINT NOT NULL
    ,provider VARCHAR(64) NOT NULL
    ,external_id VARCHAR(255) NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,UNIQUE KEY uq_provider_external (provider, external_id)
    ,FOREIGN KEY (user_id) REFERENCES users(id)
    ,FOREIGN KEY (provider) REFERENCES providers(name)
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
    ,status ENUM('Created','Active','Archived') NOT NULL DEFAULT 'Created'
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

CREATE TABLE part_numbers (
    part_id BIGINT NOT NULL
    ,value VARCHAR(128) NOT NULL UNIQUE
    ,is_primary BOOLEAN NOT NULL DEFAULT FALSE
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
    ,FOREIGN KEY (part_id) REFERENCES parts(id)
);

CREATE TABLE part_names (
    part_id BIGINT NOT NULL
    ,value VARCHAR(512) NOT NULL UNIQUE
    ,is_primary BOOLEAN NOT NULL DEFAULT FALSE
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (part_id) REFERENCES parts(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

CREATE TABLE vehicles (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,vin VARCHAR(64) NOT NULL UNIQUE
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

-- =========================
-- TOPOLOGY / STRUCTURE
-- (created before INVENTORY: racks/shelfs depend on it)
-- =========================

CREATE TABLE areas (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,status ENUM('Created','Active','Crowded','Archived') NOT NULL DEFAULT 'Created'
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

CREATE TABLE zones (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,area_id BIGINT NOT NULL
    ,status ENUM('Created','Active','Crowded','Archived') NOT NULL DEFAULT 'Created'
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,FOREIGN KEY (area_id) REFERENCES areas(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

-- =========================
-- IDENTITY / OWNERSHIP
-- (owners depends only on users, needed before items)
-- =========================

CREATE TABLE owners (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,user_id BIGINT NOT NULL
    ,status ENUM('Active','Archived') NOT NULL DEFAULT 'Active'
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,FOREIGN KEY (user_id) REFERENCES users(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
    ,UNIQUE KEY uq_user_id (user_id)
);

-- =========================
-- INVENTORY
-- =========================
CREATE TABLE racks (
    id BIGINT PRIMARY KEY
    ,status ENUM('Created','Active','Crowded','Archived') NOT NULL DEFAULT 'Created'
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

CREATE TABLE shelfs (
    id BIGINT PRIMARY KEY
    ,rack_id BIGINT NOT NULL
    ,status ENUM('Created','Active','Crowded','Archived') NOT NULL DEFAULT 'Created'
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (rack_id) REFERENCES racks(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

CREATE TABLE containers (
    id BIGINT PRIMARY KEY
    ,type ENUM('Box','Pallet') NOT NULL
    ,status ENUM('Created','Active','Crowded','Archived','Lost') NOT NULL DEFAULT 'Created'
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

CREATE TABLE items (
    id BIGINT PRIMARY KEY AUTO_INCREMENT

    ,physical_tag_id BIGINT NULL

    ,part_id BIGINT NULL
    ,vehicle_id BIGINT NULL
    ,owner_id BIGINT NULL

    ,status ENUM('Created','Processing','Active','Sold','Archived','Lost') NOT NULL DEFAULT 'Created'
    ,condition_level ENUM('New','Good','Fair','Poor') NULL
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

    ,part_id BIGINT NULL
    ,qty INT NOT NULL DEFAULT 0
    ,status ENUM('Created','Active','Crowded','Archived','Lost') NOT NULL DEFAULT 'Created'

    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (part_id) REFERENCES parts(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_stock_part (part_id)
);

-- =========================
-- CATALOG / NAMING
-- (depends on areas/zones/racks, created after INVENTORY)
-- =========================

CREATE TABLE area_names (
    area_id BIGINT NOT NULL
    ,value VARCHAR(255) NOT NULL
    ,is_primary BOOLEAN NOT NULL DEFAULT FALSE
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (area_id) REFERENCES areas(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

CREATE TABLE zone_names (
    zone_id BIGINT NOT NULL
    ,value VARCHAR(255) NOT NULL
    ,is_primary BOOLEAN NOT NULL DEFAULT FALSE
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

CREATE TABLE rack_names (
    rack_id BIGINT NOT NULL
    ,value VARCHAR(255) NOT NULL
    ,is_primary BOOLEAN NOT NULL DEFAULT FALSE
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (rack_id) REFERENCES racks(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

-- =========================
-- PROCESSING
-- =========================

CREATE TABLE item_processing_steps (
    item_id BIGINT NOT NULL
    ,stage ENUM('Identify','Capture','Inspection','Placement') NOT NULL
    ,metadata JSON NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (item_id) REFERENCES items(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

CREATE TABLE part_processing_steps (
    part_id BIGINT NOT NULL
    ,stage ENUM('Identify','Capture') NOT NULL
    ,metadata JSON NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (part_id) REFERENCES parts(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
);

-- =========================
-- TOPOLOGY / PLACEMENT
-- Each placement table enforces the XOR invariant:
-- every physical object has exactly one immediate owner of its position.
-- RackPlacement / ContainerPlacement: binary XOR (2 candidate owners).
-- ItemPlacement / StockPlacement: triple XOR (3 candidate owners).
-- =========================

CREATE TABLE rack_placements (
    area_id BIGINT NULL
    ,zone_id BIGINT NULL
    ,rack_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (area_id) REFERENCES areas(id)
    ,FOREIGN KEY (zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (rack_id) REFERENCES racks(id)

    ,CONSTRAINT chk_rack_placement_target_xor
        CHECK ((area_id IS NULL) != (zone_id IS NULL))

    ,UNIQUE KEY uq_rack_placement_rack (rack_id)
);

CREATE TABLE container_placements (
    zone_id BIGINT NULL
    ,shelf_id BIGINT NULL
    ,container_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (shelf_id) REFERENCES shelfs(id)
    ,FOREIGN KEY (container_id) REFERENCES containers(id)

    ,CONSTRAINT chk_container_placement_target_xor
        CHECK ((zone_id IS NULL) != (shelf_id IS NULL))

    ,UNIQUE KEY uq_container_placement_container (container_id)
);

CREATE TABLE item_placements (
    zone_id BIGINT NULL
    ,shelf_id BIGINT NULL
    ,container_id BIGINT NULL
    ,item_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (shelf_id) REFERENCES shelfs(id)
    ,FOREIGN KEY (container_id) REFERENCES containers(id)
    ,FOREIGN KEY (item_id) REFERENCES items(id)

    ,CONSTRAINT chk_item_placement_target_xor
        CHECK (
            (zone_id IS NOT NULL) + (shelf_id IS NOT NULL) + (container_id IS NOT NULL) = 1
        )

    ,UNIQUE KEY uq_item_placement_item (item_id)
);

CREATE TABLE stock_placements (
    zone_id BIGINT NULL
    ,shelf_id BIGINT NULL
    ,container_id BIGINT NULL
    ,stock_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (shelf_id) REFERENCES shelfs(id)
    ,FOREIGN KEY (container_id) REFERENCES containers(id)
    ,FOREIGN KEY (stock_id) REFERENCES stock(id)

    ,CONSTRAINT chk_stock_placement_target_xor
        CHECK (
            (zone_id IS NOT NULL) + (shelf_id IS NOT NULL) + (container_id IS NOT NULL) = 1
        )

    ,UNIQUE KEY uq_stock_placement_stock (stock_id)
);

-- =========================
-- IDENTITY / ACCESS
-- (area_access depends on users + areas, placed after Topology)
-- =========================

CREATE TABLE area_access (
    area_id BIGINT NOT NULL
    ,user_id BIGINT NOT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (area_id) REFERENCES areas(id)
    ,FOREIGN KEY (user_id) REFERENCES users(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,UNIQUE KEY uq_area_user (area_id, user_id)
);

-- =========================
-- MEDIA
-- =========================

CREATE TABLE stored_files (
    id BIGINT PRIMARY KEY AUTO_INCREMENT
    ,path VARCHAR(512) NOT NULL
    ,hash CHAR(64) NOT NULL
    ,mime_type VARCHAR(127) NOT NULL
    ,size BIGINT UNSIGNED NOT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)
    ,UNIQUE KEY uq_hash (hash)
);

CREATE TABLE part_photos (
    part_id BIGINT NOT NULL
    ,stored_file_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (part_id) REFERENCES parts(id)
    ,FOREIGN KEY (stored_file_id) REFERENCES stored_files(id)
);

CREATE TABLE item_photos (
    item_id BIGINT NOT NULL
    ,stored_file_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (item_id) REFERENCES items(id)
    ,FOREIGN KEY (stored_file_id) REFERENCES stored_files(id)
);

CREATE TABLE stock_photos (
    stock_id BIGINT NOT NULL
    ,stored_file_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (stock_id) REFERENCES stock(id)
    ,FOREIGN KEY (stored_file_id) REFERENCES stored_files(id)
);

CREATE TABLE vehicle_photos (
    vehicle_id BIGINT NOT NULL
    ,stored_file_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
    ,FOREIGN KEY (stored_file_id) REFERENCES stored_files(id)
);

CREATE TABLE part_videos (
    part_id BIGINT NOT NULL
    ,stored_file_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (part_id) REFERENCES parts(id)
    ,FOREIGN KEY (stored_file_id) REFERENCES stored_files(id)
);

CREATE TABLE item_videos (
    item_id BIGINT NOT NULL
    ,stored_file_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (item_id) REFERENCES items(id)
    ,FOREIGN KEY (stored_file_id) REFERENCES stored_files(id)
);

CREATE TABLE stock_videos (
    stock_id BIGINT NOT NULL
    ,stored_file_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (stock_id) REFERENCES stock(id)
    ,FOREIGN KEY (stored_file_id) REFERENCES stored_files(id)
);

CREATE TABLE vehicle_videos (
    vehicle_id BIGINT NOT NULL
    ,stored_file_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
    ,FOREIGN KEY (stored_file_id) REFERENCES stored_files(id)
);

-- =========================
-- AUDIT
-- =========================

CREATE TABLE journal (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,

    previous_hash CHAR(64) NULL,
    hash CHAR(64) NOT NULL,

    statement TEXT NOT NULL,
    parameters JSON NULL,
    metadata JSON NULL,

    started_at DATETIME(6) NOT NULL,
    finished_at DATETIME(6) NOT NULL,

    affected_rows INT NOT NULL DEFAULT 0,
    success BOOLEAN NOT NULL,

    exception TEXT NULL,

    transaction_id CHAR(36) NULL,

    created_at TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),

    UNIQUE KEY uq_journal_hash (hash),
    INDEX idx_journal_previous_hash (previous_hash),
    INDEX idx_journal_transaction_id (transaction_id),
    INDEX idx_journal_created_at (created_at)
);

CREATE TABLE item_sales_archive (
    item_id BIGINT NOT NULL
    ,user_id BIGINT NOT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (item_id) REFERENCES items(id)
    ,FOREIGN KEY (user_id) REFERENCES users(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_item_sales_item (item_id)
);

CREATE TABLE stock_sales_archive (
    stock_id BIGINT NOT NULL
    ,qty INT NOT NULL
    ,user_id BIGINT NOT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (stock_id) REFERENCES stock(id)
    ,FOREIGN KEY (user_id) REFERENCES users(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_stock_sales_stock (stock_id)
);

-- PlacementArchive: first-ever placement of an entity (no prior position).
CREATE TABLE rack_placement_archive (
    rack_id BIGINT NOT NULL
    ,to_area_id BIGINT NULL
    ,to_zone_id BIGINT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (rack_id) REFERENCES racks(id)
    ,FOREIGN KEY (to_area_id) REFERENCES areas(id)
    ,FOREIGN KEY (to_zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_rack_placement_archive_rack (rack_id)
);

CREATE TABLE container_placement_archive (
    container_id BIGINT NOT NULL
    ,to_zone_id BIGINT NULL
    ,to_shelf_id BIGINT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (container_id) REFERENCES containers(id)
    ,FOREIGN KEY (to_zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (to_shelf_id) REFERENCES shelfs(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_container_placement_archive_container (container_id)
);

CREATE TABLE item_placement_archive (
    item_id BIGINT NOT NULL
    ,to_zone_id BIGINT NULL
    ,to_shelf_id BIGINT NULL
    ,to_container_id BIGINT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (item_id) REFERENCES items(id)
    ,FOREIGN KEY (to_zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (to_shelf_id) REFERENCES shelfs(id)
    ,FOREIGN KEY (to_container_id) REFERENCES containers(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_item_placement_archive_item (item_id)
);

CREATE TABLE stock_placement_archive (
    stock_id BIGINT NOT NULL
    ,to_zone_id BIGINT NULL
    ,to_shelf_id BIGINT NULL
    ,to_container_id BIGINT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (stock_id) REFERENCES stock(id)
    ,FOREIGN KEY (to_zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (to_shelf_id) REFERENCES shelfs(id)
    ,FOREIGN KEY (to_container_id) REFERENCES containers(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_stock_placement_archive_stock (stock_id)
);

-- MovementArchive: a change from one known position to another.
CREATE TABLE rack_movement_archive (
    rack_id BIGINT NOT NULL
    ,from_area_id BIGINT NULL
    ,from_zone_id BIGINT NULL
    ,to_area_id BIGINT NULL
    ,to_zone_id BIGINT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (rack_id) REFERENCES racks(id)
    ,FOREIGN KEY (from_area_id) REFERENCES areas(id)
    ,FOREIGN KEY (from_zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (to_area_id) REFERENCES areas(id)
    ,FOREIGN KEY (to_zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_rack_movement_archive_rack (rack_id)
);

CREATE TABLE container_movement_archive (
    container_id BIGINT NOT NULL
    ,from_zone_id BIGINT NULL
    ,from_shelf_id BIGINT NULL
    ,to_zone_id BIGINT NULL
    ,to_shelf_id BIGINT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (container_id) REFERENCES containers(id)
    ,FOREIGN KEY (from_zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (from_shelf_id) REFERENCES shelfs(id)
    ,FOREIGN KEY (to_zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (to_shelf_id) REFERENCES shelfs(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_container_movement_archive_container (container_id)
);

CREATE TABLE item_movement_archive (
    item_id BIGINT NOT NULL
    ,from_zone_id BIGINT NULL
    ,from_shelf_id BIGINT NULL
    ,from_container_id BIGINT NULL
    ,to_zone_id BIGINT NULL
    ,to_shelf_id BIGINT NULL
    ,to_container_id BIGINT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (item_id) REFERENCES items(id)
    ,FOREIGN KEY (from_zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (from_shelf_id) REFERENCES shelfs(id)
    ,FOREIGN KEY (from_container_id) REFERENCES containers(id)
    ,FOREIGN KEY (to_zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (to_shelf_id) REFERENCES shelfs(id)
    ,FOREIGN KEY (to_container_id) REFERENCES containers(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_item_movement_archive_item (item_id)
);

CREATE TABLE stock_movement_archive (
    stock_id BIGINT NOT NULL
    ,from_zone_id BIGINT NULL
    ,from_shelf_id BIGINT NULL
    ,from_container_id BIGINT NULL
    ,to_zone_id BIGINT NULL
    ,to_shelf_id BIGINT NULL
    ,to_container_id BIGINT NULL
    ,created_by_user_id BIGINT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    ,FOREIGN KEY (stock_id) REFERENCES stock(id)
    ,FOREIGN KEY (from_zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (from_shelf_id) REFERENCES shelfs(id)
    ,FOREIGN KEY (from_container_id) REFERENCES containers(id)
    ,FOREIGN KEY (to_zone_id) REFERENCES zones(id)
    ,FOREIGN KEY (to_shelf_id) REFERENCES shelfs(id)
    ,FOREIGN KEY (to_container_id) REFERENCES containers(id)
    ,FOREIGN KEY (created_by_user_id) REFERENCES users(id)

    ,INDEX idx_stock_movement_archive_stock (stock_id)
);

INSERT INTO roles (name)
VALUES ('Root'), ('Admin'), ('Worker'), ('Salesman'), ('Viewer');

INSERT INTO providers (name)
VALUES ('Shell'), ('Web'), ('Telegram');

INSERT INTO users (name, role, status)
VALUES ('Root', 'Root', 'Active');

INSERT INTO user_identities (user_id, provider, external_id)
VALUES (1, 'Shell', 'root');