-- Samuel Abraham
--2023-09-25
--INFT 2100



CREATE EXTENSION IF NOT EXISTS pgcrypto;

DROP SEQUENCE IF EXISTS users_id_seq CASCADE;

CREATE SEQUENCE users_id_seq START 1000;

DROP TABLE IF EXISTS users;

CREATE TABLE users(
    Id INT PRIMARY KEY DEFAULT nextval('users_id_seq'),
    EmailAddress VARCHAR(255) UNIQUE,
    Password VARCHAR(255) NOT NULL,
    FirstName VARCHAR(128) NOT NULL,
    LastName VARCHAR(128) NOT NULL,
    CreatedTime TIMESTAMP,
    LastLoggedIn TIMESTAMP,
    phoneExtension VARCHAR(128),
    UserType VARCHAR(2)
);

INSERT INTO users(EmailAddress, Password, FirstName, LastName, CreatedTime, LastLoggedIn, phoneExtension, UserType)
VALUES ('jdoe@dcmail.ca',  crypt('password', gen_salt('bf')), 'John', 'Doe', '2023-09-05 19:10:20', '2023-09-05 20:00:00', '1211', 'a');

INSERT INTO users(EmailAddress, Password, FirstName, LastName, CreatedTime, LastLoggedIn, phoneExtension, UserType)
VALUES ('shine@dcmail.ca',  crypt('100870571', gen_salt('bf')), 'Shine', 'Joe', '2023-09-05 10:09:25', '2023-08-07 20:00:00', '3452', 'a');

INSERT INTO users(EmailAddress, Password, FirstName, LastName, CreatedTime, LastLoggedIn, phoneExtension, UserType)
VALUES ('jack@dcmail.ca',  crypt('1234567', gen_salt('bf')), 'Jack', 'Dan', '2023-09-05 12:10:22', '2023-09-10 20:00:00', '91081', 'a');

SELECT * FROM users;