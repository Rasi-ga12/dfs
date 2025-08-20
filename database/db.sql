CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    mobilenumber VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    contact VARCHAR(15) NOT NULL,
    message TEXT NOT NULL,
    isread TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE db2(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    mobile_number VARCHAR(15) ,
    relation ENUM('Relative', 'Other Person'),
    relative_description VARCHAR(255) DEFAULT 'other person',
    address VARCHAR(255) ,
    aadhar_number VARCHAR(12) ,
    aadhar_file LONGBLOB ,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE db1 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    dateofbirth DATE,
    deathdate DATE,
    cause TEXT,
    address TEXT,
    layingmethod VARCHAR(255),
    burialtime DATETIME,
    anyrequest TEXT,
    aadhar VARCHAR(12),
    files BLOB,
    status ENUM('Pending', 'Accepted', 'Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    db1_id INT, -- Foreign key referencing db1.id
    FOREIGN KEY (db1_id) REFERENCES db2(id)
);


ALTER TABLE db2 ADD COLUMN email VARCHAR(255) UNIQUE;
ALTER TABLE db1
ADD COLUMN relation ENUM('Relative', 'Other Person') AFTER status,
ADD COLUMN relative_description VARCHAR(255) DEFAULT 'other person' AFTER relation,
MODIFY COLUMN status ENUM('Pending', 'Accepted', 'Rejected', 'Completed') DEFAULT 'Pending';


CREATE TABLE member(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    mobile_number VARCHAR(15) ,
    address VARCHAR(255) ,
    aadhar_number VARCHAR(12) ,
    aadhar_file LONGBLOB ,
    status ENUM('Pending', 'Accepted', 'Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE member ADD COLUMN email VARCHAR(255) UNIQUE;
ALTER TABLE db2
DROP COLUMN relation,
DROP COLUMN relative_description;
