CREATE DATABASE Smart_Wallet;

USE Smart_Wallet;

CREATE TABLE incomes(
    id INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    montant DECIMAL(8,2) NOT NULL,
    description varchar(1000) NOT NULL,
    date_ DATE DEFAULT (CURRENT_TIME),
    dateIn DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE expences(
    id INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    montant DECIMAL(8,2) NOT NULL,
    description varchar(1000) NOT NULL,
    date_ DATE DEFAULT (CURRENT_TIME),
    dateIn DATETIME DEFAULT CURRENT_TIMESTAMP
    
);
CREATE TABLE users(
    UserID INT PRIMARY key AUTO_INCREMENT,
    UserName varchar(50) NOT NULL,
    Email varchar(100) UNIQUE,
    password VARCHAR(100) NOT NULL,
    ipAdresse VARCHAR(50) not NULL
);

CREATE TABLE OTP (
    id INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    otpCode VARCHAR(6) NOT NULL,       
    Email VARCHAR(100) UNIQUE,
    expiresAt DATETIME NOT NULL,       
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Foreign Key (UserID) REFERENCES users(UserID) on delete CASCADE
);
CREATE TABLE cards (
    id INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    cardNumber VARCHAR(20) NOT NULL,
    expiryDate DATETIME NOT NULL,
    cardCvv VARCHAR(4)  NOT NULL,  
    cardType VARCHAR(20) NOT NULL,       
    BankName VARCHAR(100) NOT NULL,
    CardHolder VARCHAR(100) not NULL,
    balance DECIMAL(10,2) NOT NULL,
    isActive BOOLEAN DEFAULT false,
    Foreign Key (UserID) REFERENCES users(UserID) on delete CASCADE
);

TRUNCATE incomes;
TRUNCATE users;


