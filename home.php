<?php

require_once('connection.php');
function getMedicine($conn){

$sql="SELECT * FROM medicines";
$result=$conn->query($sql);
if ($result->num_rows>0){
    
    return $result->fetch_all(MYSQLI_ASSOC);

}
else{
    return[];
}

}
$medis=getMedicine($conn);


session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: login.php"); 
    exit;
}


// Fetch user information including subj
$user_name = $_SESSION['user_name'];

$sql2 = "SELECT * FROM userinfo WHERE fname = '$user_name'";
$result2 = mysqli_query($conn, $sql2);

if ($result2 && mysqli_num_rows($result2) > 0) {
    $row = mysqli_fetch_assoc($result2);
    $uname = $row['fname'];
    $umail=$row['email']; // Get the subjects from the fetched row
} else {
    $uname = "No userfound found";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #CDE8E5;
            font-family: "Roboto", sans-serif;
            font-weight: 300;
            overflow-x: hidden;
        }

        header {
            background-color: #CDE8E5;
            color: #035834;
            padding: 20px 0;
            text-align: center;
            
        }

        nav {
    text-align: center;
    background-color: #EEF7FF;
    padding: 15px 0;
    margin: auto;
    font-size: 1.2em;
}

nav a {
    text-decoration: none;
    color: #333;
    padding: 12px 24px; /* Slightly reduced padding */
    margin: 0 8px; /* Reduced margin */
    display: inline-block;
    transition: background-color 0.3s ease, color 0.3s ease;
    border-radius: 5px;
    border: 2px solid transparent; /* Added border */
    box-shadow: 5px 5px #7AB2B2;
}

nav a:hover {
    background-color: #B3C8CF;
    color: #fff;
    border-color: #B3C8CF; /* Change border color on hover */
    box-shadow: 15px 15px #7AB2B2;
}

nav a.active {
    background-color: #B3C8CF;
    color: #fff;
    border-color: #B3C8CF; /* Same border color as hover for active state */
}


        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .content {
            padding: 20px;
        }

        .style {
            width: 100vw;
            height: 10vh;
        }

        h1 {
            color: black;
            margin-bottom: 20px;
        }

        .card {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin: 2%;
    height: 200px;
    margin-left: 170px;
    width: 31.5%; 
    display: inline-flex; 
    align-items: center; 
    justify-content: center; 
    text-align: center;
    background-color: #BED7DC;
    box-shadow: 15px 15px #7AB2B2;
    border-radius:20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}


@media screen and (max-width: 768px) {
    .card {
        width: 47%; 
    }
}

.card img {
    max-width: 100%;
    height: 100px;
    margin-bottom: 10px;
    
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
s
      
button {
    background-color: #B3C8CF; 
    color: black; 
    width: 100px;
    height: 40px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    font-size: 16px; 
    font-weight: bold; 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
}

button:hover {
    background-color: #99AFB7; 
    transform: scale(1.05);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); 
}

footer {
    width: 100%;
    background-color: #B3C8CF;
    padding: 20px 0;
    text-align: center;
    position: relative;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    font-size: 1rem;
    color: #555;
}

footer:hover {
    background-color: #A9BFC6;
}


/* Footer Button Styles */
footer button {
    background-color: #8FAAB5; /* Different shade for footer button */
    color: white; /* White text for better contrast */
    width: 160px; /* Slightly wider for better visual balance */
    height: 45px; /* Slightly taller for better visual balance */
    border-radius: 8px; /* Rounded corners for a softer look */
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    font-size: 16px; /* Consistent font size */
    font-weight: bold; /* Bold text for emphasis */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    margin-top: 10px; /* Space between text and button */
}

footer button:hover {
    background-color: #76929F; /* Darker shade for hover */
    transform: scale(1.05);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); /* More pronounced shadow on hover */
}
.card-align{
    display:flex;
    flex-direction:column;

}
#cardbtn{
    border-radius:15px;
    border:none;
    padding:10px;
    margin:10px 15px;
}

    </style>
</head>
<body>
    <header>
        <h1> MEDICARE</h1>
    </header>
    <nav id="nav">
        <a href="#">Products</a>
        <a href="contact.html">Contact</a>
        <a href="cart.php">Order List</a>
        <a href="logout.php">Logout</a>
    </nav>
    <section id=#home>
    <div class="style"></div>
    <center><h1>PRODUCTS</h1></center>
    <?php foreach($medis as $medi): ?>
       
        <div class="card">
            <img src="<?php echo $medi['image'];?>" alt="<?php echo $medi['name'];?>cover">
            <div class="card-align">
            <h2><?php echo $medi['name'];?></h2>
            <p><strong>Description:</strong><?php echo $medi['description'];?></p>
            <p><?php echo $medi['price'];?></p>
  
            
            <button id="cardbtn" onclick="buymedicine('<?php echo $medi['id'];?>')">BUY</button>
            </div>
        </div>
 
        <?php endforeach;?>
        <footer><a href="home.php"><button>Move to Top</button></a></footer>
        <script>
           function buymedicine(medid){
            let username= '<?php echo $uname ?>';
            let useremail= '<?php echo $umail ?>';
            console.log(useremail);
            let url='order.php';
            let params=`user_name=${username}&medi_id=${medid}&user_mail=${useremail}`;

            let xhr= new XMLHttpRequest();
            xhr.open('POST',url,true);
            xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');

            xhr.onload=function(){
                if(xhr.status===200){
                    alert('Order Placed');
                    console.log(params);
                }
                else{
                    alert('Error in adding cart',xhr.responseText);
                }
            };
            xhr.send(params);

           }
        </script>
    </section>
   
</body>
</html>
