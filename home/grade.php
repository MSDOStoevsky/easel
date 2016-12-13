<?php
session_start();
include('../databaseconn.php');

$total_score = 0;

// define variables and set to empty values
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answers = json_encode($_POST);
    $student = $_SESSION["id"];
    $param = $_POST["exam"];
}
$sql = "SELECT `question`.`id`,
    `question`.`answer`,
    `question`.`points`
FROM `easel`.`question`
WHERE exam_id = ".$param." ORDER BY `id` ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo $_POST[$row["id"]]."  ".$row["answer"];
        //echo "<br>";
        if ($_POST[$row["id"]] == $row["answer"]){
            $total_score += $row["points"];
        }
    }
} else {
    echo "<b>Unable to grade</b>";
}
// prepare and bind
$stmt = $conn->prepare("CALL `GRADE_STUDENT`(?, ?, ?, ?);");
$stmt->bind_param("iisi", $student, $param, $answers, $total_score);
$stmt->execute();
header("Location: index.php");
exit;
?>