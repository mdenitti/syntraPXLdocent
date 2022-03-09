<?php
include 'connection.php';
include 'includes/common.php';

if(isset($_POST['login'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];
   $_SESSION['user'] = hash('sha256',$password);
   header('Location: admin.php');
}


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
                 <a href="index.php"><img src="assets/logo.svg" class="img-fluid mt-5 mb-3" width="150px"></a>
                 <h1>Admin<span class="docent"> Login</span></h1>

                 <?PHP if (isset($_GET['logout'])) { ?> 
                         <div class="alert alert-warning" role="alert">
                          U bent veilig uitgelogd...
                        </div>
                    <?PHP session_destroy(); ?>
                    <meta http-equiv="refresh" content="2;url=login.php">
                    <?PHP } ?>
                 
                 <div class="submitform">
                      <form method="post" action="">
                      <input type="text" class="form-control mt-2" name="username" placeholder="e-mail" required value="info@syntrapxl.be">
                      <input type="password" class="form-control mt-2" name="password" placeholder="paswoord" required value="welcome">
                      <button type="submit" class="btn btn-sm btn-danger mt-2" name="login" value="login">Login</button>
                    </div>
              
            </div>
        </div>
    </div>
    <?PHP include 'footer.php'; ?>
</body>
</html>