<?php
// Database connection parameters
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "medicare"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted and the medicine ID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['medicine-id'])) {
    $medicine_id = $_POST['medicine-id'];

    // Sanitize the input to prevent SQL injection
    $medicine_id = mysqli_real_escape_string($conn, $medicine_id);

    // Construct the DELETE query
    $sql = "DELETE FROM medicines WHERE id = '$medicine_id'";

    // Execute the DELETE query
    if (mysqli_query($conn, $sql)) {
        echo "Medicine with ID $medicine_id has been successfully removed.";
    } else {
        echo "Error removing medicine: " . mysqli_error($conn);
    }
}

// Close the database connection
$conn->close();
?>
