CREATE DATABASE warehouse_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
	fullname VARCHAR(255) NOT NULL,
	avatar VARCHAR(255),
    birthday DATETIME,
    nationality VARCHAR(255)
);

CREATE TABLE categories (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	UNIQUE KEY (name)
);

CREATE TABLE units (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	UNIQUE KEY (name) 
);

CREATE TABLE products (
	id INT AUTO_INCREMENT PRIMARY KEY,
	code VARCHAR(255) NOT NULL,
	category_id INT NOT NULL,
	name VARCHAR(255) NOT NULL,
	price DECIMAL(13, 2) NOT NULL,
	unit_id INT NOT NULL,
	quantity FLOAT DEFAULT '0',
	status tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
	note VARCHAR(255),
	created datetime NOT NULL,
	modified datetime,
	FOREIGN KEY category_key (category_id) REFERENCES categories(id),
	FOREIGN KEY unit_key (unit_id) REFERENCES units(id),
	UNIQUE KEY (code)
);

INSERT INTO `users`(
    `username`,
    `password`,
    `fullname`
)
VALUES(
    'admin',
    '$2y$10$FrMmbOR7JQJM5N5nVVJfyu/7c5H6z1s5TnZkAahjXvw0YPZYY/lVC',
    'Huy Lam'
)
