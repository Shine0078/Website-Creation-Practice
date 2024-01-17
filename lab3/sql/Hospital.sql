

-- Drop the dependent objects and then drop the 'Patient' table
DROP TABLE IF EXISTS Financial_Source,Physician,Physician_Patient_Report, Daily_Revenue_Report, Room_Utilization_Report, Revenue_Analysis, Patient_Bill;

-- Drop the 'Patient' table along with CASCADE option
DROP TABLE IF EXISTS Patient CASCADE;

CREATE TABLE Patient (
    Patient_No INT PRIMARY KEY,
    Patient_Name VARCHAR(100),
    Patient_Address VARCHAR(255),
    City_Prov_PC VARCHAR(50),
    Telephone VARCHAR(20),
    Sex VARCHAR(10),
    HCN VARCHAR(20),
    Extension VARCHAR(10),
    Date_Admitted DATE,
    Discharge_Date DATE
);

-- Creating the Financial_Source table
CREATE TABLE Financial_Source (
    Financial_Status VARCHAR(50) PRIMARY KEY,
    Source_Description VARCHAR(255)
);

-- Creating the Physician table
CREATE TABLE Physician (
    Physician_ID INT PRIMARY KEY,
    Physician_Name VARCHAR(100)
);

-- Creating the Physician_Patient_Report table
CREATE TABLE Physician_Patient_Report (
    Physician_Report_Date DATE PRIMARY KEY,
    Physician_ID INT,
    Patient_No INT,
    FOREIGN KEY (Physician_ID) REFERENCES Physician(Physician_ID),
    FOREIGN KEY (Patient_No) REFERENCES Patient(Patient_No)
);

-- Creating the Daily_Revenue_Report table
CREATE TABLE Daily_Revenue_Report (
    Revenue_Report_Date DATE PRIMARY KEY,
    Patient_No INT,
    Location VARCHAR(100),
    Financial_Status VARCHAR(50),
    Cost_Centre VARCHAR(50),
    Item_Code VARCHAR(50),
    Description VARCHAR(255),
    Charge DECIMAL(10, 2),
    Total DECIMAL(10, 2),
    FOREIGN KEY (Patient_No) REFERENCES Patient(Patient_No),
    FOREIGN KEY (Financial_Status) REFERENCES Financial_Source(Financial_Status)
);

-- Creating the Room_Utilization_Report table
CREATE TABLE Room_Utilization_Report (
    Room_Report_Date DATE,
    Location VARCHAR(100),
    Type VARCHAR(50),
    Patient_No INT,
    PRIMARY KEY (Room_Report_Date, Location, Patient_No),
    FOREIGN KEY (Patient_No) REFERENCES Patient(Patient_No)
);

-- Creating the Revenue_Analysis table
CREATE TABLE Revenue_Analysis (
    Cost_Centre_No INT PRIMARY KEY,
    Cost_Centre_Name VARCHAR(100),
    No_of_Transactions INT,
    Total_Charges DECIMAL(10, 2),
    Assure DECIMAL(10, 2),
    ESI DECIMAL(10, 2),
    Self_Pay DECIMAL(10, 2),
    Patient_No INT,
    FOREIGN KEY (Patient_No) REFERENCES Patient(Patient_No)
);

-- Creating the Patient_Bill table
CREATE TABLE Patient_Bill (
    Bill_No INT PRIMARY KEY,
    Patient_No INT,
    Date DATE,
    Charged_Item_Code VARCHAR(50),
    Description VARCHAR(255),
    Charge DECIMAL(10, 2),
    Balance_Due DECIMAL(10, 2),
    Financial_Status VARCHAR(50),
    FOREIGN KEY (Patient_No) REFERENCES Patient(Patient_No),
    FOREIGN KEY (Financial_Status) REFERENCES Financial_Source(Financial_Status)
);




