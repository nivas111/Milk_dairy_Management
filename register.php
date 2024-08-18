<?php
require_once("connection.php");
if (isset($_SESSION["is_login"]) && $_SESSION['is_login'] == true) {
    header("Location: index.php");
}

?>
<?php
if (isset($_REQUEST['message'])) {
    echo $_REQUEST["message"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
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
                            <h1>Register</h1>
                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="name" placeholder="name" required>
                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="username" placeholder="username" required>
                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-mobile"></i>
                            <input type="number" name="mobile" placeholder="Mobile Number" required>
                        </div>
                        <div class="input-field">
                            <i class="fa-sharp fa-solid fa-address-card"></i>
                            <input type="text" name="address" placeholder="address" required>
                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-user"></i>
                            <p>
                                Role:
                                <lable>
                                    <input type="radio" name="role" id="admin" value="0" />
                                    Admin
                                </lable>
                                <lable>
                                    <input type="radio" name="role" id="user" value="1" />
                                    User
                                </lable>
                            </p>
                        </div>
                        <div class="input-field">
                            <i class="fa-sharp fa-solid fa-coins"></i>
                            <input type="number" name="rate" placeholder="rate" required>
                        </div>
                        <p>Forget Password<a href="#">Click Here!</a></p>
                    </div>
                    <div class="btn-2">
                        <button type="submit" name="submit" class="btn-reg" value="Register">REGISTER</button>
                    </div>
                </form>
                <main>
        </div>
    </div>
    <footer>
        <?php
        try {
            if (isset($_POST['submit'])) {
                $name = $_POST["name"];
                $username = $_POST["username"];
                $password = $_POST["password"];
                $email = $_POST["email"];
                $mobile = $_POST["mobile"];
                $address = $_POST["address"];
                $role = $_POST["role"];
                $rate = $_POST["rate"];
                $stmt = $dbhandler->prepare("
                                                    SELECT * FROM table_user 
                                                    WHERE username=:username 
                                                    LIMIT 1
                        ");
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                $row = $stmt->fetch();
                if ($row) {
                    header("Location: registration.php?message=Username Already Taken Please Resubmit Form");
                } else {
                    $stmt = $dbhandler->prepare("
                                INSERT INTO table_user (name, username, password, email, mobile, address, role, rate) 
                                VALUES (:name, :username, :password, :email, :mobile, :address, :role, :rate)
                            ");
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':mobile', $mobile);
                    $stmt->bindParam(':address', $address);
                    $stmt->bindParam(':role', $role);
                    $stmt->bindParam(':rate', $rate);
                    $stmt->execute();
                    echo "<br><br>";
                    //echo "You are registered Now you can login ";
                    header("Location: registration.php?message=You are registered Now you can login ");
                    echo "<a href='login.php'>Login</a>";
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