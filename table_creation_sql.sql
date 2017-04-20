CREATE TABLE cowusers (
     id INT NOT NULL AUTO_INCREMENT,
     username CHAR(8) NOT NULL,
     password CHAR(12) NOT NULL,
     PRIMARY KEY (id)
);

CREATE TABLE todo (
     id INT NOT NULL AUTO_INCREMENT,
     item TEXT NOT NULL,
     username char(8) NOT NULL,
     PRIMARY KEY (id)
);
