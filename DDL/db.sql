CREATE DATABASE IF NOT EXISTS edupol;

USE edupol;

CREATE USER IF NOT EXISTS 'cosc310user'@'localhost' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON edupol.* TO 'cosc310user'@'localhost';
CREATE USER IF NOT EXISTS 'cosc310user'@'%' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON edupol.* TO 'cosc310user'@'%';

CREATE TABLE student(
    username VARCHAR(256) NOT NULL,
    password VARCHAR(256) NOT NULL,
    firstName VARCHAR(256),
    lastName VARCHAR(256),
    email VARCHAR(256) NOT NULL,
    PRIMARY KEY (username)
);
CREATE TABLE teacher(
    username VARCHAR(256) NOT NULL,
    password VARCHAR(256) NOT NULL,
    firstName VARCHAR(256) ,
    lastName VARCHAR(256),
    email VARCHAR(256) NOT NULL,
    school VARCHAR(256) NOT NULL,
    PRIMARY KEY (username)
);
CREATE TABLE class(
    cname VARCHAR(256) NOT NULL,
    teacher VARCHAR(256) NOT NULL,
    school VARCHAR(256) NOT NULL,
    PRIMARY KEY(cname, school),
    FOREIGN KEY(teacher) REFERENCES teacher(username)
);
CREATE TABLE sclass(
    username VARCHAR(256) NOT NULL,
    cname VARCHAR(256) NOT NULL,
    school VARCHAR(256) NOT NULL,
    grade INT NOT NULL DEFAULT 0,
    PRIMARY KEY (username, cname, school),
    FOREIGN KEY(username) REFERENCES student(username) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(cname, school) REFERENCES class(cname, school) ON UPDATE CASCADE ON DELETE CASCADE
);
CREATE TABLE quiz(
    qname VARCHAR(256) NOT NULL,
    cname VARCHAR(256) NOT NULL,
    school VARCHAR(256) NOT NULL,
    PRIMARY KEY(qname),
    FOREIGN KEY(cname, school) REFERENCES class(cname, school) ON UPDATE CASCADE ON DELETE CASCADE
);
CREATE TABLE question(
    qid INT NOT NULL AUTO_INCREMENT,
    content VARCHAR(256) NOT NULL,
    qname VARCHAR(256) NOT NULL,
    optionA VARCHAR(256) NOT NULL,
    optionB VARCHAR(256) NOT NULL,
    optionC VARCHAR(256) NOT NULL,
    optionD VARCHAR(256) NOT NULL,
    answer ENUM('A', 'B', 'C', 'D') NOT NULL,
    PRIMARY KEY(qid),
    FOREIGN KEY(qname) REFERENCES quiz(qname) ON UPDATE CASCADE ON DELETE CASCADE
);
INSERT INTO teacher(username, password, firstName, lastName, email, school) VALUES ('teacher', MD5('teacher123'),'Teacher','Test', 'teacher@gmail.com','UBC');
INSERT INTO student(username, password, firstName, lastName, email) VALUES('test', MD5('test'), 'Student','Test','student@gmail.com');
INSERT INTO class(cname, teacher, school) VALUES ('Test Class', 'teacher','UBC');
INSERT INTO sclass(username, cname, school) VALUES('test','Test Class','UBC');