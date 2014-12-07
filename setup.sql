CREATE DATABASE dustindb;

USE dustindb;

CREATE USER 'dustinsite'@'localhost' IDENTIFIED BY 'qweasd';

GRANT ALL PRIVILEGES ON dustindb.* TO 'dustinsite'@'localhost';

CREATE TABLE visitDATA (
	ip VARCHAR (16),
	visits INT (32),
	id INT (11) NOT NULL auto_increment,
	primary KEY (id)
);

CREATE TABLE searchDATA (
	name VARCHAR (16),
	summonerid INT (11),