INSERT INTO Patient (Patient_No, Patient_Name, Patient_Address, City_Prov_PC, Telephone, Sex,HCN,Extension, Date_Admitted, Discharge_Date) 
VALUES (1,'John Doe', '123 Main St','Oshawa, ON, L1L 0A7','456-555-5632','Male','123456789', '1234', '2023-11-23','2023-12-01'),
  (2, 'Jane Smith', '456 Oak St', 'Toronto, ON, M2M 2M2', '789-555-7890', 'Female', '987654321', '5678', '2023-11-24', '2023-12-05'),
  (3, 'Robert Johnson', '789 Pine St', 'Vancouver, BC, V1V 1V1', '321-555-4567', 'Male', '567890123', '4321', '2023-11-25', '2023-12-10'),
  (4, 'Emily Davis', '101 Elm St', 'Calgary, AB, T3T 3T3', '654-555-9876', 'Female', '345678901', '8765', '2023-11-26', '2023-12-15'),
  (5, 'Michael Chen', '202 Maple St', 'Montreal, QC, H1H 1H1', '987-555-1234', 'Male', '678901234', '9876', '2023-11-27', '2023-12-20'),
  (6, 'Thobias Tomy', '4895 Pleasure St', 'Alberts, GH, G4H G1G', '887-456-1285', 'Male', '328905834', '9006', '2023-10-27', '2023-12-20'),
  (7, 'Michael Chen', '202 Maple St', 'Montreal, QC, H1H 1H1', '987-555-1234', 'Male', '678901234', '9876', '2023-11-27', '2023-12-20'),
  (8, 'John Doe', '123 Elm St', 'Toronto, ON, M1M 1M1', '555-555-5555', 'Male', '123456789', '5678', '2023-11-28', '2023-12-21'),
  (9, 'Jane Smith', '456 Oak St', 'Vancouver, BC, V2V 2V2', '999-999-9999', 'Female', '987654321', '4321', '2023-11-29', '2023-12-22'),
  (10, 'John Johnson', '789 Birch St', 'Calgary, AB, T4T 4T4', '777-777-7777', 'Male', '876543210', '5432', '2023-11-30', '2023-12-23'),
  (11, 'Emily Thompson', '202 Cedar St', 'Montreal, QC, H2H 2H2', '555-123-4567', 'Female', '765432109', '6789', '2023-12-01', '2023-12-24'),
  (12, 'Michael Wilson', '303 Pine St', 'Ottawa, ON, K1K 1K1', '333-555-7890', 'Male', '543210987', '9876', '2023-12-02', '2023-12-25'),
  (13, 'Sophia Davis', '404 Spruce St', 'Edmonton, AB, T5T 5T5', '222-444-5678', 'Female', '432109876', '3456', '2023-12-03', '2023-12-26'),
  (14, 'William Brown', '505 Cedar St', 'Halifax, NS, B3B 3B3', '111-333-6789', 'Male', '321098765', '2345', '2023-12-04', '2023-12-27'),
  (15, 'Olivia Miller', '606 Birch St', 'Winnipeg, MB, R2R 2R2', '999-111-8901', 'Female', '210987654', '1234', '2023-12-05', '2023-12-28'),
  (16, 'Liam White', '707 Elm St', 'Victoria, BC, V9V 9V9', '888-222-9012', 'Male', '109876543', '5678', '2023-12-06', '2023-12-29');



INSERT INTO Financial_Source (Financial_Status, Source_Description)
VALUES ('Stable', 'Dual-income from both spouses working full-time'),
('Stable', 'Regular income from employment'),
('Unstable', 'Variable income from freelance work'),
('Pension', 'Pension and investment income'),
('Unstable', 'Part-time job and occasional freelancing'),
('Stable', 'Dual-income from both spouses working full-time'),
('Unstable', 'Income from rental properties and real estate investments'),
('Stable', 'Retirement benefits and annuities'),
('Unstable', 'Earnings from stock market investments'),
('Stable', 'Government pension and social security payments')
ON CONFLICT (Financial_Status) DO NOTHING;



SELECT *FROM Physician_Patient_Report;

INSERT INTO Physician (Physician_ID, Physician_Name)
VALUES (1, 'Dr. Smith'),
	   (2, 'Dr. Johnson'),
	   (3, 'Dr. Williams'),
	   (4, 'Dr. Davis'),
	   (5, 'Dr. Taylor'),
	   (6, 'Dr. Anderson'),
	   (7, 'Dr. Wilson'),
	   (8, 'Dr. Brown'),
	   (9, 'Dr. Miller'),
	   (10, 'Dr. Garcia'),
	   (11, 'Dr. Rodriguez'),
	   (12, 'Dr. Martinez'),
	   (13, 'Dr. Hernandez'),
	   (14, 'Dr. Jackson'),
	   (15, 'Dr. White'),
	   (16, 'Dr. Sona')
	   ON CONFLICT (Physician_ID) DO NOTHING;
	     

