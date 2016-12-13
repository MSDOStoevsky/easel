<?php
include('databaseconn.php');
session_start();
$sql = 'SELECT `student`.`id`,
    `student`.`name`,
    `student`.`major`,
    `student`.`email`,
    `student`.`password`
FROM `easel`.`student`
WHERE `email` = "'.$_POST["email"].'" AND `password` = "'.sha1($_POST["pw"]).'"';

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $_SESSION["sid"] = $row["id"];
    }

    header("Location: home/index.php");
    exit;
} else {
    header("Location: index.html");
    exit;
}





