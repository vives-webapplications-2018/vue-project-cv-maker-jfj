CREATE DATABASE CVmaker;

USE CVmaker;

CREATE TABLE Addresses (
  id int(11) NOT NULL AUTO_INCREMENT,
  street varchar(40) NOT NULL,
  nr varchar(16) NOT NULL,
  zip int(11) NULL,
  city varchar(32),
  PRIMARY KEY (id)
);

CREATE TABLE Users (
  id int(11) NOT NULL AUTO_INCREMENT,
  firstname varchar(32) NOT NULL,
  lastname varchar(32) NOT NULL,
  gender ENUM('M','F','X') NOT NULL,
  email varchar(128) NOT NULL,
  phonenumber int(11) NULL,
  birthdate date NOT NULL,
  birthplace varchar(32)NOT NULL,
  githubusername varchar(64) NULL,
  githubtoken varchar(64) NULL,
  addresses_id int(11) NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (addresses_id) REFERENCES Addresses(id)
);

CREATE TABLE Education (
  id int(11) NOT NULL AUTO_INCREMENT,
  education varchar(32) NOT NULL,
  place varchar(32) NULL,
  institute varchar(32) NULL,
  fromEdu TIMESTAMP NULL,
  untilEdu TIMESTAMP NULL,
  information text,
  users_id int(11) NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (users_id) REFERENCES Users(id)
);

CREATE TABLE Computerskills (
  id int(11) NOT NULL AUTO_INCREMENT,
  skill varchar(32) NULL,
  level varchar(32) NULL,
  users_id int(11) NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (users_id) REFERENCES Users(id)
);

CREATE TABLE Otherskills (
  id int(11) NOT NULL AUTO_INCREMENT,
  skill varchar(32) NULL,
  level ENUM('verygood','good','normal') NULL,
  users_id int(11) NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (users_id) REFERENCES Users(id)
);

CREATE TABLE languages (
  id int(11) NOT NULL AUTO_INCREMENT,
  language varchar(32) NULL,
  users_id int(11) NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (users_id) REFERENCES Users(id)
);

CREATE TABLE driverlicences (
  id int(11) NOT NULL AUTO_INCREMENT,
  driverlicences varchar(10) NULL,
  users_id int(11) NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (users_id) REFERENCES Users(id)
);


CREATE TABLE Experiences (
  id int(11) NOT NULL AUTO_INCREMENT,
  functionExp varchar(32) NOT NULL,
  place varchar(32) NULL,
  employer varchar(32) NOT NULL,
  fromExp TIMESTAMP NULL,
  untilExp TIMESTAMP NULL,
  information text NULL,
  users_id int(11) NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (users_id) REFERENCES Users(id)
);
