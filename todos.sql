CREATE DATABASE todosdb;

USE dustindb;

CREATE USER 'dustinsite'@'localhost' IDENTIFIED BY 'qweasd';

GRANT ALL PRIVILEGES ON dustindb.* TO 'dustinsite'@'localhost';


CREATE TABLE todos (
tasks TEXT,
dateadded TIMESTAMP(32),
datecompleted VARCHAR(32),
priority SET('Low', 'Medium', 'High'),
ID int(11) NOT NULL auto_increment,
primary KEY (RID));
