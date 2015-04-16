CREATE DATABASE dustindb;

USE dustindb;

CREATE USER 'dustinsite'@'localhost' IDENTIFIED BY 'sh33quil';

GRANT ALL PRIVILEGES ON dustindb.* TO 'dustinsite'@'localhost';

CREATE TABLE visitDATA (
	ip VARCHAR (16),
	visits INT (32),
	id INT (11) NOT NULL auto_increment,
	primary KEY (id)
);


CREATE TABLE comments (
	name VARCHAR (32),
	words TEXT,
	id INT (11) NOT NULL auto_increment,
	primary KEY (id),

);

CREATE TABLE recentSearches(
name VARCHAR(16),
id INT(11) NOT NULL auto_increment,
primary KEY(id)
);
