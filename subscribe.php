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
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
                      <input type="text" class="form-control mt-2" name="firstName" placeholder="Voornaam" required>
                      <input type="text" class="form-control mt-2" name="lastName" placeholder="Achternaam" required>
                      <input type="text" class="form-control mt-2" name="email" placeholder="Email" required>
                      <input type="text" class="form-control mt-2" name="website" placeholder="Website" required>
                      <input type="text" class="form-control mt-2" name="tel" placeholder="Telefoon" required>
                      <input type="text" class="form-control mt-2" name="companyName" placeholder="Ondernemingsnaam" required>
                      <input type="text" class="form-control mt-2" name="street_nr" placeholder="Straat & nr" required>
                      <input type="text" class="form-control mt-2 mb-2" name="code_city" placeholder="Postcode & gemeente" required>
                      <select name="type" class="form-select mt-2 mb-2" required>
                        <option value="">Kies uw statuut</option>
                        <option value="Zelfstandige">Zelfstandige</option>
                        <option value="Zelfstandige in bijberoep">Zelfstandige in bijberoep</option>
                        <option value="Loondienst of andere">Loondienst of andere</option>
                      </select>

                      <select name="sector_id" class="form-select mt-2 mb-2" required>
                      <option value="">Kies uw sector</option>
                      <?php 
                      // Fetch sectors from db
                      $querySector = "SELECT * FROM sectors ORDER BY name";
                      $querySectorResult = mysqli_query($conn, $querySector);
                      while ($row = mysqli_fetch_assoc($querySectorResult)) {
                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                      }
                      
                      ?>
                      </select>
                      <textarea id="editor" class="form-control mt-2" name="bio" placeholder="Beschrijf uw zelf"></textarea>
                      <button type="submit" class="btn btn-danger mt-2">Aanvraag indienen</button>
                  </div>

            </div>
        </div>
    </div>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
   <?PHP include 'footer.php'; ?>
</body>
</html>