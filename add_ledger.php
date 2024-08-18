<?php
require_once("connection.php");
if (!isset($_SESSION["is_login"]) || $_SESSION['is_login'] != true) {
    header("Location: login.php");
}
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $rate = $_REQUEST['rate'];
}
// else if($_SESSION['role'] = 1)
// {
// 	$id = $_SESSION['session_id'];
// 	$name = $_SESSION['session_name'];
// 	$rate = $_SESSION['session_rate'];
// }

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dairy</title>
    <script src="https://kit.fontawesome.com/0feaf0873b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="he">
        <div class="main">
            <ul>
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="logout.php">logout</a></li>
            </ul>
        </div>
        <div class="led">
            Add Ledger for <b> <?php echo $name ?> </b>
        </div>
        <hr>
        <main>
            <?php
            if (!isset($id)) {
                echo "Please Select User <a href='index.php'>HOME</a>";
            } else {
            ?>
                <div class="container">
                    <div class="form-box">
                        <form action="" method="POST">
                            <div class="input-group">
                                <div class="home-1">
                                    <a href="mini.php"><i class="fa-solid fa-circle-xmark fa-2xl"></i></a>
                                </div>
                                <div>
                                    <h1>ADD</h1>
                                </div>
                                <div class="input-field">
                                    <i class="fa-solid fa-calendar"></i>
                                    <input type="date" name="o_date" required />
                                </div>
                                <div class="input-field">
                                    <i class="fa-solid fa-scale-unbalanced-flip"></i>
                                    <input type="number" placeholder="Enter Quantity" name="qty" required />
                                </div>
                                <div class="btn-2">
                                    <input type="submit" name="submit" class="btn-reg" value="Submit" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>

            <main>
                <footer>
                    <?php
                    try {
                        if (isset($_POST['submit'])) {
                            $o_date = $_POST["o_date"];
                            $qty = $_POST["qty"];
                            $stmt = $dbhandler->prepare("
                            INSERT INTO table_ledger (user_id, o_date, qty, rate) 
                            VALUES (:user_id, :o_date, :qty, :rate)
                        ");
                            $stmt->bindParam(':user_id', $id);
                            $stmt->bindParam(':o_date', $o_date);
                            $stmt->bindParam(':qty', $qty);
                            $stmt->bindParam(':rate', $rate);
                            $stmt->execute();
                            echo header("Location: view_ledger.php?id=" . $id . "&name=" . $name . "&rate=" . $rate);
                        }
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                        die();
                    }
                    ?>

                </footer>
    </header>
</body>

</html>

<?php



?>