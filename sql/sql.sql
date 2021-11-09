CREATE DATABASE store;

use store;

CREATE TABLE admins (
    admin_id TINYINT UNSIGNED DEFAULT 1,
    email VARCHAR(40) NOT NULL UNIQUE,
    password CHAR(32) NOT NULL,
    PRIMARY KEY (admin_id)
);

INSERT INTO admins (email,password)
VALUES ("boss@shop.com",MD5('passwordA1store'));

CREATE TABLE mimetypes ( 
    mimetype_id TINYINT UNSIGNED AUTO_INCREMENT, 
    mimetype VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY (mimetype_id)
);

INSERT INTO mimetypes (mimetype) VALUES ("image/jpeg"),("image/png");

CREATE TABLE files ( 
    file_id INT UNSIGNED AUTO_INCREMENT, 
    filename VARCHAR(255) NOT NULL, 
    filedata MEDIUMBLOB,
    mimetype_id TINYINT UNSIGNED NOT NULL,  
    PRIMARY KEY (file_id),
    FOREIGN KEY (mimetype_id) REFERENCES mimetypes(mimetype_id)
);

INSERT INTO files (filename, mimetype_id) VALUES ("Watch.jpeg", 1),("Wallet.jpeg", 1),("Ring.jpeg", 1),("Mug.png", 2);

CREATE TABLE items (
    item_id SMALLINT UNSIGNED AUTO_INCREMENT,
    name VARCHAR(40) NOT NULL UNIQUE,
    description VARCHAR(255) NOT NULL UNIQUE,
    cost decimal(7,2) UNSIGNED NOT NULL,
    file_id INT UNSIGNED NOT NULL, 
    PRIMARY KEY (item_id),
    FOREIGN KEY (file_id) REFERENCES files(file_id)
);
INSERT INTO items (name,description,cost,file_id)
VALUES ("Watch", "Good Run, 42 mm, Second Time Zone Day/Night.",00186.00,1),
("Wallet","A pocket-sized flat folding case for holding money and plastic cards.",00386.00,2),
("Ring","A nice ring.",00100.00,3),
("Mug","Fill me up with tea mug.",00030.00,4);

CREATE TABLE suberbs (
    suberb_id INT UNSIGNED AUTO_INCREMENT,
    suberb VARCHAR(40) NOT NULL UNIQUE,
    PRIMARY KEY (suberb_id)
);

INSERT INTO suberbs (suberb)
VALUES ("CARINE"),("DUNCRAIGE");

CREATE TABLE post_codes (
    post_code_id SMALLINT UNSIGNED AUTO_INCREMENT,
    post_code VARCHAR(4) NOT NULL UNIQUE,
    PRIMARY KEY (post_code_id)
);

INSERT INTO post_codes (post_code)
VALUES ("6091"),("6056");

CREATE TABLE states (
    state_id TINYINT UNSIGNED AUTO_INCREMENT,
    state VARCHAR(3) NOT NULL UNIQUE,
    PRIMARY KEY (state_id)
);

INSERT INTO states (state)
VALUES ("ACT"),("NSW"),("NT"),("QLD"),("SA"),("TAS"),("VIC"),("WA");

CREATE TABLE clients (
    client_id INT UNSIGNED AUTO_INCREMENT,
    name VARCHAR(40) NOT NULL,
    phone VARCHAR(16) NOT NULL,
    email VARCHAR(40) NOT NULL UNIQUE,
    password CHAR(32) NOT NULL,
    street VARCHAR(40) NOT NULL,
    suberb_id INT UNSIGNED NOT NULL,
    post_code_id SMALLINT UNSIGNED NOT NULL,
    state_id TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (client_id),
    FOREIGN KEY (suberb_id) REFERENCES suberbs(suberb_id),
    FOREIGN KEY (post_code_id) REFERENCES post_codes(post_code_id),
    FOREIGN KEY (state_id) REFERENCES states(state_id)
);

INSERT INTO clients (name,phone,email,password,street,suberb_id,post_code_id,state_id)
VALUES ("Daneil Costello" ,"95579048" ,"shlooby070@gmail.com",MD5('passwordA1store'),"9 MOSSPAUL RD",1,1,8),
("Tony Evans" ,"96679834" ,"tevans@gmail.com",MD5('passwordA2store'),"7 START RD",2,2,5),
("Riki Ensen" ,"96673864" ,"riki@gmail.com",MD5('passwordA3store'),"3 MIDDLE WY",1,1,8);

CREATE TABLE orders (
    order_id INT UNSIGNED AUTO_INCREMENT,
    date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    quantity TINYINT UNSIGNED NOT NULL,
    client_id INT UNSIGNED NOT NULL,
    item_id SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (order_id),
    FOREIGN KEY (client_id) REFERENCES clients(client_id),
    FOREIGN KEY (item_id) REFERENCES items(item_id)
);

INSERT INTO orders (quantity,client_id,item_id)
VALUES (1,1,1),(2,1,2),(1,2,3),(2,3,4);
