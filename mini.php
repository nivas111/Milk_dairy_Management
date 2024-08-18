<?php
/*require_once("connection.php") ;
    if(!isset($_SESSION["is_login"]) || $_SESSION['is_login'] != true ) 
	{ 
		header("Location: login.php"); 
	} 
    if(isset($_REQUEST['id']))
    {
    	$id = $_REQUEST['id'];
    	$name = $_REQUEST['name'];
    	$rate = $_REQUEST['rate'];
    } 
    // else if($_SESSION['role'] = 1)
    // {
    // 	$id = $_SESSION['session_id'];
    // 	$name = $_SESSION['session_name'];
    // 	$rate = $_SESSION['session_rate'];
    // }*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAIRY SYSTEM</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="login.php">
</head>

<body>
    <header class="he">
        <div class="main">
            <ul>
                <li class="active"><a href="#">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div>
        <div class="title">
            <h1>DAIRY MANAGEMENT</h1>
        </div>
        <div class="button">
            <a href="login.php" class="btn">LOGIN</a>
            <a href="register.php" class="btn">REGISTER</a>
        </div>
    </header>
</body>

</html>