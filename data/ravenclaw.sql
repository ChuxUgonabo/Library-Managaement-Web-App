DROP DATABASE IF EXISTS ravenclaw;

create database ravenclaw;

use ravenclaw;

CREATE TABLE Books
( Books_ISBN VARCHAR(20) NOT NULL PRIMARY KEY,
  Name CHAR(50) NOT NULL,
  Author CHAR(100) not null,
  Publisher CHAR(30) not null,
  IssuedBookFlag INT UNSIGNED not null,
  ReturnBookCount INT UNSIGNED not null
);

CREATE TABLE Users
(  UserID INT UNSIGNED NOT NULL PRIMARY KEY,
   UserPassword VARCHAR(50) NOT NULL,
   UserStatus INT UNSIGNED NOT NULL
);

CREATE TABLE IssuedBooks
( Books_ISBN VARCHAR(20) NOT NULL,
  CustomerID INT UNSIGNED NOT NULL,
  dateTime DATE NOT NULL,
  PRIMARY KEY (Books_ISBN, CustomerID),
  FOREIGN KEY (Books_ISBN) REFERENCES Books(Books_ISBN),
  FOREIGN KEY (CustomerID) REFERENCES Users(UserID)
);


insert into Books (Books_ISBN, Name, Author, Publisher, IssuedBookFlag, ReturnBookCount) values ('779378087-6', 'Introduction to PHP', 'O-Reilly', 'Pearson', 1, 0);
insert into Books (Books_ISBN, Name, Author, Publisher, IssuedBookFlag, ReturnBookCount) values ('260889879-3', 'Paradise Lost', 'John Milton', 'Bloomsbury', 0, 0);
insert into Books (Books_ISBN, Name, Author, Publisher, IssuedBookFlag, ReturnBookCount) values ('870922070-4', 'Unto The Last', 'John Ruskin', 'Arbor House', 1, 0);
insert into Books (Books_ISBN, Name, Author, Publisher, IssuedBookFlag, ReturnBookCount) values ('390816627-6', 'The Bell Jar', 'Slyvia Plath', 'Millenial print', 0, 0);
insert into Books (Books_ISBN, Name, Author, Publisher, IssuedBookFlag, ReturnBookCount) values ('759061211-1', 'Ethan Frome', 'Edith Wharton', 'Arkham House', 0, 0);
insert into Books (Books_ISBN, Name, Author, Publisher, IssuedBookFlag, ReturnBookCount) values ('511216732-7', 'Light in August', 'William Faulkner', 'Bella Books', 0, 0);
insert into Books (Books_ISBN, Name, Author, Publisher, IssuedBookFlag, ReturnBookCount) values ('381941823-7', 'The Road', 'Cormac McCarthy', 'Craftsman Book Company', 0, 0);
insert into Books (Books_ISBN, Name, Author, Publisher, IssuedBookFlag, ReturnBookCount) values ('743488060-0', 'Columbine', 'Dave Cullen', 'Daw Books', 0, 0);
insert into Books (Books_ISBN, Name, Author, Publisher, IssuedBookFlag, ReturnBookCount) values ('889724251-0', 'Lonesome Dove', 'Larry McCarthy', 'Free Press', 0, 0);
insert into Books (Books_ISBN, Name, Author, Publisher, IssuedBookFlag, ReturnBookCount) values ('622670869-7', 'The Waste Land', 'T.S.Eliot', 'Hogarth Press', 0, 0);


insert into Users (UserID, UserPassword,UserStatus) values (1, 'qwertyuiop',0);
insert into Users (UserID, UserPassword,UserStatus) values (2, 'CcQ5FBkGrQ',0);
insert into Users (UserID, UserPassword,UserStatus) values (3, 'pZPUuBa',0);
insert into Users (UserID, UserPassword,UserStatus) values (4, 'fBZAWqwk',0);
insert into Users (UserID, UserPassword,UserStatus) values (5, 'I6k243',1);
insert into Users (UserID, UserPassword,UserStatus) values (10, 'qwertyuiop',1);


insert into IssuedBooks (Books_ISBN, CustomerID, dateTime) values ('779378087-6', 1, '2019-09-01');
insert into IssuedBooks (Books_ISBN, CustomerID, dateTime) values ('870922070-4', 2, '2016-03-07');