INSERT INTO Physician_Patient_Report (Physician_Report_Date, Physician_ID, Patient_No)
VALUES ('2023-11-23', 1, 1),
	('2023-11-24', 2, 2),
  ('2023-11-25', 3, 3),
  ('2023-11-26', 4, 4),
  ('2023-11-27', 5, 5),
  ('2023-11-28', 6, 6),
  ('2023-11-29', 7, 7),
  ('2023-11-30', 8, 8),
  ('2023-12-01', 9, 9),
  ('2023-12-02', 10, 10),
  ('2023-12-03', 11, 11),
  ('2023-12-04', 12, 12),
  ('2023-12-05', 13, 13),
  ('2023-12-06', 14, 14),
  ('2023-12-07', 15, 15),
  ('2023-12-08', 16, 16)
  ON CONFLICT (Physician_Report_Date) DO NOTHING;


INSERT INTO Daily_Revenue_Report (Revenue_Report_Date,Patient_No,Location,Financial_Status, Cost_Centre,Item_Code,Description, Charge, Total) 
VALUES ('2023-11-23',1,'Hospital A','Stable','CC001','ICU-001','Intensive Care Unit',500.00, 500.00),
	('2023-11-24', 2, 'Hospital B', 'Unstable', 'CC002', 'ICU-002', 'Intensive Care Unit', 600.00, 600.00),
  ('2023-11-25', 3, 'Hospital C', 'Stable', 'CC003', 'ICU-003', 'Intensive Care Unit', 700.00, 700.00),
  ('2023-11-26', 4, 'Hospital D', 'Unstable', 'CC004', 'ICU-004', 'Intensive Care Unit', 800.00, 800.00),
  ('2023-11-27', 5, 'Hospital E', 'Stable', 'CC005', 'ICU-005', 'Intensive Care Unit', 900.00, 900.00);

INSERT INTO Room_Utilization_Report (Room_Report_Date, Location, Type, Patient_No)
VALUES ('2023-11-23', 'Hospital A', 'ICU', 1),
	('2023-11-24', 'Hospital B', 'ICU', 2),
    ('2023-11-25', 'Hospital C', 'Emergency', 3),
    ('2023-11-26', 'Hospital D', 'Surgery', 4),
    ('2023-11-27', 'Hospital E', 'Radiology', 5),
    ('2023-11-28', 'Hospital F', 'ICU', 6),
    ('2023-11-29', 'Hospital G', 'Emergency', 7),
    ('2023-11-30', 'Hospital H', 'Surgery', 8),
    ('2023-12-01', 'Hospital I', 'Radiology', 9),
    ('2023-12-02', 'Hospital J', 'ICU', 10)
	ON CONFLICT (Room_Report_Date, Location, Patient_No) DO UPDATE
    SET Type = EXCLUDED.Type;


INSERT INTO Revenue_Analysis ( Cost_Centre_No,Cost_Centre_Name,No_of_Transactions,Total_Charges,Assure,ESI,Self_Pay,Patient_No)
VALUES (1,'Sample Cost Centre ',100,5000.00,1500.00,1200.00,2300.00,1),
(2,'Hospital Revenue',75,7000.50,1800.75,1500.25,2700.50,2),
(3,'Clinic Income',120,9500.25,2200.50,1800.00,3500.75,3),
(4,'Emergency Services',50,4000.75,1200.25,1000.50,1900.25,4),
(5,'Surgical Department',90,8000.00,2500.25,2000.75,4000.50,5),
(6,'Radiology Center',60,6000.50,1700.75,1400.25,2600.00,6),
(7, 'Outpatient Services', 80, 5500.25, 1600.50, 1300.25, 2400.00, 7),
(8, 'Laboratory Revenue', 110, 7200.75, 2000.25, 1800.50, 3400.75, 8),
(9, 'Pharmacy Income', 45, 3800.50, 1100.75, 900.25, 1600.00, 9),
(10, 'Maternity Services', 65, 6700.00, 2300.75, 1900.25, 3000.50, 10),
(11, 'Diagnostic Imaging', 95, 8900.25, 2700.50, 2200.75, 4200.00, 11);



