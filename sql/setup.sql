CREATE DATABASE IF NOT EXISTS Study_Hub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE Study_Hub;

-- 1. Bảng Users 
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    avatar VARCHAR(255) DEFAULT 'default_avatar.png', 
    role ENUM('admin', 'student') DEFAULT 'student',
    vip_expiration_date DATETIME DEFAULT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Bảng Subjects 
CREATE TABLE IF NOT EXISTS subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_code VARCHAR(20) NOT NULL UNIQUE, 
    subject_name VARCHAR(100) NOT NULL,
    credits INT DEFAULT 3,
    category ENUM('Đại cương', 'Cơ sở ngành', 'Chuyên ngành', 'Đồ án') DEFAULT 'Đại cương', 
    is_vip TINYINT(1) DEFAULT 0, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Bảng Documents 
CREATE TABLE IF NOT EXISTS documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    file_path VARCHAR(255) NOT NULL,
    file_type VARCHAR(20),
    subject_id INT,
    uploaded_by INT,
    download_count INT DEFAULT 0, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE SET NULL
);

-- 4. Bảng Transactions 
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL, 
    transaction_code VARCHAR(50) NOT NULL UNIQUE, 
    status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);