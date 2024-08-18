<?php
/*include 'Database.php';
session_start();
$database = new Database();
$message = "";
if(isset($_SESSION["user_id"])){
    header("Location: http://localhost/project/index.php");
    exit();
}
if (isset($_POST['submit_form'])){
    $user_details = $database->check_user_details($_REQUEST['mail_id'],$_REQUEST['password']);
    if(!$user_details['is_valid']){
        $message = "InValid User credentials...";
    }else{
        $_SESSION["user_id"] = $user_details['user_data']['id'];
        $_SESSION["mail_id"] = $user_details['user_data']['mail_id'];
        header("Location: http://localhost/project/users.php");
        exit();
    }
}*/
?>
<?php
require_once("connection.php");
if (isset($_SESSION["is_login"]) && $_SESSION['is_login'] == true) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and register</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/0feaf0873b.js" crossorigin="anonymous"></script>
</head>

<body class="sign">
    <div class="container">
        <div class="form-box">
            <main>
                <form action="" method="post">
                    <div class="input-group">
                        <div class="home-1">
                            <a href="mini.php"><i class="fa-solid fa-circle-xmark fa-2xl"></i></a>
                        </div>
                        <div>
                            <h1>Login</h1>
                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="text" name="username" placeholder="Username">
                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" placeholder="Password">
                        </div>
                        <p>Forget Password<a href="#">Click Here!</a></p>
                    </div>
                    <div class="btn-field">
                        <input type="submit" name="login" class="btn-1" value="login" />
                    </div>
                </form>
                <div><? //php echo $message; 
                        ?></div>
                <div class="reg">
                    <p>Don't have an account <a href="register.php">Register</a></p>
                </div>
        </div>
    </div>
    <main>
        <footer>
            <?php
            try {
                if (isset($_POST['login'])) {
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $stmt = $dbhandler->prepare("
                            SELECT * FROM table_user 
                            WHERE username=:username 
                            AND password=:password 
                            LIMIT 1
                        ");
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    if ($row) {
                        $id = $row['id'];
                        $role = $row['role'];
                        $name = $row['name'];
                        $rate = $row['rate'];
                        $_SESSION["is_login"] = true;
                        $_SESSION["session_id"] = $id;
                        $_SESSION["session_role"] = $role;
                        $_SESSION["session_name"] = $name;
                        $_SESSION["session_rate"] = $rate;
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "Invalid Credentials";
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
            ?>
        </footer>
</body>

</html>