INSERT INTO Patient_Bill (Bill_No, Patient_No, Date, Charged_Item_Code, Description, Charge, Balance_Due, Financial_Status)
 VALUES (1, 1, '2023-11-23', 'ICU-001',    'Intensive Care Unit Charge', 500.00, 500.00, 'Stable'),
	  (2, 2, '2023-11-24', 'ICU-002', 'Intensive Care Unit Charge', 600.00, 600.00, 'Unstable'),
	  (3, 3, '2023-11-25', 'ICU-003', 'Intensive Care Unit Charge', 700.00, 700.00, 'Stable'),
	  (4, 4, '2023-11-26', 'ICU-004', 'Intensive Care Unit Charge', 800.00, 800.00, 'Unstable'),
	  (5, 5, '2023-11-27', 'ICU-005', 'Intensive Care Unit Charge', 900.00, 900.00, 'Stable'),
	  (6, 6, '2023-11-28', 'ICU-006', 'Intensive Care Unit Charge', 1000.00, 1000.00, 'Unstable'),
	  (7, 7, '2023-11-29', 'Surgery-001', 'Surgery Charge', 1200.00, 1200.00, 'Stable'),
	  (8, 8, '2023-11-30', 'Radiology-001', 'Radiology Charge', 800.00, 800.00, 'Unstable'),
	  (9, 9, '2023-12-01', 'Lab-001', 'Laboratory Charge', 600.00, 600.00, 'Stable'),
	  (10, 10, '2023-12-02', 'Pharmacy-001', 'Pharmacy Charge', 500.00, 500.00, 'Unstable');





------For Patient Table-----

--1)Retrieve all patient names and addresses
SELECT Patient_Name, Patient_Address 
FROM Patient;

--2)List patients admitted after a specific date:
SELECT Patient_Name, Date_Admitted
FROM Patient
WHERE Date_Admitted > '2023-01-01';

--3)Show patients with their discharge dates (if discharged):
SELECT Patient_Name, Date_Admitted, Discharge_Date
FROM Patient
WHERE Discharge_Date IS NOT NULL;

--4)Count the number of male and female patients:
SELECT Sex, COUNT(*) AS Patient_Count
FROM Patient
GROUP BY Sex;

--5)Find patients with a specific Health Card Number (HCN):
SELECT Patient_Name, HCN
FROM Patient
WHERE HCN = '123456789';

--6)Retrieve patients from a specific city:
SELECT Patient_Name, City_Prov_PC
FROM Patient
WHERE City_Prov_PC LIKE 'CityName%';

--7)Show the total number of patients and the average length of stay:
SELECT COUNT(*) AS Total_Patients, AVG(EXTRACT(DAY FROM AGE(Discharge_Date, Date_Admitted))) AS Avg_Stay_Days

FROM Patient
WHERE Discharge_Date IS NOT NULL;


--------For "Financial_Source" table-----

--1)Retrieve all financial statuses and their descriptions:
SELECT Financial_Status, Source_Description
FROM Financial_Source;

--2)Find the description for a specific financial status:
SELECT Source_Description
FROM Financial_Source
WHERE Financial_Status = 'Stable';

--3)Count the number of distinct financial statuses:
SELECT COUNT(DISTINCT Financial_Status) AS Unique_Financial_Status_Count
FROM Financial_Source;

--4)List financial statuses starting with 'A':
SELECT Financial_Status
FROM Financial_Source
WHERE Financial_Status LIKE 'A%';

--5)Show the longest source description:
SELECT MAX(LENGTH(Source_Description)) AS Max_Description_Length

FROM Financial_Source;

--6)Display financial statuses and their descriptions in alphabetical order:
SELECT Financial_Status, Source_Description
FROM Financial_Source
ORDER BY Financial_Status ASC;

--7)Find the financial status with the most characters:
SELECT  Financial_Status
FROM Financial_Source
ORDER BY LENGTH(Financial_Status) DESC;

