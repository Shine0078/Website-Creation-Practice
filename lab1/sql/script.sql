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
