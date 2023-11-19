DROP USER 'user'@'localhost';

CREATE USER 'user'@'localhost' IDENTIFIED BY 'userggg';
GRANT SELECT, UPDATE , DELETE, INSERT ON `ggg`.* TO 'user'@'localhost';
FLUSH PRIVILEGES;

