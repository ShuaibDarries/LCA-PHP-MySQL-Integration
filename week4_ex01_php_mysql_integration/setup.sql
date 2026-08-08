-- AfriStaff Database Setup
-- Run this in phpMyAdmin or MySQL CLI to create the database and table

-- Create database
CREATE DATABASE IF NOT EXISTS afristaff_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE afristaff_db;

-- Create staff table
CREATE TABLE IF NOT EXISTS staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data
INSERT INTO staff (first_name, last_name, department, email) VALUES
('Thabo', 'Mokoena', 'Human Resources', 'thabo.mokoena@afristaff.co.za'),
('Lerato', 'Dlamini', 'Finance', 'lerato.dlamini@afristaff.co.za'),
('Sipho', 'Nkosi', 'Information Technology', 'sipho.nkosi@afristaff.co.za'),
('Nomsa', 'Zulu', 'Marketing', 'nomsa.zulu@afristaff.co.za'),
('Kagiso', 'Moloi', 'Operations', 'kagiso.moloi@afristaff.co.za'),
('Amahle', 'Buthelezi', 'Human Resources', 'amahle.buthelezi@afristaff.co.za'),
('Bongani', 'Mahlangu', 'Finance', 'bongani.mahlangu@afristaff.co.za'),
('Zanele', 'Khumalo', 'Information Technology', 'zanele.khumalo@afristaff.co.za'),
('Mandla', 'Sithole', 'Sales', 'mandla.sithole@afristaff.co.za'),
('Refilwe', 'Maseko', 'Marketing', 'refilwe.maseko@afristaff.co.za'),
('Tebogo', 'Pienaar', 'Operations', 'tebogo.pienaar@afristaff.co.za'),
('Dineo', 'Mabena', 'Legal', 'dineo.mabena@afristaff.co.za');
