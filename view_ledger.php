<?php
require_once("connection.php");
if (!isset($_SESSION["is_login"]) || $_SESSION['is_login'] != true) {
    header("Location: login.php");
}
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $rate = $_REQUEST['rate'];
} else if ($_SESSION['role'] = 1) {
    $id = $_SESSION['session_id'];
    $name = $_SESSION['session_name'];
    $rate = $_SESSION['session_rate'];
}

if (isset($_POST['search'])) {
    $o_month = $_POST["o_month"];
    $o_year = $_POST["o_year"];
} else {
    $o_month = date('m');
    $o_year = date('Y');
}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dairy</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/0feaf0873b.js" crossorigin="anonymous"></script>
</head>

<body class='sign'>
    <header class="he">
        <div class="home-1">
            <a href="mini.php"><i class="fa-solid fa-circle-xmark fa-2xl"></i></a>
        </div>
        <div class="main">
            <ul>
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="logout.php">logout</a></li>
            </ul>
        </div>
        <div class="led">
            Ledger for <b> <?php echo $name ?> </b>
        </div>
        <hr>
        <main>
            <div class="container">
                <div class="form-box">
                    <form action="" method="POST">
                        <div class="input-group">
                            <div class="home-1">
                                <a href="index.php"><i class="fa-solid fa-circle-xmark fa-2xl"></i></a>
                            </div>
                            <div>
                                <h1>Search</h1>
                            </div>
                            <div class="input-field">
                                <i class="fa-solid fa-calendar-days"></i>
                                Select Month
                                <select id="o_month" name="o_month">
                                    <option value="01" <?php echo $o_month == '01' ? ' selected' : ''; ?>>January</option>
                                    <option value="02" <?php echo $o_month == '02' ? ' selected' : ''; ?>>February</option>
                                    <option value="03" <?php echo $o_month == '03' ? ' selected' : ''; ?>>March</option>
                                    <option value="04" <?php echo $o_month == '04' ? ' selected' : ''; ?>>April</option>
                                    <option value="05" <?php echo $o_month == '05' ? ' selected' : ''; ?>>May</option>
                                    <option value="06" <?php echo $o_month == '06' ? ' selected' : ''; ?>>June</option>
                                    <option value="07" <?php echo $o_month == '07' ? ' selected' : ''; ?>>July</option>
                                    <option value="08" <?php echo $o_month == '08' ? ' selected' : ''; ?>>August</option>
                                    <option value="09" <?php echo $o_month == '09' ? ' selected' : ''; ?>>September</option>
                                    <option value="10" <?php echo $o_month == '10' ? ' selected' : ''; ?>>October</option>
                                    <option value="11" <?php echo $o_month == '11' ? ' selected' : ''; ?>>November</option>
                                    <option value="12" <?php echo $o_month == '12' ? ' selected' : ''; ?>>December</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <i class="fa-solid fa-calendar-days"></i>
                                Select Year
                                <select id="o_year" name="o_year">
                                    <option value="2021" <?php echo $o_year == '2021' ? ' selected' : ''; ?>>2021</option>
                                    <option value="2022" <?php echo $o_year == '2022' ? ' selected' : ''; ?>>2022</option>
                                    <option value="2023" <?php echo $o_year == '2023' ? ' selected' : ''; ?>>2023 </option>
                                    <option value="2024" <?php echo $o_year == '2024' ? ' selected' : ''; ?>>2024</option>
                                    <option value="2025" <?php echo $o_year == '2025' ? ' selected' : ''; ?>>2025</option>
                                </select>
                            </div>
                            <div class="btn-2">
                                <input type="submit" name="search" class="btn-reg" value="Search" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="center">
                <?php
                if (!isset($id)) {
                    echo "Please Select User <a href='index.php'>HOME</a>";
                } else {
                    echo '<a class="a1" href="add_ledger.php?id=' . $id . '&name=' . $name . '&rate=' . $rate . '">Add</a><br>'
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $dbhandler->prepare("
		                    	SELECT * FROM table_ledger 
		                    	WHERE user_id=:user_id 
		                    	AND MONTH(o_date) = :o_month 
		                    	AND YEAR(o_date) = :o_year 
		                    	ORDER BY o_date DESC
		                    ");
                            $stmt->bindParam(':user_id', $id);
                            $stmt->bindParam(':o_month', $o_month);
                            $stmt->bindParam(':o_year', $o_year);
                            $stmt->execute();
                            $data = $stmt->fetchAll();
                            $total_qty = 0;
                            $total_rate = 0;
                            foreach ($data as $row) {
                                echo '<tr>';
                                echo '<td>' . $row['o_date'] . '</td>';
                                echo '<td>' . $row['qty'] . '</td>';
                                echo '<td>' . $row['rate'] . '</td>';
                                echo '<td>' . $row['qty'] * $row['rate'] . '</td>';
                                echo '</tr>';
                                $total_qty += $row['qty'];
                                $total_rate += $row['qty'] * $row['rate'];
                            }
                            ?>
                        </tbody>
                        </tfoot>
                        <tr>
                            <th><b> TOTAL </b></th>
                            <th><?php echo $total_qty; ?></th>
                            <th></th>
                            <th><?php echo $total_rate; ?></th>
                        </tr>
                        </tfoot>
                    </table>
            </div>
        <?php
                }
        ?>

        <main>
            <footer> </footer>
    </header>
</body>

</html>

<?php

?>