<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
include 'connection.php';
include 'includes/common.php';

// create vars to receive the input;

$firstName = mysqli_real_escape_string($conn,$_POST['firstName']);
$lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$website = mysqli_real_escape_string($conn,$_POST['website']);
$tel = mysqli_real_escape_string($conn,$_POST['tel']);
$companyName = mysqli_real_escape_string($conn,$_POST['companyName']);
$street_nr = mysqli_real_escape_string($conn,$_POST['street_nr']);
$code_city = mysqli_real_escape_string($conn,$_POST['code_city']);
$bio = mysqli_real_escape_string($conn,$_POST['bio']);
$type = mysqli_real_escape_string($conn,$_POST['type']);
$sector_id = mysqli_real_escape_string($conn,$_POST['sector_id']);

$query = "SELECT * FROM teachers WHERE email = '$email'";
$result = mysqli_query($conn, $query);
// Also perfectly possible using the mysqli_num_rows() function on the $result - a fetch assoc is not needed in this case...
// count() very usefull -> but not with assoc arrays... only ['one','two','three']

if(mysqli_num_rows($result) == 0) {
    $query = "INSERT INTO `teachers` (`firstName`, `lastName`, `email`, `website`, `tel`, `companyName`, `street_nr`, `code_city`, `approved`, `bio`, `sector_id`, `type`) VALUES ('$firstName', '$lastName', '$email', '$website', '$tel', '$companyName', '$street_nr', '$code_city', 0, '$bio','$sector_id','$type')";

    $result = mysqli_query($conn, $query);
    $ok = 1;

    // Snippet mail out:

    $mail = new PHPMailer;

    // $mail->SMTPDebug = 3;

        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->Port = 1025;

        $mail->setFrom('noreply@syntrapxl.be', 'SyntraPXLDocent');
        $mail->addAddress('info@syntrapxl.be', 'SyntraPXLAdmin');
        $mail->addAddress($email);

        $mail->isHTML(true);

        $mail->Subject = "$firstName, Uw registratie voor het SyntraPXL portaal is in behandeling...";
        $mail->Body = "
        <style>
        body {
            font-family:Arial;
        }
        </style>
        <img src='https://www.syntra-limburg.be//themes/custom/sassy/assets/images/og-syntra-default.png' width=250px>
        <br>
        <br>
        <b>Nieuwe aanmelding docent $firstName - $lastName - $email</b><br><br>
        Beste $firstName,<br><br>
        Wij hebben uw registratie prima ontvangen en zal asap worden verwerkt door één van onze medewerkers. <br>Van wij hebben uw registratiezodra deze werd goedkeurd is uw profiel online zichtbaar. Bijkomende vragen steeds welkom. <br>
        Gelieve niet op deze mail te reageren<br><br>
        <b>SyntraPXL</b><br>
        
        ";
    
        $mail->send();

} else {
    $ok = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aanvraag registratie SyntraPXL docenten</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                 <img src="assets/logo.svg" class="img-fluid mt-5 mb-3" width="150px">

                 <?php if ($ok == 1) { ?>
                    
                    <h1>Bedankt</h1>
                    <div class="thanakyou">
                        We hebben uw gegevens goed ontvangen, zodra u bent goedgekeurd zal u zichtbaar zijn op onze website...Het SyntraPXL team!
                    </div>
                    
                 <?php } ?>

                 <?php if ($ok == 0) { ?> 
                    
                    <h1>Oeps...</h1>
                    <div class="thankyou">
                        Uw e-mail adres werd reeds gebruikt en is aanwezig in onze database...
                    </div>

                 <?php } ?>

            </div>
        </div>
    </div>
    <?PHP include 'footer.php'; ?>
</body>
</html>
