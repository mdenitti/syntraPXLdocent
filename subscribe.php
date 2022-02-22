<?php
include 'connection.php';
include 'common.php';
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
                 <h1>Welkom<span class="docent"> Docent</span></h1>
                 <div class="intro mb-4">
                     Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren '60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.
                 </div>
                  <div class="submitform">
                      <form method="post" action="subscribe_post.php">
                      <input type="text" class="form-control mt-2" name="firstName" placeholder="firstName" required>
                      <input type="text" class="form-control mt-2" name="lastName" placeholder="lastName" required>
                      <input type="text" class="form-control mt-2" name="email" placeholder="email" required>
                      <input type="text" class="form-control mt-2" name="website" placeholder="website" required>
                      <input type="text" class="form-control mt-2" name="tel" placeholder="tel" required>
                      <input type="text" class="form-control mt-2" name="companyName" placeholder="companyName" required>
                      <input type="text" class="form-control mt-2" name="street_nr" placeholder="street_nr" required>
                      <input type="text" class="form-control mt-2" name="code_city" placeholder="code_city" required>
                      <textarea class="form-control mt-2" name="bio" placeholder="Beschrijf uw zelf"></textarea>
                      <button type="submit" class="btn btn-success mt-2">Aanvraag indienen</button>
                  </div>

            </div>
        </div>
    </div>
</body>
</html>