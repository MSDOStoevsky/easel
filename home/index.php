<?php
include('../databaseconn.php');

$sql = "SELECT `exam`.`id`,
    `exam`.`name`,
    `exam`.`created`,
    `exam`.`total_points`
FROM `easel`.`exam`;
";
$result = $conn->query($sql);
      
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
                    <li><a data-toggle="modal" data-target="#viewprofile"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
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
            <div class="things">
                <h3>Upcoming tests</h3>
            </div>
            <ul class="list-group">
                <?php                 
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                           echo '<a class="list-group-item" href="test.php?exam=' . $row["id"]. '"> ' . $row["name"]. ' <span class="badge">' . $row["total_points"]. '</span></a>';
                        }
                    } else {
                        echo "<b>No tests yet! Whoo!</b>";
                    }
                ?>
            </ul>
            <hr>
            <div class="things">
                <h3>Previous tests</h3>
            </div>
            <ul class="list-group">
                <a class="list-group-item">Old <span class="badge">12</span></a>
            </ul>
        </div>
        
        <script type="text/javascript" src="../assets/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    </body>
</html>