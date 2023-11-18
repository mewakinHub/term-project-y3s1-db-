CREATE USER 'user'@'localhost' IDENTIFIED BY 'userggg';
GRANT SELECT, UPDATE , INSERT ON `ggg`.* TO 'user'@'localhost';
FLUSH PRIVILEGES;

