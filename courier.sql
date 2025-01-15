CREATE DATABASE IF NOT EXISTS consign;
USE consign;

-- Table for parcels
CREATE TABLE parcels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tracking_id VARCHAR(50) UNIQUE NOT NULL,
    sender_name VARCHAR(100) NOT NULL,
    sender_address TEXT NOT NULL,
    sender_country VARCHAR(50) NOT NULL,
    recipient_name VARCHAR(100) NOT NULL,
    recipient_address TEXT NOT NULL,
    recipient_country VARCHAR(50) NOT NULL,
    parcel_name VARCHAR(100) NOT NULL,
    parcel_details TEXT NOT NULL,
    current_status VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    image_url VARCHAR(255) -- To store the image URL
);

-- Table for admins
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
