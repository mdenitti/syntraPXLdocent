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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                 <img src="assets/logo.svg" class="img-fluid mt-5 mb-3" width="150px">
                 <h1>Admin<span class="docent"> Login</span></h1>
                 
                 <div class="submitform">
                      <form method="post" action="subscribe_post.php">
                      <input type="text" class="form-control mt-2" name="firstName" placeholder="Voornaam" required>
                      <input type="text" class="form-control mt-2" name="lastName" placeholder="Achternaam" required>
                </div>
              

            </div>
        </div>
    </div>
    <?PHP include 'footer.php'; ?>
</body>
</html>