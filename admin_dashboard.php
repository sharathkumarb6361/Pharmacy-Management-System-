<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #B3C8CF;
        }
        .container {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color:#B3C8CF ;
            color: #E5DDC5;
            padding: 20px;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .option {
            display: block;
            padding: 10px 0;
            border-bottom: 1px solid #666;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .option:last-child {
            border-bottom: none;
        }
        .option:hover {
            background-color: #555;
        }
        .option.active {
            background-color: #555;
        }
        h1 {
            margin-top: 0;
            text-align: center;
        }
        /* Styles for the form */
        .form-container {
            margin-top: 20px;
            display: none; /* Initially hide the form */
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
        }
        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="file"], /* Added */
        .form-container textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container textarea {
            height: 100px;
        }
        .form-container input[type="submit"] {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-container input[type="submit"]:hover {
            background-color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h1>Admin</h1>
            <a href="#" class="option" id="add-medicine-link">Add new medicine</a>
            <a href="#" class="option" id="remove-medicine-link">Remove medicine</a>
            <a href="#" class="option" id="logout-link">Logout</a>
        </div>
        <div class="main-content">
            <div id="add-medicine-form" class="form-container">
                <h1>Add New Medicine</h1>
                <form action="add-medicine.php" method="post" enctype="multipart/form-data"> <!-- Added enctype -->
                    <label for="medicine-name">Medicine Name:</label>
                    <input type="text" id="medicine-name" name="medicine-name" required><br><br>
                    
                    <label for="medicine-description">Description:</label><br>
                    <textarea id="medicine-description" name="medicine-description" rows="4" cols="50"></textarea><br><br>
                    
                    <label for="medicine-price">Price:</label>
                    <input type="number" id="medicine-price" name="medicine-price" required><br><br>
                    
                    <label for="medicine-image">Image:</label> <!-- Added -->
                    <input type="file" id="medicine-image" name="medicine-image" accept="image/*" required><br><br> <!-- Added -->
                    
                    <input type="submit" value="Add Medicine">
                </form>
            </div>
            <div id="remove-medicine-form" class="form-container">
                <h1>Remove Medicine</h1>
                <form action="remove-medicine.php" method="post">
                    <label for="medicine-id">Medicine ID:</label>
                    <input type="text" id="medicine-id" name="medicine-id" required><br><br>
                    
                    <input type="submit" value="Remove Medicine">
                </form>
            </div>
            <div id="logout-form" class="form-container">
                <h1>Logout</h1>
                <p>Are you sure you want to logout?</p>
                <form action="logout.php" method="post">
                    <input type="submit" value="Logout">
                </form>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to toggle form visibility
        function toggleForm(formId) {
            var form = document.getElementById(formId);
            if (form.style.display === 'block') {
                form.style.display = 'none';
            } else {
                form.style.display = 'block';
            }
        }

        document.getElementById('add-medicine-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            document.querySelectorAll('.form-container').forEach(function(el) {
                el.style.display = 'none'; // Hide all form containers
            });
            toggleForm('add-medicine-form');
        });

        document.getElementById('remove-medicine-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            document.querySelectorAll('.form-container').forEach(function(el) {
                el.style.display = 'none'; // Hide all form containers
            });
            toggleForm('remove-medicine-form');
        });

        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            document.querySelectorAll('.form-container').forEach(function(el) {
                el.style.display = 'none'; // Hide all form containers
            });
            toggleForm('logout-form');
        });
    </script>
</body>
</html>