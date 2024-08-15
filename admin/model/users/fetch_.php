

<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php'; // Assuming this file contains your TeacherClass definition
include '../../../includes/config.php'; // Assuming this file contains your database connection

// Instantiate TeacherClass with the database connection
$UserClass = new UserClass($conn);

// Fetch teachers data
$users = $UserClass->fetchUsers();

// Create an array to hold the teacher data
$usersData = array();

// Loop through the fetched teachers and extract relevant data
while ($user = $users->fetch_assoc()) {
    $created = new DateTime($user['created_at']);
    $loggedIn = new DateTime($user['loggedinAt']);

    // Create an array containing teacher data
    $userData = array(
        'user_id' => $user['user_id'],
        'FirstName' => $user['firstName'] ,
        'LastName' => $user['lastName'],
        'email' => $user['email'],
        'createdAt' => $created->format('h:i A F j, Y'),
        'loggedinAt' => $loggedIn->format('h:i A F j, Y '),
    );

    // Add the teacher data to the array
    $usersData[] = $userData;
}

// Return the teacher data as JSON
echo json_encode($usersData);
?>

