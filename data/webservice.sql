DROP DATABASE IF EXISTS webservice;

create database webservice;

use webservice;

CREATE TABLE Review(
    BookISBN  VARCHAR(20) NOT NULL PRIMARY KEY,
    review  VARCHAR(200) NOT NULL
);

INSERT INTO Review(BookISBN, review) values ('779378087-6','This is one of a kind book. I would recommend this book everybody who are starting to read books. Waiting for the second book.');
INSERT INTO Review(BookISBN, review) values ('260889879-3','The Road is a dynamic tale, offered in the often exalted prose that is McCarthy’s signature, but this time in restrained doses — short, vivid sentences.');
INSERT INTO Review(BookISBN, review) values ('870922070-4','This book is a must-read for anyone who has ever suffered from depression or would like to know more about the mental illness.');
INSERT INTO Review(BookISBN, review) values ('390816627-6','Light in August is a novel that follows the point of view of several characters who play witness to the events of the novel.');
INSERT INTO Review(BookISBN, review) values ('759061211-1','It is rare indeed to find someone who has stumbled unburdened by preconceived ideas upon this Goliath of a poem.');
INSERT INTO Review(BookISBN, review) values ('511216732-7','I had to constantly remind myself while reading Columbine that this was Not Fiction.');
INSERT INTO Review(BookISBN, review) values ('381941823-7','Ethan Frome is a powerful story about powerless people. The title character is held in thrall by his parents, his land, his poverty, and his lifeless and loveless marriage.');
INSERT INTO Review(BookISBN, review) values ('743488060-0','Best book to kickstart PHP. All basic concepts were clearly explained with a lot of examples.');
INSERT INTO Review(BookISBN, review) values ('889724251-0','Best book I have ever read in a long time. Please do encourage books like this. We need to read more stories like it');
INSERT INTO Review(BookISBN, review) values ('622670869-7','My first time reading a Pulitzer winner and it is truly an epic story in every sense. A book that left me happy, sad, angry, and teary at times. ');