-----For "Physician" table

--1)Retrieve all physicians and their IDs:
SELECT Physician_ID, Physician_Name
FROM Physician;

--2)Find a physician by ID:
SELECT Physician_Name
FROM Physician
WHERE Physician_ID = 1;

--3)Count the total number of physicians:
SELECT COUNT(*) AS Total_Physicians
FROM Physician;


--4)List physicians with names starting with 'Dr.':
SELECT Physician_Name
FROM Physician
WHERE Physician_Name LIKE 'Dr%';

--5)Show the physician with the longest name:
SELECT  Physician_Name
FROM Physician
ORDER BY LENGTH(Physician_Name) DESC;


--6)Display physicians in alphabetical order:
SELECT Physician_ID, Physician_Name
FROM Physician
ORDER BY Physician_Name ASC;

--7)Find the physician with the shortest name:
SELECT  Physician_Name
FROM Physician
ORDER BY LENGTH(Physician_Name) ASC;

-----For "Physician_Patient_Report" table

--1)Retrieve all physician-patient reports with associated physician and patient details:
SELECT r.Physician_Report_Date, p.Patient_Name, ph.Physician_Name
FROM Physician_Patient_Report r
JOIN Patient p ON r.Patient_No = p.Patient_No
JOIN Physician ph ON r.Physician_ID = ph.Physician_ID;

--2)Find reports for a specific physician:
SELECT r.Physician_Report_Date, p.Patient_Name
FROM Physician_Patient_Report r
JOIN Patient p ON r.Patient_No = p.Patient_No
WHERE r.Physician_ID = 1;


--3)Count the total number of reports:
SELECT COUNT(*) AS Total_Reports
FROM Physician_Patient_Report;

--4)List reports with the earliest physician report date:
SELECT  r.Physician_Report_Date, p.Patient_Name
FROM Physician_Patient_Report r
JOIN Patient p ON r.Patient_No = p.Patient_No
ORDER BY r.Physician_Report_Date ASC;


--5)Display reports for patients admitted after a specific date:
SELECT r.Physician_Report_Date, p.Patient_Name
FROM Physician_Patient_Report r
JOIN Patient p ON r.Patient_No = p.Patient_No
WHERE p.Date_Admitted > '2023-01-01';

--6)Show reports with patients who have been discharged:
SELECT r.Physician_Report_Date, p.Patient_Name
FROM Physician_Patient_Report r
JOIN Patient p ON r.Patient_No = p.Patient_No
WHERE p.Discharge_Date IS NOT NULL;

--7)Find reports with patients who have a specific health card number (HCN):
SELECT r.Physician_Report_Date, p.Patient_Name
FROM Physician_Patient_Report r
JOIN Patient p ON r.Patient_No = p.Patient_No
WHERE p.HCN = '123456789';


-----For "Daily_Revenue_Report" table

--1)Retrieve all daily revenue reports with patient and financial information:
SELECT d.Revenue_Report_Date, p.Patient_Name, d.Location, d.Financial_Status, d.Charge, d.Total
FROM Daily_Revenue_Report d
JOIN Patient p ON d.Patient_No = p.Patient_No;


--2)Find reports with charges greater than a specific amount:
SELECT d.Revenue_Report_Date, p.Patient_Name, d.Charge
FROM Daily_Revenue_Report d
JOIN Patient p ON d.Patient_No = p.Patient_No
WHERE d.Charge > 1000.00;

--3)Count the total number of reports for each location:
SELECT Location, COUNT(*) AS Report_Count
FROM Daily_Revenue_Report
GROUP BY Location;

--4)List reports with a specific financial status:
SELECT d.Revenue_Report_Date, p.Patient_Name, d.Financial_Status
FROM Daily_Revenue_Report d
JOIN Patient p ON d.Patient_No = p.Patient_No
WHERE d.Financial_Status = 'Stable';


--5)Display reports for a specific cost centre:
SELECT d.Revenue_Report_Date, p.Patient_Name, d.Cost_Centre
FROM Daily_Revenue_Report d
JOIN Patient p ON d.Patient_No = p.Patient_No
WHERE d.Cost_Centre = 'CC001';

