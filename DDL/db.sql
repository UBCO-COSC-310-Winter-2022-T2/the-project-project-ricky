CREATE DATABASE edupoll;

USE DATABASE edupoll;

CREATE TABLE student(
    username VARCHAR(256) NOT NULL,
    password VARCHAR(256) NOT NULL,
    firstName VARCHAR(256) NOT NULL,
    lastName VARCHAR(256) NOT NULL,
    email VARCHAR(256) NOT NULL,
    PRIMARY KEY (username)
)

CREATE TABLE teacher(
    username VARCHAR(256) NOT NULL,
    password VARCHAR(256) NOT NULL,
    firstName VARCHAR(256) NOT NULL,
    email VARCHAR(256) NOT NULL,
    school VARCHAR(256) NOT NULL,
    PRIMARY KEY (username)
)

CREATE TABLE class(
    cname VARCHAR(256) NOT NULL,
    teacher VARCHAR(256) NOT NUll,
    school VARCHAR(256) NOT NULL,
    FOREIGN KEY(school) REFERENCES teacher(school) ON UPDATE CASCADE ON DELETE CASCADE
    FOREIGN KEY(teacher) REFERENCES teacher(username) ON UPDATE CASCADE ON DELETE CASCADE
)
CREATE TABLE quiz(
    qname VARCHAR(256) NOT NULL,
    cname VARCHAR(256) NOT NULL,
    school VARCHAR(256) NOT NULL,

)
CREATE TABLE question(

)
