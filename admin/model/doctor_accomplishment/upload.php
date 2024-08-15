<?php
// Check if dataUrl is set and not empty
if (isset($_POST['imageCode']) && !empty($_POST['imageCode'])) {
    // Get the dataUrl from POST parameters
    $dataUrl = $_POST['imageCode'];
    $doctorsName = $_POST['doctorsName'];
    $preparedByName = $_POST['preparedByName'];
    // Decode base64 data
    $base64_string = explode(',', $dataUrl)[1];
    $image = base64_decode($base64_string);

    // Check if base64_decode was successful
    if ($image !== false) {
        // Save base64 image as a JSON file
        $file_name = 'doctor_accomplishment.json';

        // Check if the JSON file is writable
        if (file_exists($file_name)) {
            // Read existing JSON file
            $json_data = file_get_contents($file_name);
            $images = json_decode($json_data, true);
        } else {
            // Create a new array for images if the file doesn't exist
            $images = [];
        }

        // Add the new image data to the array
        $images[] = [
            'doctorsName' => $doctorsName,
            'preparedByName' => $preparedByName,
            'dataUrl' => $dataUrl,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        // Encode the array as JSON
        $json_data = json_encode($images);

        // Save JSON data to the file
        if (file_put_contents($file_name, $json_data) !== false) {
            echo "Image saved successfully.";
        } else {
            echo "Error: Failed to save image data.";
        }
        
    } else {
        echo "Error: Failed to decode base64 data.";
    }
} else {
    echo "Error: Data URL not provided.";
}
?>
