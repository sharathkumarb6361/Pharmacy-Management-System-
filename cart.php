<?php
require_once('connection.php');

session_start();
// Fetch user information  from the database
$user_name = $_SESSION['user_name'];

$sql2 = "SELECT * FROM userinfo WHERE fname = '$user_name'";
$result = mysqli_query($conn, $sql2);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $umail1 = $row['email']; // Get the email from the fetched row
    
} else {
    $umail1 = "No userfound found";
}

function getcart($conn,$umail1){
     
    $sql="SELECT * FROM orders WHERE umail1 = '$umail1' ";
    $result=$conn->query($sql);
    if ($result->num_rows>0){
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    else{
        return[];
    }
    
    }
    $orders=getcart($conn,$umail1);
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
       /* General Styles */
body, table {
    margin: 0;
    padding: 0;
    width: 100vw;
    background-color: #BED7DC;
    font-family: "Roboto", sans-serif;
    font-weight: 300;
    font-style: normal;
    color: #333;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 60px;
    border: 1px solid #ddd;
}

th, td {
    text-align: left;
    border: 1px solid #ddd;
}

/* Table Header Styles */
th {
    background-color: #F1EEDC;
    text-align: left;
    padding: 10px;
    border-bottom: 2px solid #ddd;
    font-weight: 500;
}

/* Table Cell Styles */
td {
    border-bottom: 1px solid #ddd;
    padding: 10px;
    color: #333;
    transition: color 0.3s ease;
}

td:hover {
    color: #0cfbfb;
}

/* Footer Styles */
footer {
    width: 100%;
    height: 50px;
    position: fixed;
    bottom: 0;
    background-color: #1C5980;
    padding: 10px 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    
}

footer a {
    background-color:#3498DB;
    color: #BED7DC;
    width: 140px;
    height: 40px;
    border-radius: 20px; /* Adjusted border-radius for better shape */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease; /* Added transform for smoother effect */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    font-weight: 500;
    font-size: 1rem; /* Increased font size for better readability */
    padding: 0 20px; /* Added padding for more content space */
    cursor: pointer; /* Added cursor pointer for better UX */
}

footer a:hover {
    background-color: #3B6B7D; /* Darkened background color on hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Increased shadow on hover */
    transform: translateY(-2px); /* Slightly raise button on hover */
}

    
</style>


</head>
<body>
<h1 style=" color:black;">Ordered Item</h1>

<table>
                <tr><th>Order id</th><th>Medicine name</th><th>Price</th><th>Order date&time</th><th>Cancel order</th></tr>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['order_id'];?></td>
                        <td><?php echo $order['medicine'];?></td>
                        <td><?php echo $order['price'];?></td>
                        <td><?php echo $order['order_date'];?></td>
                        <td><button onclick="cancelorde('<?php echo $order['order_id'];?>')">Cancel</button></td>
                    </tr>
                    <?php endforeach;?>
</table>
   
<footer><a id="ba" href="home.php">Back</a></footer>
<script>
    function cancelorde(cancelid){
           
            let url='cancelorder.php';
            let params=`cancel_id=${cancelid}`;
            console.log(params);
            let xhr= new XMLHttpRequest();
            xhr.open('POST',url,true);
            xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');

            xhr.onload=function(){
                if(xhr.status===200){
                 
                    console.log(params);
                }
                else{
                    console.log(xhr.responseText);
                }
            };
            xhr.send(params);
         location.reload();
           }
           
</script>
</body>
</html>