--6)Show reports with the highest total charge:
SELECT d.Revenue_Report_Date, p.Patient_Name, d.Total
FROM Daily_Revenue_Report d
JOIN Patient p ON d.Patient_No = p.Patient_No
ORDER BY d.Total DESC;

--7)Find reports with patients admitted after a specific date:
SELECT d.Revenue_Report_Date, p.Patient_Name
FROM Daily_Revenue_Report d
JOIN Patient p ON d.Patient_No = p.Patient_No
WHERE p.Date_Admitted > '2023-01-01';


-----For "Room_Utilization_Report" table

--1)Retrieve all room utilization reports with patient details:
SELECT r.Room_Report_Date, r.Location, r.Type, p.Patient_Name
FROM Room_Utilization_Report r
JOIN Patient p ON r.Patient_No = p.Patient_No;

--2)Find reports for a specific location:
SELECT r.Room_Report_Date, r.Type, p.Patient_Name
FROM Room_Utilization_Report r
JOIN Patient p ON r.Patient_No = p.Patient_No
WHERE r.Location = 'Hospital A';

--3)Count the total number of reports for each room type:
SELECT Type, COUNT(*) AS Report_Count
FROM Room_Utilization_Report
GROUP BY Type;

--4)List reports with patients admitted after a specific date:
SELECT r.Room_Report_Date, r.Location, r.Type, p.Patient_Name
FROM Room_Utilization_Report r
JOIN Patient p ON r.Patient_No = p.Patient_No
WHERE p.Date_Admitted > '2023-01-01';

--5)Display reports for a specific patient:
SELECT r.Room_Report_Date, r.Location, r.Type
FROM Room_Utilization_Report r
WHERE r.Patient_No = 1;


--6)Show reports with the earliest room report date:
SELECT r.Room_Report_Date, r.Location, r.Type
FROM Room_Utilization_Report r
ORDER BY r.Room_Report_Date ASC;

--7)Find reports with patients who have been discharged:
SELECT r.Room_Report_Date, r.Location, r.Type, p.Patient_Name
FROM Room_Utilization_Report r
JOIN Patient p ON r.Patient_No = p.Patient_No
WHERE p.Discharge_Date IS NOT NULL;


-----For "Revenue_Analysis" table

--1)Retrieve all revenue analysis data with patient details:
SELECT r.Cost_Centre_No, r.Cost_Centre_Name, r.No_of_Transactions, r.Total_Charges,
       r.Assure, r.ESI, r.Self_Pay, p.Patient_Name
FROM Revenue_Analysis r
JOIN Patient p ON r.Patient_No = p.Patient_No;

--2)Find revenue analysis data for a specific patient:
SELECT r.Cost_Centre_No, r.Cost_Centre_Name, r.No_of_Transactions, r.Total_Charges,
       r.Assure, r.ESI, r.Self_Pay
FROM Revenue_Analysis r
WHERE r.Patient_No = 1;

--3)Count the total number of transactions for each cost center:
SELECT Cost_Centre_No, Cost_Centre_Name, SUM(No_of_Transactions) AS Total_Transactions
FROM Revenue_Analysis
GROUP BY Cost_Centre_No, Cost_Centre_Name;

--4)List cost centers with the highest total charges:
SELECT Cost_Centre_No, Cost_Centre_Name, Total_Charges
FROM Revenue_Analysis
ORDER BY Total_Charges DESC;

--5)Display total charges and payment breakdown for a specific cost center:
SELECT Cost_Centre_No, Cost_Centre_Name, Total_Charges, Assure, ESI, Self_Pay
FROM Revenue_Analysis
WHERE Cost_Centre_No = 101;

--6)Show cost centers with the highest number of transactions:
SELECT  Cost_Centre_No, Cost_Centre_Name, No_of_Transactions
FROM Revenue_Analysis
ORDER BY No_of_Transactions DESC;


-----For "Patient_Bill" table

--1)Retrieve all patient bills with patient details:
SELECT b.Bill_No, b.Date, p.Patient_Name, b.Charged_Item_Code, b.Description, b.Charge, b.Balance_Due, b.Financial_Status
FROM Patient_Bill b
JOIN Patient p ON b.Patient_No = p.Patient_No;

