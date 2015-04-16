
USE dustindb;
 
CREATE TABLE comments(
        name VARCHAR (32),
        words TEXT,
        id INT (11) NOT NULL auto_increment,
        primary KEY (id)
);

CREATE TABLE recentSearches(
name VARCHAR(16),
id INT(11) NOT NULL auto_increment,
primary KEY(id)
);

