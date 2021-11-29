CREATE TABLE users( 
    user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    user_name VARCHAR(20) NOT NULL, 
    user_email VARCHAR(80) NOT NULL, 
    user_password VARCHAR(120) NOT NULL, 
    user_tell INT NOT NULL, 
    user_addr VARCHAR(160)NOT NULL, 
    user_addr_num INT NOT NULL, 
    user_groups VARCHAR(20) NOT NULL, 
    user_business_num int 
); 

CREATE TABLE room ( 
    room_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    user_id INT NOT NULL, 
    room_price INT NOT NULL, 
    room_name VARCHAR(20) NOT NULL, 
    room_text VARCHAR(255) NOT NULL, 
    room_type VARCHAR(60) NOT NULL, 
    room_info VARCHAR(60) NOT NULL, 
    room_img1 BLOB NOT NULL, 
    room_img2 BLOB, 
    room_img3 BLOB, 
    room_img4 BLOB, 
    room_img5 BLOB, 
    FOREIGN KEY(user_id) REFERENCES users(user_id) 
); 


CREATE TABLE reservation ( 
    res_id int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    user_id INT NOT NULL, 
    room_id INT NOT NULL, 
    res_pay INT NOT NULL, 
    res_pay_date TIMESTAMP NOT NULL, 
    res_start DATE NOT NULL, 
    res_end	DATE NOT NULL, 
    FOREIGN KEY(user_id) REFERENCES users(user_id), 
    FOREIGN KEY(room_id) REFERENCES room(room_id) 
); 