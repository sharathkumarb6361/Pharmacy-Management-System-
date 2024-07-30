<?php
session_start();
 



if(isset($_POST['submit'])) {
    require_once('connection.php');    

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM userinfo WHERE email = '$email' AND pswd = '$mypassword'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
  
    if($email=="admin@gmail.com" && $mypassword=="admin@123"){
        header("location: admin_dashboard.php");
        
    }

   else  if($count == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION['user_name'] = $row['fname']; // Set the  name in the session
        header("location: home.php");
        exit;
    } 
    else {
        $error = "Your Login Email or Password is invalid";
        echo '<script>
        window.location.href="login.php";
        alert("Your Login Email or Password is invalid")
        </script>';
    }
}






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #CDE8E5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-shadow: 15px 15px #7AB2B2;
        }

        .container {
            background-color: #EEF7FF;
            border-radius: 20px;
            box-shadow: 15px 15px #7AB2B2;
            padding: 20px;
            width: 300px;
        }
        #submit:hover{
transform:scale(1.1);
color:#EEF7FF;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: CDE8E5;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background-color: #7AA2Ee;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: CDE8E5;
        }

        .signup-link {
            text-align: center;
            margin-top: 10px;
            
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <input type="submit"id="submit" name="submit" value="Submit">
    </form>
    <div class="signup-link">
        <span>Don't have an account? </span><a href="register.php">Sign Up</a>
    </div>
</div>
</body>
</html>

