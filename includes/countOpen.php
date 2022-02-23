<?php
$coQuery = "SELECT COUNT(*) AS totalOpen FROM teachers WHERE approved = 0";
$coResult = mysqli_fetch_assoc(mysqli_query($conn, $coQuery));
echo $coResult['totalOpen'];
?>