CREATE DATABASE Smart_Wallet;

USE Smart_Wallet;

CREATE TABLE incomes(
    id INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    montant DECIMAL(8,2) NOT NULL,
    description varchar(1000) NOT NULL,
    date_ DATE DEFAULT (CURRENT_TIME),
    dateIn DATETIME DEFAULT CURRENT_TIMESTAMP
    cardNumber VARCHAR(20) NOT NULL
);
CREATE TABLE expences(
    id INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    montant DECIMAL(8,2) NOT NULL,
    description varchar(1000) NOT NULL,
    date_ DATE DEFAULT (CURRENT_TIME),
    dateIn DATETIME DEFAULT CURRENT_TIMESTAMP
    cardNumber VARCHAR(20) NOT NULL
    category VARCHAR(30) NOT NULL
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

CREATE TABLE category_limits(
  id INT PRIMARY KEY AUTO_INCREMENT,
  category VARCHAR(30),
  limit_amount DECIMAL(10,2)
);


INSERT INTO category_limits (category, limit_amount) VALUES
                                         ('food', 1500.00),
                                         ('shopping', 2000.00),
                                         ('entertainment', 900.00),
                                         ('utilities', 700.00),
                                         ('transportation', 500.00),
                                         ('healthcare', 1000.00),
                                         ('education', 1200.00),
                                         ('housing', 3000.00),
                                         ('travel', 1500.00),
                                         ('others', 800.00);


TRUNCATE expences;
TRUNCATE users;


CREATE Table transactions(
    id INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    cardNumber VARCHAR(20) NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    recipientcard VARCHAR(20) NOT NULL,
    dateIn DATETIME DEFAULT CURRENT_TIMESTAMP
)
    