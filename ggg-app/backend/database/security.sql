DROP USER 'user'@'localhost';

CREATE USER 'ggguser'@'localhost' IDENTIFIED BY 'userggg';
GRANT SELECT, UPDATE , DELETE, INSERT ON `ggg`.* TO 'user'@'localhost';
FLUSH PRIVILEGES;

