-- Drop the sequence if it exists and create a new one starting at 5000
DROP SEQUENCE IF EXISTS clients_id_seq CASCADE;
CREATE SEQUENCE clients_id_seq START 5000;

-- Drop the clients table if it exists
DROP TABLE IF EXISTS clients CASCADE;

-- Create the clients table with proper column names and foreign key references
CREATE TABLE clients (
    Id INT PRIMARY KEY DEFAULT nextval('clients_id_seq'),
    EmailAddress VARCHAR(255) UNIQUE,
    FirstName VARCHAR(128),
    LastName VARCHAR(128),
    PhoneNumber VARCHAR(15),
    Extension INT,
    Sales_id INT NOT NULL,
    FOREIGN KEY (Sales_id) REFERENCES users (Id)
);

-- Insert data into the clients table
INSERT INTO clients (EmailAddress, FirstName, LastName, PhoneNumber, Sales_id)
VALUES ('t@g.ca', 'Sam', 'Tom', '(641)456-6091', 1002);

-- Select all records from the clients table
SELECT * FROM clients;
