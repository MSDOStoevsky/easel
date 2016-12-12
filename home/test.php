<?php
include('../databaseconn.php');

$sql = "SELECT `question`.`id`,
    `question`.`exam_id`,
    `question`.`text`,
    `question`.`choices`,
    `question`.`answer`,
    `question`.`points`
FROM `easel`.`question`
 where exam_id = ". $_GET['exam'];
$result = $conn->query($sql);

 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       print_r($row["text"]);
        echo "<br>";
    }
} else {
    echo "<b>No tests yet! Whoo!</b>";
}
?>