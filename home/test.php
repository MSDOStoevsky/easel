<?php
session_start();
include('../databaseconn.php');
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$param = test_input($_GET['exam']);
$sql = "SELECT `question`.`id`,
    `question`.`exam_id`,
    `question`.`text`,
    `question`.`choices`,
    `question`.`answer`,
    `question`.`points`
FROM `easel`.`question`
WHERE exam_id = ".$param." ORDER BY `id` ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Take Your Test</title>
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
                    <a class="navbar-brand" href="index.php">Final Project</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <?php
            if ($result->num_rows > 0) {
                // output data of each row
                echo '<form action="grade.php" method="POST">';
                while($row = $result->fetch_assoc()) {
                    $obj = json_decode($row["choices"]);
                    echo '<div class="form-group">';
                    echo '<label for="">'.$row["text"].'</label>';
                    echo '<ul class="list-group">';
                    foreach($obj as $key=>$val){
                        echo '<div class="radio">';
                        echo '<label><input type="radio" value="'.$key.'" name="'.$row["id"].'">'.$val.'</label>';
                        echo '</div>';
                    }
                    echo '</ul>';
                    echo '</div>';
                    echo "<hr>";
                }
                echo '<input type="hidden" name="exam" value="'.$param.'">';
                echo '<input type="submit" class="btn btn-default btn-lg" value="Submit">';
                echo '</form>';
            } else {
                echo "<b>No questions...</b>";
            }
            ?>
        </div>
        <script type="text/javascript" src="../assets/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    </body>
</html>