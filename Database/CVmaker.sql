CREATE DATABASE CVmaker;

USE CVmaker;

CREATE TABLE Education (
  id int(11) NOT NULL AUTO_INCREMENT,
  education varchar(32) NOT NULL,
  place varchar(32) NULL,
  institute varchar(32) NULL,
  fromEdu TIMESTAMP NULL,
  untilEdu TIMESTAMP NULL,
  information text,
  PRIMARY KEY (id)
);

CREATE TABLE Computerskill (
  id int(11) NOT NULL AUTO_INCREMENT,
  skill varchar(32) NOT NULL,
  level ENUM('verygood','good','normal') NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Otherskill (
  id int(11) NOT NULL AUTO_INCREMENT,
  skill varchar(32) NOT NULL,
  level ENUM('verygood','good','normal') NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Experience (
  id int(11) NOT NULL AUTO_INCREMENT,
  functionExp varchar(32) NOT NULL,
  place varchar(32) NULL,
  employer varchar(32) NOT NULL,
  fromExp TIMESTAMP NULL,
  untilExp TIMESTAMP NULL,
  info text NULL,
  PRIMARY KEY (id)
);

CREATE TABLE City (
  zip int(11) NOT NULL,
  city varchar(32),
  PRIMARY KEY (zip)
);

CREATE TABLE Adress (
  id int(11) NOT NULL AUTO_INCREMENT,
  street varchar(40) NOT NULL,
  city_zip int(11) NOT NULL,
  nr int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (city_zip) REFERENCES City(zip)
);
