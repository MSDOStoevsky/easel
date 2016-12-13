<?php
session_start();
include('../databaseconn.php');
$sql = "SELECT e.`id`,
    e.`name`,
    e.`created`,
    e.`total_points`,
    r.`score`
    FROM `easel`.`exam` e
    LEFT JOIN `easel`.`results` r ON e.`id` = r.`exam_id`
    WHERE ISNULL(`score`)";
$result_one = $conn->query($sql);

$sql = "SELECT e.`id`,
    e.`name`,
    e.`created`,
    e.`total_points`,
    r.`score`
    FROM `easel`.`exam` e
    LEFT JOIN `easel`.`results` r ON e.`id` = r.`exam_id`
    WHERE NOT ISNULL(`score`) AND r.`s_id` = ".$_SESSION["sid"];
$result_two = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome Home!</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="The Fair-Use Test Taking Site" />
        <meta name="keywords" content="MTU, Website, Grading, Testing, Exam" />
        <meta name="author" content="Dylan Lettinga, Ben Slade" />

        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">Easel</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="things">
                <h3>Upcoming tests</h3>
            </div>
            <ul class="list-group">
                <?php                 
                if ($result_one->num_rows > 0) {
                    // output data of each row
                    while($row = $result_one->fetch_assoc()) {
                        echo '<a class="list-group-item" href="test.php?exam='.$row["id"].'">'.$row["name"]. '</a>';
                    }
                } else {
                    echo "<b>No new tests!</b>";
                }
                ?>
            </ul>
            <hr>
            <div class="things">
                <h3>Previous tests</h3>
            </div>
            <ul class="list-group">
                <?php                 
                if ($result_two->num_rows > 0) {
                    // output data of each row
                    while($row = $result_two->fetch_assoc()) {
                        echo '<a class="list-group-item" href="result.php?exam='.$row["id"].'">'.$row["name"].'<span class="badge">'.$row["score"].'</span></a>';
                    }
                } else {
                    echo "<b>You have no tests completed.</b>";
                }
                ?>
            </ul>
        </div>
        
        <script type="text/javascript" src="../assets/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    </body>
</html>