--2)Find bills for a specific patient:
SELECT b.Bill_No, b.Date, b.Charged_Item_Code, b.Description, b.Charge, b.Balance_Due, b.Financial_Status
FROM Patient_Bill b
WHERE b.Patient_No = 1;

--3)Count the total number of bills for each financial status:
SELECT Financial_Status, COUNT(*) AS Total_Bills
FROM Patient_Bill
GROUP BY Financial_Status;

--4)List bills with a specific charged item code:
SELECT b.Bill_No, b.Date, p.Patient_Name, b.Charged_Item_Code, b.Description, b.Charge, b.Balance_Due, b.Financial_Status
FROM Patient_Bill b
JOIN Patient p ON b.Patient_No = p.Patient_No
WHERE b.Charged_Item_Code = 'ICU-001';

--5)Display bills with the highest balance due:
SELECT  b.Bill_No, b.Date, p.Patient_Name, b.Charged_Item_Code, b.Description, b.Charge, b.Balance_Due, b.Financial_Status
FROM Patient_Bill b
JOIN Patient p ON b.Patient_No = p.Patient_No
ORDER BY b.Balance_Due DESC;

--6)Show bills with a specific financial status:
SELECT b.Bill_No, b.Date, p.Patient_Name, b.Charged_Item_Code, b.Description, b.Charge, b.Balance_Due
FROM Patient_Bill b
JOIN Patient p ON b.Patient_No = p.Patient_No
WHERE b.Financial_Status = 'Stable';

--7)Find bills for patients admitted after a specific date:
SELECT b.Bill_No, b.Date, p.Patient_Name, b.Charged_Item_Code, b.Description, b.Charge, b.Balance_Due, b.Financial_Status
FROM Patient_Bill b
JOIN Patient p ON b.Patient_No = p.Patient_No
WHERE p.Date_Admitted > '2023-01-01';

------For Patient Table-----

--1)Retrieve all patient names and addresses
SELECT Patient_Name, Patient_Address 
FROM Patient;

--2)List patients admitted after a specific date:
SELECT Patient_Name, Date_Admitted
FROM Patient
WHERE Date_Admitted > '2023-01-01';

--3)Show patients with their discharge dates (if discharged):
SELECT Patient_Name, Date_Admitted, Discharge_Date
FROM Patient
WHERE Discharge_Date IS NOT NULL;

--4)Count the number of male and female patients:
SELECT Sex, COUNT(*) AS Patient_Count
FROM Patient
GROUP BY Sex;

--5)Find patients with a specific Health Card Number (HCN):
SELECT Patient_Name, HCN
FROM Patient
WHERE HCN = '678901234';

--6)Retrieve patients from a specific city:
SELECT Patient_Name, City_Prov_PC
FROM Patient 
WHERE City_Prov_PC LIKE 'Oshawa%' OR City_Prov_PC LIKE 'Toronto%';



--7)Show the total number of patients and the average length of stay:
SELECT COUNT(*) AS Total_Patients, AVG(EXTRACT(EPOCH FROM AGE(Discharge_Date, Date_Admitted)) / 86400) AS Avg_Stay_Days
FROM Patient
WHERE Discharge_Date IS NOT NULL;


--------For "Financial_Source" table-----

--1)Retrieve all financial statuses and their descriptions:
SELECT Financial_Status, Source_Description
FROM Financial_Source;

--2)Find the description for a specific financial status:
SELECT Source_Description
FROM Financial_Source
WHERE Financial_Status = 'Stable';

--3)Count the number of distinct financial statuses:
SELECT COUNT(DISTINCT Financial_Status) AS Unique_Financial_Status_Count
FROM Financial_Source;

--4)List financial statuses starting with 'A':
SELECT Financial_Status
FROM Financial_Source
WHERE Financial_Status LIKE 'S%';

--5)Show the longest source description:
SELECT MAX(LENGTH(Source_Description)) AS Max_Description_Length
FROM Financial_Source;

--6)Display financial statuses and their descriptions in alphabetical order:
SELECT Financial_Status, Source_Description
FROM Financial_Source
ORDER BY Financial_Status ASC;

--7)Find the financial status with the most characters:
SELECT  Financial_Status
FROM Financial_Source
ORDER BY LENGTH(Financial_Status) DESC;
