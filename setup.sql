CREATE DATABASE dustindb;

USE dustindb;

CREATE USER 'dustin'@'localhost' IDENTIFIED BY 'qweasd';

GRANT ALL PRIVILEGES ON dustindb.* TO 'dustin'@'localhost';

CREATE TABLE visitDATA (
	ip VARCHAR (16),
	visits INT (32),
	id INT (11) NOT NULL auto_increment,
	primary KEY (id)
);
