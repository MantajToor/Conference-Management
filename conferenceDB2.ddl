drop database if exists conferenceDB2;
create database conferenceDB2;
use conferenceDB2;

CREATE TABLE room(
num         INT NOT NULL,
num_beds    CHAR(1),
PRIMARY KEY(num)
);

CREATE TABLE attendee(
attendeeID      INT NOT NULL AUTO_INCREMENT,
fee             DECIMAL(10,2) NOT NULL,
fname           VARCHAR(50),
lname           VARCHAR(50),
PRIMARY KEY (attendeeID)
);

CREATE TABLE student(
roomnum     INT,
attendeeID  INT NOT NULL,
FOREIGN KEY(attendeeID) references attendee(attendeeID) ON DELETE CASCADE,
FOREIGN KEY(roomnum) references room(num) ON DELETE SET NULL,
PRIMARY KEY(attendeeID)
);

CREATE TABLE subcommittee(
name VARCHAR(50) NOT NULL,
PRIMARY KEY(name)
);

CREATE TABLE member (
memberID INT,
subcommitteename VARCHAR(100) NOT NULL,
fname VARCHAR(50),
lname VARCHAR(50),
FOREIGN KEY(subcommitteename) references subcommittee(name) ON DELETE CASCADE,
PRIMARY KEY(memberID)
);

CREATE TABLE professional(
attendeeID INT NOT NULL,
FOREIGN KEY(attendeeID) references attendee(attendeeID) ON DELETE CASCADE,
PRIMARY KEY(attendeeID)
);

CREATE TABLE company(
name            VARCHAR(50) NOT NULL,
sentemails      INT,
level           ENUM('bronze', 'silver', 'gold', 'platinum'),
PRIMARY KEY(name)
);

CREATE TABLE jobAD(
salary      INT,
duration    INT,
title       VARCHAR(50),
companyname VARCHAR(50),
FOREIGN KEY(companyname) references company(name) ON DELETE CASCADE,
PRIMARY KEY(title)
);

CREATE TABLE sponsor(
attendeeID  INT NOT NULL,
companyname VARCHAR(50),
FOREIGN KEY(attendeeID) references attendee(attendeeID) ON DELETE CASCADE,
PRIMARY KEY(attendeeID)
);

CREATE TABLE speaker(
attendeeID  INT NOT NULL,
FOREIGN KEY(attendeeID) references attendee(attendeeID)ON DELETE CASCADE,
PRIMARY KEY(attendeeID)
);

CREATE TABLE session(
location            VARCHAR(50) NOT NULL,
sessiondate         DATE NOT NULL,
sessionstarttime    TIME NOT NULL,
sessionendtime      TIME,
speakername         VARCHAR(50),
speakerID           INT,
FOREIGN KEY(speakerID) references speaker(attendeeID)ON DELETE SET NULL,
PRIMARY KEY(location,sessiondate, sessionstarttime)
);

CREATE TABLE memberof(
memberID            INT NOT NULL,
subcommitteename    VARCHAR(50) NOT NULL,
FOREIGN KEY(memberID) references member(memberID) ON DELETE CASCADE,
FOREIGN KEY(subcommitteename) references subcommittee(name)ON DELETE CASCADE,
PRIMARY KEY(memberID, subcommitteename)
);

INSERT INTO attendee (attendeeID, fee, fname, lname) VALUES
  (1, 100.00, 'Alice', 'Smith'),
  (2, 150.00, 'Bob', 'Jones'),
  (3, 120.00, 'Cathy', 'Lee'),
  (4, 130.00, 'Dan', 'Brown'),
  (5, 110.00, 'Eva', 'Green'),
  (6, 140.00, 'Frank', 'White');

INSERT INTO room (num, num_beds)
VALUES
  (101, '1'),
  (102, '2'),
  (103, '2'),
  (104, '3'),
  (105, '1'),
  (106, '2');

INSERT INTO student (roomnum, attendeeID) VALUES (101, 1), (102, 2), (103, 3), (104, 4), (105, 5), (106, 6);

INSERT INTO subcommittee (name) VALUES ('Finance'), ('Marketing'), ('Operations'), ('Logistics'), ('Sponsorship'), ('IT');

INSERT INTO member (memberID, subcommitteename, fname, lname) VALUES 
(1, 'Finance', 'John', 'Doe'), 
(2, 'Marketing', 'Jane', 'Smith'), 
(3, 'Operations', 'Emily', 'Davis'), 
(4, 'Logistics', 'Michael', 'Brown'), 
(5, 'Sponsorship', 'Sarah', 'Wilson'), 
(6, 'IT', 'Chris', 'Taylor');

INSERT INTO professional (attendeeID) VALUES (2), (4), (6);

INSERT INTO company (name, sentemails, level) VALUES 
('meta', 5, 'gold'), 
('amazon', 3, 'silver'), 
('apple', 7, 'platinum'), 
('microsoft', 2, 'bronze'), 
('google', 4, 'gold'), 
('TD', 1, 'silver');

INSERT INTO jobAD (salary, duration, title, companyname) VALUES 
(60000, 12, 'Software Engineer', 'meta'), 
(55000, 12, 'Data Analyst', 'amazon'), 
(70000, 24, 'Product Manager', 'amazon'), 
(50000, 12, 'HR Specialist', 'meta'), 
(65000, 18, 'Finance Analyst', 'apple'), 
(58000, 12, 'Marketing Coordinator', 'apple');

INSERT INTO sponsor (attendeeID, companyname) VALUES (1, 'meta'), (2, 'meta'), (3, 'amazon'), (5, 'apple');

INSERT INTO speaker (attendeeID) VALUES (2), (4), (6);

INSERT INTO session (location, sessiondate, sessionstarttime, sessionendtime, speakerID) VALUES 
('Room A', '2025-03-10', '09:00:00', '10:30:00', 2), 
('Room B', '2025-03-11', '11:00:00', '12:30:00', 4), 
('Room C', '2025-03-12', '14:00:00', '15:30:00', 6);

INSERT INTO memberof (memberID, subcommitteename) VALUES (1, 'Finance'), (2, 'Marketing'), (3, 'Operations'), (4, 'Logistics'), (5, 'Sponsorship'), (6, 'IT');

