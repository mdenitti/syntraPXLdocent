<?php
include 'connection.php';
include 'includes/common.php';
checkLogin();
// includes - db connection common library
// checklogin - secure
// \n generates a new line
// $time = time()."\n";

// fwrite ($export,$time);
// aanmaak van een bestand... 
$export = fopen('export/SyntraPXLDocent.csv','w');

// query nodig met alle teachers
$queryTeachers = "SELECT * FROM teachers WHERE approved = 1";
$queryTeachersResult = mysqli_query($conn,$queryTeachers);

fwrite($export,"Voornaam, Achternaam, Email\n");
// iteratie alle teachers wegschrijf naar het bestand
 while ($row = mysqli_fetch_assoc($queryTeachersResult)) {
     $txt = "$row[firstName],$row[lastName],$row[email]\n";
     fwrite ($export,$txt);
 }
// teacher data moet ik scheiden met komma's
header('Content-Disposition: attachment; filename="SyntraPXLDocent.csv"');
readfile('export/SyntraPXLDocent.csv');
// close the file
fclose($export);
?>