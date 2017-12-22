SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
CREATE DATABASE `diamond_shop`;
USE `diamond_shop`;


ALTER SCHEMA `diamond_shop`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_unicode_ci ;

CREATE TABLE `categories` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `parent_id` INT(11) NOT NULL,
    `description` TEXT,
    PRIMARY KEY (`id`)
)  ENGINE=MYISAM DEFAULT CHARSET=UTF8;
    
CREATE TABLE `providers` (
    `id` INT(11) AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `email` VARCHAR(50),
    `website` VARCHAR(100),
    `phone` VARCHAR(11) NOT NULL,
    PRIMARY KEY (`id`)
)  ENGINE=MYISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `promotions` (
    `id` INT(11) AUTO_INCREMENT,
    `value` INT(11) NOT NULL,
    `description` TEXT,
    PRIMARY KEY (`id`)
)  ENGINE=MYISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `products` (
    `id` INT(11) AUTO_INCREMENT,
    `category_id` INT(11) NOT NULL,
    `provider_id` INT(11) NOT NULL,
    `promotion_id` INT(11) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `quantity` INT(11) NOT NULL,
    `weight` INT(10) NOT NULL,
    `price` INT(11) NOT NULL,
    `description` TEXT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`category_id`)
        REFERENCES `categories` (`id`),
    FOREIGN KEY (`provider_id`)
        REFERENCES `providers` (`id`),
    FOREIGN KEY (`promotion_id`)
        REFERENCES `promotions` (`id`)
)  ENGINE=MYISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `images` (
    `id` INT(11) AUTO_INCREMENT,
    `product_id` INT(11) NOT NULL,
    `path` VARCHAR(50) NOT NULL,
    `is_thumbnail` TINYINT(1),
    PRIMARY KEY (`id`),
    FOREIGN KEY (`product_id`)
        REFERENCES `products` (`id`)
)  ENGINE=MYISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `users` (
    `id` INT(11) AUTO_INCREMENT,
    `user_name` VARCHAR(50) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50),
    `phone` VARCHAR(11),
    `fullname` VARCHAR(50) NOT NULL,
    `gender` TINYINT(1) NOT NULL,
    `birthday` DATE NOT NULL,
    PRIMARY KEY (`id`)
)  ENGINE=MYISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `orders` (
    `id` INT(11) AUTO_INCREMENT,
    `customer_name` VARCHAR(50) NOT NULL,
    `address` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(11) NOT NULL,
    `email` VARCHAR(50),
    `export_date` DATETIME NOT NULL,
    `description` TEXT,
    PRIMARY KEY (`id`)
)  ENGINE=MYISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `orders_detail` (
    `id` INT(11) AUTO_INCREMENT,
    `order_id` INT(11) NOT NULL,
    `product_id` INT(11) NOT NULL,
    `quantity` INT(11) NOT NULL,
    `orginal_price` INT(11) NOT NULL,
    `price` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`order_id`)
        REFERENCES `orders` (id),
    FOREIGN KEY (`product_id`)
        REFERENCES `products` (`id`)
)  ENGINE=MYISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `comments` (
    `id` INT(11) AUTO_INCREMENT,
    `product_id` INT(11) NOT NULL,
    `customer_name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50),
    `phone` VARCHAR(11),
    `creative_day` DATETIME NOT NULL,
    `content` TEXT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`product_id`)
        REFERENCES products (`id`)
)  ENGINE=MYISAM DEFAULT CHARSET=UTF8;

-- INSERT DATA INTO DATABASE --

INSERT INTO `categories`(name, parent_id)
VALUES	('Đồng hồ', 0),
		('Dây chuyền', 0),
        ('Nhẫn', 0),
        ('Hoa tai', 0),
        
		('Đồng hồ vàng', 1),
        ('Đồng hồ bạc', 1),
        ('Đồng hồ bạch kim', 1),
        ('Dây chuyền vàng', 2),
        ('Dây chuyền bạc', 2),
        ('Dây chuyền bạch kim', 2),
        ('Nhẫn kim cương', 3),
        ('Nhẫn vàng', 3),
        ('Nhẫn bạc', 3),
        ('Nhẫn bạch kim', 3),
        ('Hoa tai vàng', 4),
        ('Hoa tai bạc', 4),
        ('Hoa tai bạch kim', 4);
        
INSERT INTO `providers`(name, address, email, website, phone)
VALUES	('Skime', '198, Trần Quang Diệu', 'support.skime@gmail.com', 'www.skime.com', '01205234208'),
		('PNJ', '198, Trần Quang Diệu', 'support.pnj@gmail.com', 'www.pnj.com', '0123527407'),
		('Sky', '198, Trần Quang Diệu', 'support.sky@gmail.com', 'www.sky.com', '0123456789'),
        ('Orion', '198, Trần Quang Diệu', 'support.orion@gmail.com', 'www.orion.com', '0123789789'),
        ('Percius', '198, Trần Quang Diệu', 'support.percius@gmail.com', 'www.percius.com', '0123456456');

INSERT INTO `promotions` (value)
VALUES	(0),
		(20),
		(30),
        (10),
        (15);
        
INSERT INTO `products`(category_id, provider_id, promotion_id, name, quantity, weight, price, description)
VALUES	(5, 1, 2, 'Đồng hồ Skime S5360', 200, 200, 2350000, '<div><p>Đồng hồ đẳng cấp thương hiệu</p></div>'),
		(8, 1, 2, 'Dây chuyền Skime S5360', 200, 200, 2350000, '<div><p>Đồng hồ đẳng cấp thương hiệu</p></div>'),
        (12, 1, 2, 'Nhẫn Skime S5360', 200, 200, 2350000, '<div><p>Đồng hồ đẳng cấp thương hiệu</p></div>'),
        (15, 1, 2, 'Hoa tai Skime S5360', 200, 200, 2350000, '<div><p>Đồng hồ đẳng cấp thương hiệu</p></div>');
        
INSERT INTO `images`(product_id, path, is_thumbnail)
VALUES	(1, './asset/images/product/1/5/1/clock.png', 1),
		(1, './asset/images/product/1/5/1/clock2.png', 0),
        (1, './asset/images/product/1/5/1/clock3.png', 0),
        (1, './asset/images/product/1/5/1/clock4.png', 0);

INSERT INTO `users`(user_name, password, email, phone, fullname, gender, birthday)
VALUES	('admin', MD5('123'), 'admin@gmail.com', '0169989898', 'Đinh Thanh Hoàng', 1, '1998-03-19'),
		('hoang1', MD5('123'), 'hoang1@gmail.com', '0169989898', 'Phan Nhật Hoàng', 1, '1998-06-29'),
        ('quang', MD5('123'), 'quang@gmail.com', '0169989898', 'Nguyễn Minh Quang', 1, '1996-09-20');
        
-- DROP DATABASE diamond_shop; --
        