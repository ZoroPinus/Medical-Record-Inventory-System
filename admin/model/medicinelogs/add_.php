<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php';
include '../../../includes/config.php';

$MedicineClass = new MedicineClass($conn);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $medicineId = $_POST['medicineId'];
    $medicineName = $_POST['medicineName'];
    $dosage = $_POST['dosage'];
    $time = $_POST['time'];
    $quantity = $_POST['quantity'];
    $recipient = $_POST['recipient_name'];
    $reason = $_POST['reason'];

    // Add the medicine log using the MedicineClass method
    $success = $MedicineClass->addMedicineLog($medicineName, $time, $recipient, $quantity, $dosage, $reason);

    // Check if the medicine log was added successfully
    if ($success) {
        // Medicine log added successfully
        echo json_encode(array("success" => true, "message" => "Medicine log added successfully"));

        // Decrease the quantity of the medicine in the medicine table
        $medicine = $MedicineClass->getMedicineDetails($medicineId);
        if ($medicine) {
            // Ensure the medicine is not expired
            

            if ($medicine['Quantity'] >= $quantity) {
                // Calculate the new quantity after deduction
                $newQuantity = $medicine['Quantity'] - $quantity;
                if ($newQuantity < 0) {
                    $newQuantity = 0; // Ensure the quantity doesn't go negative
                }
                // Update the medicine quantity using the editMedicine method
                $MedicineClass->editMedicinebyLogs($medicineId, $newQuantity);
            } else {
                // Return error if quantity to deduct exceeds current quantity
                echo json_encode(array("success" => false, "message" => "Insufficient quantity"));
                exit();
            }
        } else {
            // Return error if medicine not found
            echo json_encode(array("success" => false, "message" => "Medicine not found"));
            exit();
        }

        exit();
    } else {
        // Failed to add medicine log
        echo json_encode(array("success" => false, "message" => "Failed to add medicine log"));
        exit();
    }
} else {
    // If the form is not submitted via POST method, return an error
    echo json_encode(array("success" => false, "message" => "Form submission method not allowed"));
    exit();
}
?>