-- DB user
CREATE USER 'vaca_user'@'localhost' IDENTIFIED BY 'vacations';
GRANT ALL ON vaca_review.* TO 'vaca_user'@'localhost';


-- Create database
CREATE DATABASE IF NOT EXISTS vaca_review;

------------------------------------ TABLE CREATION
-- User table
CREATE TABLE IF NOT EXISTS user (
    id INT NOT NULL, 
    username varchar(45) NOT NULL UNIQUE,
    password_hash varchar(350) NOT NULL,
    salt varchar(250) NOT NULl,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (id)
);


-- Vacation table
CREATE TABLE IF NOT EXISTS vacation (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    name VARCHAR(250),
    location_lat VARCHAR(250),
    location_lon VARCHAR(250),
    img VARCHAR(250),
    description TEXT,
    posted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (id)
);



-- Review table 
CREATE TABLE IF NOT EXISTS review (
    id INT NOT NULL,
    user_id INT NOT NULL,
    vac_id INT NOT NULL,
    title VARCHAR(250),
    body TEXT,
    rating DOUBLE,
    posted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user (id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (vac_id) REFERENCES vacation(id) 
        ON UPDATE CASCADE ON DELETE CASCADE
);



------------------------------------------- STORED PROCS
-- Get vacations
DELIMITER //
CREATE PROCEDURE `get_vacations` ()
BEGIN 
   SELECT name, location_lat, location_lon, img, description,  
   ( SELECT AVG(rating) FROM review ) avg_rating
   FROM vacation;
END//
DELIMITER ;

-- post vacation
DELIMITER //
CREATE PROCEDURE `create_vacation` (IN arg_name VARCHAR(250), IN arg_img VARCHAR(250), IN arg_description TEXT)
BEGIN 
    INSERT INTO vacation (name, img, description)
    VALUES (arg_name, arg_img, arg_description);
END//
DELIMITER ;


-- Edit Vacation 
DELIMITER //
CREATE PROCEDURE `edit_vacation` (IN arg_id INT, IN arg_img VARCHAR(250), IN arg_description TEXT)
BEGIN 
    UPDATE vacation 
    SET name = arg_name, img = arg_img, description = arg_description
    WHERE id = arg_id;
END//
DELIMITER ;

-- delete vacation 
DELIMITER //
CREATE PROCEDURE `delete_vacation` (IN arg_id INT)
BEGIN 
    DELETE FROM vacation WHERE id = arg_id;
END//
DELIMITER ;

-- by highest > lowest rating 
DELIMITER //
CREATE PROCEDURE `get_vacations_low_high` ()
BEGIN 
   SELECT name, location_lat, location_lon, img, description,  
   ( SELECT AVG(rating) FROM review ) avg_rating
   FROM vacation
   ORDER BY avg_rating DESC;
END//
DELIMITER ;

-- lowest > highest rating 
DELIMITER //
CREATE PROCEDURE `get_vacations_high_low` ()
BEGIN 
   SELECT name, location_lat, location_lon, img, description,  
   ( SELECT AVG(rating) FROM review ) avg_rating
   FROM vacation
   ORDER BY avg_rating ASC;
END//
DELIMITER ;

-- select vacations between two dates (STILL IN DEV)
DELIMITER //
CREATE PROCEDURE `get_vacations_between` (IN arg_start_date TIMESTAMP, IN arg_end_date TIMESTAMP)
BEGIN 
   SELECT name, location_lat, location_lon, img, description, posted_at 
   ( SELECT AVG(rating) FROM review ) avg_rating
   FROM vacation
   WHERE posted_at >= arg_start_date
   AND posted_at <= arg_end_date
   ORDER BY avg_rating ASC;
END//
DELIMITER ;

--------------------------------- Reviews

-- get vacation reviews
DELIMITER //
CREATE PROCEDURE `get_vacation_reviews` (IN arg_vac_id INT) 
BEGIN 
   SELECT r.*, v.title, v.name, v.location_lat, v.location_lon, v.img, v.description,
   ( SELECT AVG(rating) FROM review ) avg_rating
   FROM reviews as r
   INNER JOIN vacation as v
   ON r.vac_id = v.id
   WHERE vac_id = arg_vac_id;
END//
DELIMITER ;

-- post review 
DELIMITER //
CREATE PROCEDURE `post_review` (IN arg_user_id INT, IN arg_vac_id INT, IN arg_title VARCHAR(250), IN arg_body TEXT, IN arg_rating DOUBLE) 
BEGIN 
   INSERT INTO review (user_id, vac_id, title, body, rating) 
   VALUES (arg_user_id, arg_vac_id, arg_title, arg_body, arg_rating);
END//
DELIMITER ;

-- Edit review 
DELIMITER //
CREATE PROCEDURE `edit_review` (IN arg_user_id INT, IN arg_vac_id INT, IN arg_title VARCHAR(250), IN arg_body TEXT, IN arg_rating DOUBLE) 
BEGIN 
   INSERT INTO review (user_id, vac_id, title, body, rating) 
   VALUES (arg_user_id, arg_vac_id, arg_title, arg_body, arg_rating);
END//
DELIMITER ;

-- Delete review 
DELIMITER //
CREATE PROCEDURE `edit_review` (IN arg_id INT) 
BEGIN 
    DELETE FROM review WHERE id = arg_id;
END//
DELIMITER ;






---------------------------------- User 
-- Create user
DELIMITER //
CREATE PROCEDURE `create_user` (IN user_id INT, IN user_username VARCHAR(45), IN user_password_hash VARCHAR(350), IN user_salt VARCHAR(250)) 
BEGIN 
    INSERT INTO user (id, username, password_hash, salt) VALUES (user_id, user_username, user_password_hash, user_salt);
END//
DELIMITER ;

-- login (get user)
DELIMITER //
CREATE PROCEDURE `get_user_by_username` (IN user_username VARCHAR(45)) 
BEGIN 
    SELECT * FROM user WHERE username = user_username;
END//
DELIMITER ;
