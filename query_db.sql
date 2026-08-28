CREATE DATABASE elgolfit_db;

USE elgolfit_db;

CREATE TABLE permissions(
    id CHAR(36) PRIMARY KEY NOT NULL,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE roles(
    id CHAR(36) PRIMARY KEY NOT NULL,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE role_permissions(
    role_id CHAR(36) NOT NULL,
    permission_id CHAR(36) NOT NULL,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id)
);

CREATE TABLE users(
    id CHAR(36) PRIMARY KEY NOT NULL,
    name VARCHAR(200) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) UNIQUE,
    is_active BOOLEAN DEFAULT TRUE,

    role_id CHAR(36) NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pay_methods(
    id CHAR(36) PRIMARY KEY NOT NULL,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories_suppliers(
    id CHAR(36) PRIMARY KEY NOT NULL,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE suppliers(
    id CHAR(36) PRIMARY KEY NOT NULL,
    name VARCHAR(200) NOT NULL,
    business_name VARCHAR(200) NOT NULL,
    address VARCHAR(255) DEFAULT NULL,
    is_active BOOLEAN DEFAULT TRUE,

    delivery_day DATE,
    order_day DATE,
    
    method_payment_id CHAR(36) NOT NULL,
    FOREIGN KEY (method_payment_id) REFERENCES pay_methods(id),

    category_supplier_id CHAR(36) NOT NULL,
    FOREIGN KEY (category_supplier_id) REFERENCES categories_suppliers(id),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE contact_suppliers(
    id CHAR(36) PRIMARY KEY NOT NULL,
    name VARCHAR(200) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone_number VARCHAR(20) UNIQUE,
    is_active BOOLEAN DEFAULT TRUE,

    supplier_id CHAR(36) NOT NULL,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE units(
    id CHAR(36) PRIMARY KEY NOT NULL,
    name VARCHAR(50) NOT NULL,
    abbreviation VARCHAR(10) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE
);

CREATE TABLE areas (
    id CHAR(36) PRIMARY KEY NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE products(
    id CHAR(36) PRIMARY KEY NOT NULL,
    name VARCHAR(200) NOT NULL,
    description VARCHAR(255),
    stock_min DECIMAL(10, 3) DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,

    unit_id CHAR(36) NOT NULL,
    FOREIGN KEY (unit_id) REFERENCES units(id),

    area_id CHAR(36) NOT NULL,
    FOREIGN KEY (area_id) REFERENCES areas(id),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE product_suppliers(
    id CHAR(36) PRIMARY KEY NOT NULL,
    product_id CHAR(36) NOT NULL,
    supplier_id CHAR(36) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,

    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id),

    UNIQUE KEY unique_product_supplier (product_id, supplier_id),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE supply_orders(
    id CHAR(36) PRIMARY KEY NOT NULL,
    order_date DATE NOT NULL,

    user_id CHAR(36) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),

    status ENUM(
        'BORRADOR',
        'GENERADO',
        'ENVIADO',
        'COMPLETADO',
        'CANCELADO'
    ) NOT NULL DEFAULT 'BORRADOR',

    observations TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE supply_order_details(
    id CHAR(36) PRIMARY KEY NOT NULL,
    supply_order_id CHAR(36) NOT NULL,
    product_id CHAR(36) NOT NULL,
    quantity INT NOT NULL,
    unit_id CHAR(36) NOT NULL,

    FOREIGN KEY (supply_order_id) REFERENCES supply_orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (unit_id) REFERENCES units(id),

    UNIQUE KEY unique_supply_order_detail (supply_order_id, product_id),
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE purchase_orders(
    id CHAR(36) PRIMARY KEY NOT NULL,
    supply_order_id CHAR(36) NOT NULL,
    supplier_id CHAR(36) NOT NULL,
    order_date DATE NOT NULL,

    FOREIGN KEY (supply_order_id) REFERENCES supply_orders(id),
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id),

    status ENUM(
        'BORRADOR',
        'GENERADO',
        'ENVIADO',
        'COMPLETADO',
        'CANCELADO'
    ) NOT NULL DEFAULT 'BORRADOR',

    observations TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE purchase_order_details(
    id CHAR(36) PRIMARY KEY NOT NULL,
    purchase_order_id CHAR(36) NOT NULL,
    product_id CHAR(36) NOT NULL,
    quantity INT NOT NULL,
    unit_id CHAR(36) NOT NULL,

    FOREIGN KEY (purchase_order_id) REFERENCES purchase_orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (unit_id) REFERENCES units(id),

    UNIQUE KEY unique_purchase_order_detail (purchase_order_id, product_id),
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);