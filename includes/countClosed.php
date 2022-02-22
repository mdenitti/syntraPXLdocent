<?php
$coQuery = "SELECT COUNT(*) as totalClosed FROM teachers WHERE approved = 1";
$coResult = mysqli_fetch_assoc(mysqli_query($conn, $coQuery));
echo $coResult['totalClosed'];
