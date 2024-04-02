CREATE DATABASE ishop;

USE ishop;


CREATE TABLE IF NOT EXISTS `user` (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    profile_image VARCHAR(255) NULL DEFAULT 'dummy_profile_image.png',
    date_registered TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT DEFAULT NULL,
    quantity INT NOT NULL,
    user_session VARCHAR(255),
    date_added TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS product (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    product_price DECIMAL(10, 2) NOT NULL,
    product_image VARCHAR(1024) NOT NULL,
    product_status VARCHAR(250) DEFAULT NULL
);


INSERT INTO `product` VALUES
(1,'Product 1',20,'https://placehold.co/450x300?text=image','Fancy Product'),
(2,'Product 2',15,'https://placehold.co/450x300?text=image','Special Item'),
(3,'Product 3',70,'https://placehold.co/450x300?text=image','Popular Item'),
(4,'Product 4',15,'https://placehold.co/450x300?text=image','Sale Item'),
(5,'Product 5',12,'https://placehold.co/450x300?text=image','Sale Item'),
(6,'Product 6',20,'https://placehold.co/450x300?text=image','Fancy Product'),
(7,'Product 7',10,'https://placehold.co/450x300?text=image','Sale Item'),
(8,'Product 8',50,'https://placehold.co/450x300?text=image','Popular Item');


CREATE TABLE IF NOT EXISTS contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    date_posted TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);