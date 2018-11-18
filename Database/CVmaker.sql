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

CREATE TABLE Computerskills (
  id int(11) NOT NULL AUTO_INCREMENT,
  skill varchar(32) NOT NULL,
  level ENUM('verygood','good','normal') NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Otherskills (
  id int(11) NOT NULL AUTO_INCREMENT,
  skill varchar(32) NOT NULL,
  level ENUM('verygood','good','normal') NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Experiences (
  id int(11) NOT NULL AUTO_INCREMENT,
  functionExp varchar(32) NOT NULL,
  place varchar(32) NULL,
  employer varchar(32) NOT NULL,
  fromExp TIMESTAMP NULL,
  untilExp TIMESTAMP NULL,
  information text NULL,
  PRIMARY KEY (id)
);


CREATE TABLE Addresses (
  id int(11) NOT NULL AUTO_INCREMENT,
  street varchar(40) NOT NULL,
  city_zip int(11) NOT NULL,
  nr int(11) NOT NULL,
  zip int(11) NULL,
  city varchar(32),
  PRIMARY KEY (id)
);

CREATE TABLE Users (
  id int(11) NOT NULL AUTO_INCREMENT,
  firstname varchar(32) NOT NULL,
  lastname varchar(32) NOT NULL,
  email varchar(128) NOT NULL,
  phonenumber int(11) NULL,
  birthdate date NOT NULL,
  birthplace varchar(32)NOT NULL,
  addresses_id int(11) NULL,
  educations_id int(11) NULL,
  experiences_id int(11) NULL,
  computerskills_id int(11) NULL,
  otherskills_id int(11) NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (addresses_id) REFERENCES Addresses(id),
  FOREIGN KEY (educations_id) REFERENCES Education(id),
  FOREIGN KEY (experiences_id) REFERENCES Experiences(id),
  FOREIGN KEY (computerskills_id) REFERENCES Computerskills(id),
  FOREIGN KEY (otherskills_id) REFERENCES Otherskills(id)
);
