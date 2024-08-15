<?php
// Check if dataUrl and name are set and not empty
if (isset($_POST['dataUrl']) && !empty($_POST['dataUrl']) && isset($_POST['name']) && !empty($_POST['name'])) {
    // Get the dataUrl and name from POST parameters
    $dataUrl = $_POST['dataUrl'];
    $name = $_POST['name'];
    $physicianName = $_POST['physicianName'];

    // Decode base64 data
    $base64_string = explode(',', $dataUrl)[1];
    $image = base64_decode($base64_string);

    // Save base64 image as a JSON file
    $file_name = 'certificates.json';

    // Check if the JSON file exists
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
        'name' => $name,
        'physicianName' => $physicianName,
        'dataUrl' => $dataUrl,
        'timestamp' => date('Y-m-d H:i:s')
    ];

    // Encode the array as JSON
    $json_data = json_encode($images);

    // Save JSON data to the file
    file_put_contents($file_name, $json_data);

    echo "Image saved successfully.";
} else {
    echo "Error: Data URL or Name not provided.";
}
?>
