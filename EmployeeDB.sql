CREATE DATABASE employeeDB;

USE employeeDB;



CREATE TABLE Attendance (
    AttendanceID INT  AUTO_INCREMENT,
    EmployeeID INT,
    Date DATE NOT NULL,
    CheckIn TIME,
    CheckOut TIME,
    Status ENUM('Present', 'Absent', 'Late', 'On Leave') DEFAULT 'Absent',
    PRIMARY KEY(AttendanceID,EmployeeID,DATE)
);

DELIMITER $$

CREATE TRIGGER before_insert_attendance
BEFORE INSERT ON Attendance
FOR EACH ROW
BEGIN
    IF NEW.CheckIn IS NULL THEN
        SET NEW.Status = 'Absent';
    ELSEIF NEW.CheckIn <= '10:00:00' THEN
        SET NEW.Status = 'Present';
    ELSE
        SET NEW.Status = 'Late';
    END IF;
END $$


CREATE EVENT MarkAbsentEmployees
ON SCHEDULE EVERY 1 DAY
STARTS TIMESTAMP(CURRENT_DATE, '23:59:59')
DO
BEGIN
    UPDATE Attendance 
    SET Status = 'Absent' 
    WHERE Date = CURDATE() AND CheckIn IS NULL;
END $$

DELIMITER ;
