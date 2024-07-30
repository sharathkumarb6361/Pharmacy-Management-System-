<?php
include 'connection.php';

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $userName=$_POST['user_name'];
    $medId=$_POST['medi_id'];
    $userMail=$_POST['user_mail'];
//Retrive medicine details from the database using the medicine name
$query="SELECT * FROM medicines WHERE id= $medId";
$result=mysqli_query($conn,$query);
$meds=mysqli_fetch_assoc($result);

//insert order into the database
$query="INSERT INTO orders (uname,medicine,price,umail1) VALUES ('$userName','{$meds['name']}','{$meds['price']}','$userMail')";

if (mysqli_query($conn,$query)){
    echo "<script>alert('Order placed successfully')</script>";
}
else {
    echo "Error:". $query ."<br>". mysqli_error($conn);
}
mysqli_close($conn);


}
?>