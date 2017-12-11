CREATE DATABASE diamond_shop;
USE diamond_shop;

CREATE TABLE categories (
    id INT AUTO_INCREMENT,
    name VARCHAR(50),
    PRIMARY KEY (id)
);

CREATE TABLE provider (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    address VARCHAR(60),
    email VARCHAR(50),
    website VARCHAR(100),
    phone VARCHAR(11)
);

CREATE TABLE promotion (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE,
    description VARCHAR(225)
);

CREATE TABLE product (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_categories INT,
    id_provider INT,
    id_promotion INT,
    name VARCHAR(100),
    quantity INT,
    price INT,
    size VARCHAR(20),
    FOREIGN KEY (id_categories)
        REFERENCES categories (id),
    FOREIGN KEY (id_provider)
        REFERENCES provider (id),
    FOREIGN KEY (id_promotion)
        REFERENCES promotion (id)
);


CREATE TABLE image (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_product INT,
    name VARCHAR(50),
    FOREIGN KEY (id_product)
        REFERENCES product (id)

);


CREATE TABLE user (
	id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(50),
    email VARCHAR(50),
    phone VARCHAR(11),
    password VARCHAR(50),
    fullname VARCHAR(50),
    birthday DATE
);

CREATE TABLE customer (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    address VARCHAR(50),
    email VARCHAR(50),
    phone VARCHAR(11)
);

CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_customer INT,
    export_date DATETIME,
    note VARCHAR(255),
    FOREIGN KEY (id_customer)
        REFERENCES customer (id)
);

CREATE TABLE order_detail (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_order INT,
    id_product INT,
    quantity INT,
    FOREIGN KEY (id_order)
        REFERENCES orders (id),
    FOREIGN KEY (id_product)
        REFERENCES product (id)
);

CREATE TABLE comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_product INT,
    customer_name VARCHAR(50),
    email VARCHAR(50),
    phone VARCHAR(11),
    creative_day DATETIME,
    content TEXT,
    FOREIGN KEY (id_product)
        REFERENCES product (id)
);
			
		