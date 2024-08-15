<?php
class UserClass
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function fetchUsers()
    {
        $sql = "SELECT `user_id`, `firstName`, `lastName`, `email`, `password`, `user_type`, `created_at`, `loggedinAt` FROM `user` ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    function getUserById($userId)
    {
        $sql = "SELECT `user_id`, `firstName`, `lastName`, `email`, `password`, `user_type` FROM `user` WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    public function editUser($firstName, $lastName, $email, $password, $userId, $profilePicture = null)
    {
        // Prepare the SQL statement to update the user's profile data
        $stmt = $this->conn->prepare("UPDATE user SET firstName = ?, lastName = ?, email = ?, password = ? WHERE user_id = ?");
        $stmt->bind_param("ssssi", $firstName, $lastName, $email, $password, $userId);

        // Execute the query
        if ($stmt->execute()) {
            // If a new profile picture was uploaded, update the profile picture
            if ($profilePicture !== null) {
                $stmt = $this->conn->prepare("UPDATE user SET profile_picture = ? WHERE user_id = ?");
                $stmt->bind_param("si", $profilePicture, $userId);
                $stmt->execute();
            }
            return true;
        } else {
            return false;
        }
    }

    public function getUserPassword($userId)
    {
        $password = "";
        $stmt = $this->conn->prepare("SELECT password FROM user WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            $stmt->bind_result($password);
            if ($stmt->fetch()) {
                return $password;
            }
        }

        return '';
    }
    function deleteUser($userId)
    {
        $sql = "DELETE FROM `user` WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            $stmt->close();
            return true; // Success
        } else {
            $stmt->close();
            return false; // Failed to delete
        }
    }
    function addUserLog($userId, $firstName, $lastName, $time, $departmentOffice, $reason)
    {
        $sql = "INSERT INTO userLogs (user_id, First_Name, Last_Name, Time, Department_Office, Reason) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $userId, $firstName, $lastName, $time, $departmentOffice, $reason);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    function fetchUserLogs()
    {
        $sql = "SELECT `log_id`, `user_id`, `First_Name`, `Last_Name`, `Time`, `Department_Office`, `Reason` FROM `userLogs`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function getUserLogById($userId)
    {
        $sql = "SELECT `user_id`, `First_Name`, `Last_Name`, `Time`, `Department_Office`, `Reason`, FROM `userLogs` WHERE `user_id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
}

class StudentClass
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function fetchStudents()
    {
        $sql = "SELECT `StudentID`, `idno`, `FirstName`, `MiddleInitial`, `LastName`, `Suffix`, `Gender`, `Address_Street`, `Address_City`, `Address_State`, 
                `ContactNumber`, `Birthday`, `Education`, `Grade`, `Year`, `Course`, `MedicalHistory`, `EmergencyContactName`, 
                `EmergencyContactNumber` 
                FROM `students`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    function countStudents()
    {
        $sql = "SELECT COUNT(*) AS totalStudents FROM students";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $totalStudents = $row['totalStudents'];
        $stmt->close();
        return $totalStudents;
    }

    function getStudentById($studentId)
    {
        $sql = "SELECT `StudentID`, `idno`, `FirstName`, `MiddleInitial`, `LastName`, `Suffix`, `Gender`, `Address_Street`, `Address_City`, `Address_State`,  
                `ContactNumber`, `Birthday`, `Education`, `Grade`, `Year`, `Course`, `MedicalHistory`, `EmergencyContactName`, 
                `EmergencyContactNumber` 
                FROM `students` WHERE idno = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $studentId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    function editStudent(
        $idno,
        $firstName,
        $middleInitial,
        $lastName,
        $suffix,
        $gender,
        $addressStreet,
        $addressCity,
        $addressState,
        $contactNumber,
        $birthday,
        $education,
        $grade,
        $year,
        $course,
        $medicalHistory,
        $emergencyContactName,
        $emergencyContactNumber,
        $studentId
    ) {
        $sql = "UPDATE `students` SET `idno` = ?, `FirstName` = ?, `MiddleInitial` = ?, `LastName` = ?, `Suffix` = ?, `Gender` = ?, `Address_Street` = ?, `Address_City` = ?, `Address_State` = ?, `ContactNumber` = ?, `Birthday` = ?, `Education` = ?, `Grade` = ?, `Year` = ?, `Course` = ?, `MedicalHistory` = ?, `EmergencyContactName` = ?, `EmergencyContactNumber` = ? WHERE `idno` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssssssssssssi",
            $idno,
            $firstName,
            $middleInitial,
            $lastName,
            $suffix,
            $gender,
            $addressStreet,
            $addressCity,
            $addressState,
            $contactNumber,
            $birthday,
            $education,
            $grade,
            $year,
            $course,
            $medicalHistory,
            $emergencyContactName,
            $emergencyContactNumber,
            $idno
        );

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Success
        } else {
            $stmt->close();
            return false; // Error
        }
    }

    // Function to check if a student already exists
    function getExistingStudent($firstName, $lastName, $contactNumber, $birthday, $idno)
    {
        $sql = "SELECT * FROM `students` WHERE `FirstName` = ? AND `LastName` = ? AND `ContactNumber` = ? AND `Birthday` = ? AND `idno` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $firstName, $lastName, $contactNumber, $birthday, $idno);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    function getExistingId($idno)
    {
        $sql = "SELECT * FROM `students` WHERE `idno` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $idno);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }
    public function insertMedicalHistory($student_id,$type, $doctor, $remarks, $date)
    {
        $insert_query = "INSERT INTO medicalhistory (studentId, type, doctor, remarks, date) VALUES (?,?, ?, ?, ?)";
        try {
            $stmt = $this->conn->prepare($insert_query);
            $stmt->bind_param("sssss",$student_id, $type, $doctor, $remarks, $date);
            $result = $stmt->execute();
            if (!$result) {
                throw new Exception("Failed to insert medical history data.");
            }
            $stmt->close();
            return true;
        } catch (Exception $e) {
            // Handle exception (e.g., log error)
            error_log($e->getMessage());
            return false;
        }
    }
    function fetchMedicalHistory($studentId)
    {
        $sql = "SELECT `studentId`, `type`, `doctor`, `remarks`, `date` FROM `medicalhistory` WHERE `studentId` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    function addStudent(
        $idno,
        $firstName,
        $middleInitial,
        $lastName,
        $suffix,
        $gender,
        $addressStreet,
        $addressCity,
        $addressState,
        $contactNumber,
        $birthday,
        $education,
        $grade,
        $year,
        $course,
        $medicalHistory,
        $emergencyContactName,
        $emergencyContactNumber
    ) {
        $sql = "INSERT INTO `students` (`idno`, `FirstName`, `MiddleInitial`, `LastName`, `Suffix`, `Gender`, `Address_Street`, `Address_City`, `Address_State`, 
                `ContactNumber`, `Birthday`, `Education`, `Grade`, `Year`, `Course`,  `MedicalHistory`, `EmergencyContactName`, 
                `EmergencyContactNumber`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssssssssssss",
            $idno,
            $firstName,
            $middleInitial,
            $lastName,
            $suffix,
            $gender,
            $addressStreet,
            $addressCity,
            $addressState,
            $contactNumber,
            $birthday,
            $education,
            $grade,
            $year,
            $course,
            $medicalHistory,
            $emergencyContactName,
            $emergencyContactNumber
        );
        if ($stmt->execute()) {
            $stmt->close();
            return true; // Success
        } else {
            $stmt->close();
            return false; // Error
        }
    }

    function deleteStudent($studentId)
    {
        // First, select the student's information
        $selectSql = "SELECT * FROM `students` WHERE `idno` = ?";
        $selectStmt = $this->conn->prepare($selectSql);
        $selectStmt->bind_param("i", $studentId);
        $selectStmt->execute();
        $result = $selectStmt->get_result();

        // If the student exists, move it to the archive
        if ($result->num_rows > 0) {
            $studentData = $result->fetch_assoc();

            // Insert student data into archiveStudents table
            $insertSql = "INSERT INTO `archivedstudents` (`idno`, `FirstName`, `MiddleInitial`, `LastName`, `Suffix`, `Gender`, `Address_Street`, `Address_City`, `Address_State`, 
        `ContactNumber`, `Birthday`, `Education`, `Grade`, `Year`, `Course`,  `MedicalHistory`, `EmergencyContactName`, 
        `EmergencyContactNumber`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $this->conn->prepare($insertSql);
            $insertStmt->bind_param(
                "ssssssssssssssssss",
                $studentData['idno'],
                $studentData['FirstName'],
                $studentData['MiddleInitial'],
                $studentData['LastName'],
                $studentData['Suffix'],
                $studentData['Gender'],
                $studentData['Address_Street'],
                $studentData['Address_City'],
                $studentData['Address_State'],
                $studentData['ContactNumber'],
                $studentData['Birthday'],
                $studentData['Education'],
                $studentData['Grade'],
                $studentData['Year'],
                $studentData['Course'],
                $studentData['MedicalHistory'],
                $studentData['EmergencyContactName'],
                $studentData['EmergencyContactNumber']
            );
            $insertStmt->execute();

            // Check if insertion was successful
            if ($insertStmt->affected_rows > 0) {
                // Now, delete the student from the students table
                $deleteSql = "DELETE FROM `students` WHERE `idno` = ?";
                $deleteStmt = $this->conn->prepare($deleteSql);
                $deleteStmt->bind_param("i", $studentId);
                $deleteStmt->execute();

                // Check if deletion was successful
                if ($deleteStmt->affected_rows > 0) {
                    $deleteStmt->close();
                    $insertStmt->close();
                    $selectStmt->close();
                    return true; // Success
                }
            }
        }

        // Close statements and return false if any step fails
        $selectStmt->close();
        return false; // Error
    }
}


class MedicineClass
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllMedicines()
    {
        $sql = "SELECT *, DATE_FORMAT(medicines.ExpirationDate, '%M %e, %Y') AS FormattedExpirationDate FROM medicines";
        $result = $this->conn->query($sql);

        $medicines = array();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $medicines[] = $row;
            }
        }

        return $medicines;
    }

    public function getMedicineDetails($medicineID)
    {
        $sql = "SELECT * FROM medicines WHERE MedicineID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $medicineID);
        $stmt->execute();
        $result = $stmt->get_result();
        $medicineDetails = $result->fetch_assoc();
        $stmt->close();
        return $medicineDetails;
    }

    public function addMedicine($medicine, $dosage, $quantity, $expirationDate)
    {
        $sql = "INSERT INTO medicines (Medicine, Dosage, Quantity, ExpirationDate) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssis", $medicine, $dosage, $quantity, $expirationDate);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function editMedicine($medicineID, $medicine, $dosage, $quantity, $expirationDate)
    {
        $sql = "UPDATE medicines SET Medicine = ?, Dosage = ?, Quantity = ?, ExpirationDate = ? WHERE MedicineID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssisi", $medicine, $dosage, $quantity, $expirationDate, $medicineID);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function editMedicinebyLogs($medicineID, $quantity)
    {
        $sql = "UPDATE medicines SET Quantity = ? WHERE MedicineID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $quantity, $medicineID);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function deleteMedicine($medicineID)
    {
        $sql = "DELETE FROM medicines WHERE MedicineID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $medicineID);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    function getTotalMedicineQuantity()
    {
        $totalQuantity = 0;
        $sql = "SELECT Quantity FROM medicines";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $totalQuantity += $row['Quantity'];
        };
        $stmt->close();
        return $totalQuantity;
    }



    public function getExpiredMedicineCount()
    {
        $currentDate = date('d-m-Y');
        $sql = "SELECT COUNT(*) AS ExpiredCount FROM medicines WHERE ExpirationDate < ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $currentDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $expiredCount = $row['ExpiredCount'];
        $stmt->close();
        return $expiredCount;
    }

    public function addMedicineLog($medicineName, $time, $recipient, $quantity, $dosage, $reason)
    {
        // Assuming $conn is the database connection object

        $sql = "INSERT INTO medicine_logs (medicine_name, recipient_name, timeLogged , quantity, dosage,  reason) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Check if the statement is prepared successfully
        if (!$stmt) {
            return false;
        }

        // Bind parameters
        $stmt->bind_param("sssiss", $medicineName, $recipient, $time, $quantity, $dosage, $reason);

        // Execute the statement
        $success = $stmt->execute();

        // Close the statement
        $stmt->close();

        return $success;
    }

    public function getAllMedicineLogs()
    {
        // Assuming $conn is the database connection object

        $sql = "SELECT * FROM medicine_logs";
        $result = $this->conn->query($sql);

        $medicineLogs = array();

        // Check if query was successful and if there are any rows returned
        if ($result && $result->num_rows > 0) {
            // Loop through each row and fetch medicine logs
            while ($row = $result->fetch_assoc()) {
                $medicineLogs[] = $row;
            }
        }

        return $medicineLogs;
    }
}


class EquipmentClass
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create a new equipment record
    public function createEquipment($equipmentName, $remark, $status)
    {
        $query = "INSERT INTO Equipment (EquipmentName, Remark, Status) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $equipmentName, $remark, $status);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllEquipment()
    {
        $sql = "SELECT * FROM Equipment";
        $result = $this->conn->query($sql);

        $medicines = array();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $medicines[] = $row;
            }
        }

        return $medicines;
    }

    function getTotalEquipment()
    {
        $sql = "SELECT COUNT(*) AS TotalQuantity FROM Equipment";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $totalStudents = $row['TotalQuantity'];
        $stmt->close();
        return $totalStudents;
    }


    // Count the total number of equipment records
    public function countEquipment()
    {
        $sql = "SELECT COUNT(*) AS totalEquipment FROM Equipment";
        $result = $this->conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['totalEquipment'];
        } else {
            return 0; // Return 0 if there is an error or no records found
        }
    }
    // Read a specific equipment record by ID
    public function getEquipmentById($equipmentId)
    {
        $query = "SELECT * FROM Equipment WHERE EquipmentID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $equipmentId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update an existing equipment record
    public function updateEquipment($equipmentId, $equipmentName, $remark, $status)
    {
        $query = "UPDATE Equipment SET EquipmentName = ?, Remark = ?, Status = ? WHERE EquipmentID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $equipmentName, $remark, $status, $equipmentId);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete an existing equipment record
    public function deleteEquipment($equipmentId)
    {
        $query = "DELETE FROM Equipment WHERE EquipmentID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $equipmentId);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
class IsolationClass
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create a new equipment record
    public function createEquipment($equipmentName, $remark, $status)
    {
        $query = "INSERT INTO isolation (EquipmentName, Remark, ExpiryDate) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $equipmentName, $remark, $status);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllEquipment()
    {
        $sql = "SELECT * FROM isolation";
        $result = $this->conn->query($sql);

        $medicines = array();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $medicines[] = $row;
            }
        }

        return $medicines;
    }

    // Read a specific equipment record by ID
    public function getEquipmentById($equipmentId)
    {
        $query = "SELECT * FROM isolation WHERE EquipmentID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $equipmentId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update an existing equipment record
    public function updateEquipment($equipmentId, $equipmentName, $remark, $status)
    {
        $query = "UPDATE isolation SET EquipmentName = ?, Remark = ?, ExpiryDate = ? WHERE EquipmentID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $equipmentName, $remark, $status, $equipmentId);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete an existing equipment record
    public function deleteEquipment($equipmentId)
    {
        $query = "DELETE FROM isolation WHERE EquipmentID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $equipmentId);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function countEquipmentIsolation()
    {
        $query = "SELECT COUNT(*) AS total FROM isolation";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // Count the number of expired equipment in all first aid kits
    public function countExpiredEquipmentIsolation()
    {
        $currentDate = date('Y-m-d');
        $query = "SELECT COUNT(*) AS total FROM isolation WHERE ExpiryDate < ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $currentDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}

class PhysicalExamHandler
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertPhysicalExam($studentId, $blood_pressure, $height, $weight, $remarks, $physicianName)
    {
        $insert_query = "INSERT INTO physical_exam (student_id, blood_pressure, height, weight, remarks, doctor) VALUES (?, ?, ?, ?, ?,?)";
        try {
            $stmt = $this->conn->prepare($insert_query);
            $stmt->bind_param("ssssss", $studentId, $blood_pressure, $height, $weight, $remarks, $physicianName);
            $result = $stmt->execute();
            if (!$result) {
                throw new Exception("Failed to insert physical exam data.");
            }
            $physical_exam_id = $this->conn->insert_id;
            $stmt->close();
            return $physical_exam_id;
        } catch (Exception $e) {
            // Handle exception (e.g., log error)
            error_log($e->getMessage());
            return false;
        }
    }

    public function insertBodyPartExam($physical_exam_id, $body_part, $normal, $abnormal, $comments)
    {
        $insert_query = "INSERT INTO BodyPartExam (physical_exam_id, body_part, normal, abnormal, comments) VALUES (?, ?, ?, ?, ?)";
        try {
            $stmt = $this->conn->prepare($insert_query);
            $stmt->bind_param("issss", $physical_exam_id, $body_part, $normal, $abnormal, $comments);
            $result = $stmt->execute();
            if (!$result) {
                throw new Exception("Failed to insert body part exam data.");
            }
            $stmt->close();
            return true;
        } catch (Exception $e) {
            // Handle exception (e.g., log error)
            error_log($e->getMessage());
            return false;
        }
    }

    


    public function getPhysicalExamDetails($studentId)
    {
        $query = "SELECT s.FirstName, s.LastName, s.Gender, s.Address_Street, s.Address_City, s.Address_State, s.ContactNumber, s.Birthday, s.Education, s.Grade, s.Year, s.Course, 
                         pe.created_at, pe.blood_pressure, pe.height, pe.weight, pe.remarks
                  FROM PhysicalExam pe
                  INNER JOIN Students s ON pe.student_id = s.id
                  WHERE s.id = ?";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $studentId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $physicalExamDetails = array(
                    'created_at' => $row['created_at'],
                    'student_name' => $row['FirstName'] . ' ' . $row['LastName'],
                    'gender' => $row['Gender'],
                    'address_street' => $row['Address_Street'],
                    'address_city' => $row['Address_City'],
                    'address_state' => $row['Address_State'],
                    'contact_number' => $row['ContactNumber'],
                    'birthday' => $row['Birthday'],
                    'education' => $row['Education'],
                    'grade' => $row['Grade'],
                    'year' => $row['Year'],
                    'course' => $row['Course'],
                    'blood_pressure' => $row['blood_pressure'],
                    'height' => $row['height'],
                    'weight' => $row['weight'],
                    'remarks' => $row['remarks']
                );

                // Fetch body part exams
                $bodyPartsQuery = "SELECT body_part, normal, abnormal, comments
                                   FROM BodyPartExam 
                                   WHERE physical_exam_id = (SELECT physical_exam_id FROM PhysicalExam WHERE student_id = ?)";
                $bodyPartsStmt = $this->conn->prepare($bodyPartsQuery);
                $bodyPartsStmt->bind_param("i", $studentId);
                $bodyPartsStmt->execute();
                $bodyPartsResult = $bodyPartsStmt->get_result();

                $bodyParts = array();
                while ($bodyPartRow = $bodyPartsResult->fetch_assoc()) {
                    $bodyParts[] = $bodyPartRow;
                }

                $physicalExamDetails['body_parts'] = $bodyParts;
                return $physicalExamDetails;
            } else {
                return null;
            }
        } catch (Exception $e) {
            // Handle exception (e.g., log error)
            error_log($e->getMessage());
            return null;
        }
    }

    public function getPhysicalExamRecords()
    {
        $query = "SELECT pe.physical_exam_id, CONCAT(s.FirstName, ' ', s.LastName) AS student_name
                  FROM PhysicalExam pe
                  JOIN Students s ON pe.student_id = s.id";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            $records = array();
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }

            return $records;
        } catch (Exception $e) {
            // Handle exception (e.g., log error)
            error_log($e->getMessage());
            return array();
        }
    }
}

class MasterListClass
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create a new record
    public function createRecord($noIdNo, $firstname, $lastname, $sex, $course, $year, $unit)
    {
        $query = "INSERT INTO masterList (NoIdNo, Firstname, Lastname, Sex, Course, Year, Unit) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssss", $noIdNo, $firstname, $lastname, $sex, $course, $year, $unit);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllRecords()
    {
        $sql = "SELECT * FROM masterList";
        $result = $this->conn->query($sql);
        $records = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
        }
        return $records;
    }

    // Read a specific record by ID
    public function getRecordById($id)
    {
        $query = "SELECT * FROM masterList WHERE ID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update an existing record
    public function updateRecord($id, $noIdNo, $firstname, $lastname, $sex, $course, $year, $unit)
    {
        $query = "UPDATE masterList SET NoIdNo = ?, Firstname = ?, Lastname = ?, Sex = ?, Course = ?, Year = ?, Unit = ? WHERE ID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssssi", $noIdNo, $firstname, $lastname, $sex, $course, $year, $unit, $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete an existing record
    public function deleteRecord($id)
    {
        $query = "DELETE FROM masterList WHERE ID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

class FirstAidKitClass
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Create a new first aid kit record
    public function createFirstAidKit($name, $remark, $expiryDate)
    {
        $query = "INSERT INTO FirstAidKits (Name, Remark, ExpiryDate) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $name, $remark, $expiryDate);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Read all first aid kits
    public function getAllFirstAidKits()
    {
        $query = "SELECT * FROM FirstAidKits";
        $result = $this->conn->query($query);

        $kits = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kits[] = $row;
            }
        }
        return $kits;
    }

    // Read a specific first aid kit by ID
    public function getFirstAidKitById($firstAidKitId)
    {
        $query = "SELECT * FROM FirstAidKits WHERE FirstAidKitID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $firstAidKitId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update an existing first aid kit record
    public function updateFirstAidKit($firstAidKitId, $name, $remark, $expiryDate)
    {
        $query = "UPDATE FirstAidKits SET Name = ?, Remark = ?, ExpiryDate = ? WHERE FirstAidKitID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $name, $remark, $expiryDate, $firstAidKitId);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete an existing first aid kit record
    public function deleteFirstAidKit($firstAidKitId)
    {
        $query = "DELETE FROM FirstAidKits WHERE FirstAidKitID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $firstAidKitId);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function countEquipmentInFirstAidKit()
    {
        $query = "SELECT COUNT(*) AS total FROM FirstAidKits";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // Count the number of expired equipment in all first aid kits
    public function countExpiredEquipmentInFirstAidKit()
    {
        $currentDate = date('Y-m-d');
        $query = "SELECT COUNT(*) AS total FROM FirstAidKits WHERE ExpiryDate < ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $currentDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
class TeacherClass
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function countTeacher()
    {
        $sql = "SELECT COUNT(*) AS totalTeacher FROM teacher";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $totalTeacher = $row['totalTeacher'];
        $stmt->close();
        return $totalTeacher;
    }

    // Create a new teacher record
    public function createTeacher(
        $idno,
        $firstName,
        $middleInitial,
        $lastName,
        $suffix,
        $gender,
        $addressStreet,
        $addressCity,
        $addressState,
        $contactNumber,
        $birthday,
        $department,
        $medicalHistory,
        $emergencyContactName,
        $emergencyContactNumber
    ) {
        $sql = "INSERT INTO `teacher` (`idno`, `FirstName`, `MiddleInitial`, `LastName`, `Suffix`, `Gender`, `Address_Street`, `Address_City`, `Address_State`, 
`ContactNumber`, `Birthday`, `Department`,  `MedicalHistory`, `EmergencyContactName`, 
`EmergencyContactNumber`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssssssss",
            $idno,
            $firstName,
            $middleInitial,
            $lastName,
            $suffix,
            $gender,
            $addressStreet,
            $addressCity,
            $addressState,
            $contactNumber,
            $birthday,
            $department,
            $medicalHistory,
            $emergencyContactName,
            $emergencyContactNumber
        );
        if ($stmt->execute()) {
            $stmt->close();
            return true; // Success
        } else {
            $stmt->close();
            return false; // Error
        }
    }

    // Get all teachers
    public function getAllTeachers()
    {
        $sql = "SELECT `TeacherID`, `idno`, `FirstName`, `MiddleInitial`, `LastName`, `Suffix`, `Gender`, `Address_Street`, `Address_City`, `Address_State`, 
                `ContactNumber`, `Birthday`, `Department`, `MedicalHistory`, `EmergencyContactName`, `EmergencyContactNumber` 
                FROM `teacher`";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    // Count the total number of teachers
    public function countTeachers()
    {
        $sql = "SELECT COUNT(*) AS totalTeachers FROM teacher";
        $result = $this->conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['totalTeachers'];
        } else {
            return 0; // Return 0 if there is an error or no records found
        }
    }

    // Read a specific teacher record by ID
    public function getTeacherById($teacherId)
    {
        $query = "SELECT * FROM teacher WHERE idno = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $teacherId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update an existing teacher record
    public function updateTeacher(
        $idno,
        $firstName,
        $middleInitial,
        $lastName,
        $suffix,
        $gender,
        $addressStreet,
        $addressCity,
        $addressState,
        $contactNumber,
        $birthday,
        $department,
        $medicalHistory,
        $emergencyContactName,
        $emergencyContactNumber,
        $teacherId,
    ) {
        $query = "UPDATE teacher SET `idno` = ?, `FirstName` = ?, `MiddleInitial` = ?, `LastName` = ?, `Suffix` = ?, `Gender` = ?, `Address_Street` = ?, `Address_City` = ?, 
        `Address_State` = ?, `ContactNumber` = ?, `Birthday` = ?, `Department` = ?, `MedicalHistory` = ?, 
        `EmergencyContactName` = ?, `EmergencyContactNumber` = ? WHERE idno = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "sssssssssssssssi",
            $idno,
            $firstName,
            $middleInitial,
            $lastName,
            $suffix,
            $gender,
            $addressStreet,
            $addressCity,
            $addressState,
            $contactNumber,
            $birthday,
            $department,
            $medicalHistory,
            $emergencyContactName,
            $emergencyContactNumber,
            $idno
        );
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete an existing teacher record
    function deleteTeacher($teacherId)
    {
        // First, select the student's information
        $selectSql = "SELECT * FROM `teacher` WHERE `idno` = ?";
        $selectStmt = $this->conn->prepare($selectSql);
        $selectStmt->bind_param("i", $teacherId);
        $selectStmt->execute();
        $result = $selectStmt->get_result();

        // If the student exists, move it to the archive
        if ($result->num_rows > 0) {
            $teacherData = $result->fetch_assoc();

            // Insert student data into archiveStudents table
            $insertSql = "INSERT INTO `archivedteachers` (`idno`, `FirstName`, `MiddleInitial`, `LastName`, `Suffix`, `Gender`, `Address_Street`, `Address_City`, `Address_State`, 
            `ContactNumber`, `Birthday`, `Department`,  `MedicalHistory`, `EmergencyContactName`, 
            `EmergencyContactNumber`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $this->conn->prepare($insertSql);
            $insertStmt->bind_param(
                "issssssssssssss",
                $teacherData['idno'],
                $teacherData['FirstName'],
                $teacherData['MiddleInitial'],
                $teacherData['LastName'],
                $teacherData['Suffix'],
                $teacherData['Gender'],
                $teacherData['Address_Street'],
                $teacherData['Address_City'],
                $teacherData['Address_State'],
                $teacherData['ContactNumber'],
                $teacherData['Birthday'],
                $teacherData['Department'],
                $teacherData['MedicalHistory'],
                $teacherData['EmergencyContactName'],
                $teacherData['EmergencyContactNumber']
            );
            $insertStmt->execute();

            // Check if insertion was successful
            if ($insertStmt->affected_rows > 0) {
                // Now, delete the student from the students table
                $deleteSql = "DELETE FROM `teacher` WHERE `idno` = ?";
                $deleteStmt = $this->conn->prepare($deleteSql);
                $deleteStmt->bind_param("i", $teacherId);
                $deleteStmt->execute();

                // Check if deletion was successful
                if ($deleteStmt->affected_rows > 0) {
                    $deleteStmt->close();
                    $insertStmt->close();
                    $selectStmt->close();
                    return true; // Success
                }
            }
        }

        // Close statements and return false if any step fails
        $selectStmt->close();
        return false; // Error
    }
}
