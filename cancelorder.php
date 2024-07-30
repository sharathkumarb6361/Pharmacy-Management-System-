<?php
include 'connection.php';

if($_SERVER["REQUEST_METHOD"]=="POST")
{
   
    $cancelId=$_POST['cancel_id'];
  


//deleting items from the database
$query="DELETE FROM orders WHERE order_id= $cancelId";

if (mysqli_query($conn,$query)){
    echo "<script>alert('Order canceled successfully')</script>";
}
else {
    echo "Error:". $query ."<br>". mysqli_error($conn);
}
mysqli_close($conn);


}
?>