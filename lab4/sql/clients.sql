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
);

-- Insert data into the clients table
INSERT INTO clients (EmailAddress, FirstName, LastName, PhoneNumber, Extension, Sales_id, logo_path)
VALUES ('samuelabraham@gmail.com', 'John', 'Doe', '123-456-7890', 123, 1, '../images/download.jpeg');
INSERT INTO clients (EmailAddress, FirstName, LastName, PhoneNumber, Extension, Sales_id, logo_path)
VALUES ('robinroy@email.com', 'Robin', 'roy', '123-404-5079', 123, 8, '.images/download.jpeg');




-- Select all records from the clients table
SELECT * FROM clients;
