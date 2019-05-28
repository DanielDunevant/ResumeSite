-- Create the resumeSite database
DROP DATABASE IF EXISTS resumeSite;
CREATE DATABASE resumeSite;
USE resumeSite;  -- MySQL command

-- create the tables
CREATE TABLE blogs (
  BlogID       INT(11)        NOT NULL   AUTO_INCREMENT,
  name     VARCHAR(255)   NOT NULL,
  mainText     VARCHAR(255)   NOT NULL,
  imageFilename     VARCHAR(255)   NOT NULL,
  blogType     VARCHAR(255)   NOT NULL,
  dateWritten DATE,
  image longblob,
  PRIMARY KEY (BlogID)
);

CREATE TABLE users(
	userID INT(11) NOT NULL AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	userRank INT(11) NOT NULL,
	PRIMARY KEY (userID)
);
-- create the users and grant priveleges to those users
GRANT SELECT, INSERT, DELETE, UPDATE
ON resumeSite.*
TO 'ddunevant'@'%'
IDENTIFIED BY 'RongYiWenTi1!';
