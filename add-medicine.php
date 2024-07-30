<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (!empty($_POST['medicine-name']) && !empty($_POST['medicine-description']) && !empty($_POST['medicine-price']) && !empty($_FILES['medicine-image']['name'])) {
        // Database connection
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

        // Handle file upload
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["medicine-image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["medicine-image"]["tmp_name"], $targetFile)) {
                // Insert data into the database
                $medicine_name = $_POST['medicine-name'];
                $medicine_description = $_POST['medicine-description'];
                $medicine_price = $_POST['medicine-price'];
                $medicine_image = $targetFile;

                $sql = "INSERT INTO medicines (name, description, price, image) VALUES ('$medicine_name', '$medicine_description', $medicine_price, '$medicine_image')";

                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "All fields are required.";
    }
}
?>
