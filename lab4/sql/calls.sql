DROP SEQUENCE IF EXISTS call_id_seq CASCADE;

CREATE SEQUENCE call_id_seq START 100;
DROP TABLE IF EXISTS calls CASCADE;
CREATE TABLE calls(
    id INT PRIMARY KEY DEFAULT nextval('call_id_seq'),
    time_of_call TIMESTAMP, -- Add a comma here to separate column definitions
    client_id INT, -- Separate column definition for client_id
    notes VARCHAR(1024),
    FOREIGN KEY (client_id) REFERENCES clients (id)
);

INSERT INTO calls (time_of_call, notes, client_id) VALUES
('2021-09-07 06:23:00', 'first call', 5000);

SELECT * FROM calls;
