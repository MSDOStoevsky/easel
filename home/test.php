<?php
include('../databaseconn.php');

$sql = "SELECT `question`.`id`,
    `question`.`exam_id`,
    `question`.`text`,
    `question`.`choices`,
    `question`.`answer`,
    `question`.`points`
FROM `easel`.`question`
WHERE exam_id = ". $_GET['exam']." ORDER BY `id` ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Exam</title>
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
                    <a class="navbar-brand" href="index.php">Easel</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a data-toggle="modal" data-target="#viewprofile"><span class="glyphicon glyphicon-user"></span>My Profile</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
                </ul>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="viewprofile" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Your Profile</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="POST" action="createthread.php">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control input-lg" id="username" name="username" maxlength="45">
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
			<!--/modal-->
        </nav>
        <div class="container">
            <?php
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $obj = json_decode($row["choices"]);
                    echo '<div class="form-group">';
                    echo '<label for="">'.$row["text"].'</label>';
                    echo '<ul class="list-group">';
                    foreach($obj as $key=>$val){
                        echo '<div class="radio">';
                        echo '<label><input type="radio" value="" name="'.$row["id"].'">'.$val.'</label>';
                        echo '</div>';
                    }
                    echo '</ul>';
                    echo '</div>';
                    echo "<hr>";
                }
            } else {
                echo "<b>No questions...</b>";
            }
            ?>
        </div>
        <script type="text/javascript" src="../assets/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    </body>
</html>