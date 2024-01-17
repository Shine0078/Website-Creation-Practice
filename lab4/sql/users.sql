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


-- Drop the sequence if it exists and create a new one starting at 5000
DROP SEQUENCE IF EXISTS clients_id_seq CASCADE;

CREATE SEQUENCE clients_id_seq START 5000;

-- Drop the clients table if it exists along with dependent objects (CASCADE)
DROP TABLE IF EXISTS clients CASCADE;

-- Create the clients table with proper column names and foreign key references
CREATE TABLE clients (
    Id INT PRIMARY KEY DEFAULT nextval ('clients_id_seq'),
    EmailAddress VARCHAR(255) UNIQUE,
    FirstName VARCHAR(128),
    LastName VARCHAR(15),
    PhoneNumber VARCHAR(15),
    Extension INT,
    Sales_id INT NOT NULL,
    logo_path VARCHAR(255),
    FOREIGN KEY(Sales_id) REFERENCES users(Id)
    UserType VARCHAR(2)
);

-- Insert data into the clients table
INSERT INTO clients (EmailAddress, FirstName, LastName, PhoneNumber, Extension, Sales_id)
VALUES ('samuelabraham@gmail.com', 'John', 'Doe', '123-456-7890', 123, 1);
INSERT INTO clients (EmailAddress, FirstName, LastName, PhoneNumber, Extension, Sales_idh)
VALUES ('robinroy@email.com', 'Robin', 'roy', '123-404-5079', 123, 8);




-- Select all records from the clients table
SELECT * FROM clients;
