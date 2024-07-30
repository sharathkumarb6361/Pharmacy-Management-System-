<?php
require_once('connection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    
    $mail=mysqli_real_escape_string($conn,$_POST['mail']);
    $pswrd=mysqli_real_escape_string($conn,$_POST['password']);
    $mobile=mysqli_real_escape_string($conn,$_POST['mobile']);

    $address=mysqli_real_escape_string($conn,$_POST['address']);
    
   //to check that email already exists or not
   $sql_check="SELECT * FROM userinfo WHERE email='$mail'";
   $result_check=$conn->query($sql_check);

   if($result_check->num_rows > 0){
    echo"<script> alert('email already exists')</script";

   }
   else{

    $sql="INSERT INTO userinfo(fname,email,pswd,pno,address) VALUES ('$name','$mail','$pswrd','$mobile','$address')";
    if($conn->query($sql)==TRUE){
        echo "<script>alert('Registered successfully'); window.location='login.php';</script>";
        exit;  
    }else {
        echo "<script>alert('Registration failed'); window.location='register.php';</script>";
            exit; // Stop further execution
    }
    
     
   }


  
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #BED7DC;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color:#EEF7FF;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-shadow: 25px 25px #7AB2B2;
            width: 400px;

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
            color: #666;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button[type="submit"],
        a.button{
            padding: 10px;
            border: ;none;
            border-radius: 10px;
            font-size: 16px;
             background-color: #7AA2Ee;
            color: black;
            cursor: pointer;
            text-align:center;
            text-decoration:none;
        }

        button[type="submit"]:hover,
        a.button:hover {
            background-color: #7AB2B2;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Sign Up</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name"> Name</label>
        <input type="text" name="name" id="name" required>

        <label for="mail">Email</label>
        <input type="email" name="mail" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="mobile">Phone Number</label>
        <input type="text" name="mobile" id="mobile" maxlength="10" required>

        <label for="address">Address</label>
        <textarea name="address" id="address" cols="30" rows="6" required></textarea>

        <button type="submit">Sign Up</button>
        <a href="login.php" class="button">Back</a>
    </form>
</div>
</body>
</html>
