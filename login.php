<?php

include('../databaseconn.php');

$sql = 'SELECT `student`.`id`,
    `student`.`name`,
    `student`.`major`,
    `student`.`email`,
    `student`.`password`
FROM `easel`.`student`
WHERE `email` = "'.$_POST["email"].'" AND `password` = "'.$_POST["pw"].'"';

header("Location: home/index.php");
exit;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "<b>No new tests!</b>";
}

