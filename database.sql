-- database.sql
-- MySQL database schema for PUBG UC Store
-- Updated with User Authentication

-- Create database
CREATE DATABASE IF NOT EXISTS pubg_uc_store;
USE pubg_uc_store;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS users;
DROP VIEW IF EXISTS order_statistics;
DROP VIEW IF EXISTS top_packages;
DROP VIEW IF EXISTS customer_lifetime_value;
SET FOREIGN_KEY_CHECKS = 1;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    country_code VARCHAR(10) NOT NULL,
    mobile_number VARCHAR(20) UNIQUE NOT NULL,
    region VARCHAR(100) NOT NULL,
    district VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_mobile (mobile_number)
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id VARCHAR(50) UNIQUE NOT NULL,
    user_id INT,
    player_id VARCHAR(100) NOT NULL,
    package_uc INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    email VARCHAR(255) NOT NULL,
    status ENUM('pending', 'processing', 'completed', 'failed', 'refunded') DEFAULT 'pending',
    payment_method VARCHAR(50),
    transaction_id VARCHAR(100),
    order_date DATETIME NOT NULL,
    delivery_date DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_order_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_order_id (order_id),
    INDEX idx_user_id (user_id),
    INDEX idx_player_id (player_id),
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_order_date (order_date)
);

-- Packages table
CREATE TABLE IF NOT EXISTS packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    uc_amount INT NOT NULL,
    bonus_uc INT DEFAULT 0,
    price DECIMAL(10, 2) NOT NULL,
    discount_percentage INT DEFAULT 0,
    is_popular BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert default packages
INSERT INTO packages (name, uc_amount, bonus_uc, price, discount_percentage, is_popular, is_active) VALUES
('Starter', 60, 0, 1.10, 0, FALSE, TRUE),
('Basic', 120, 0, 2.20, 0, FALSE, TRUE),
('Standard', 180, 0, 3.25, 0, FALSE, TRUE),
('Bronze', 325, 0, 4.90, 0, FALSE, TRUE),
('Silver', 385, 0, 5.90, 0, FALSE, TRUE),
('Popular', 660, 0, 9.75, 0, TRUE, TRUE),
('Gold', 720, 0, 10.75, 0, FALSE, TRUE),
('Platinum', 985, 0, 14.50, 0, FALSE, TRUE),
('Diamond', 1320, 0, 19.40, 0, FALSE, TRUE),
('Premium', 1800, 0, 23.90, 0, FALSE, TRUE),
('Elite', 3850, 0, 46.90, 0, FALSE, TRUE),
('Royal', 8100, 0, 92.90, 0, FALSE, TRUE);

-- Customers table (Legacy, can be merged with users later if needed)
CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    player_id VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(255) NOT NULL,
    total_orders INT DEFAULT 0,
    total_spent DECIMAL(10, 2) DEFAULT 0.00,
    first_order_date DATETIME,
    last_order_date DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_player_id (player_id),
    INDEX idx_email (email)
);

-- Transactions table
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id VARCHAR(50) NOT NULL,
    transaction_id VARCHAR(100) UNIQUE NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    status ENUM('pending', 'success', 'failed', 'refunded') DEFAULT 'pending',
    gateway_response TEXT,
    transaction_date DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    INDEX idx_transaction_id (transaction_id),
    INDEX idx_order_id (order_id),
    INDEX idx_status (status)
);

-- Admin users table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    role ENUM('admin', 'manager', 'support') DEFAULT 'support',
    is_active BOOLEAN DEFAULT TRUE,
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Views for reporting
CREATE VIEW order_statistics AS
SELECT 
    DATE(order_date) as order_day,
    COUNT(*) as total_orders,
    SUM(price) as total_revenue,
    AVG(price) as average_order_value,
    status
FROM orders
GROUP BY DATE(order_date), status;

CREATE VIEW top_packages AS
SELECT 
    package_uc,
    COUNT(*) as order_count,
    SUM(price) as total_revenue
FROM orders
WHERE status = 'completed'
GROUP BY package_uc
ORDER BY order_count DESC;

CREATE VIEW customer_lifetime_value AS
SELECT 
    c.player_id,
    c.email,
    c.total_orders,
    c.total_spent,
    c.first_order_date,
    c.last_order_date,
    DATEDIFF(c.last_order_date, c.first_order_date) as customer_lifetime_days
FROM customers c
ORDER BY c.total_spent DESC;
