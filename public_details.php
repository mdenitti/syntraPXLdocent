<?php
include 'connection.php';
include 'includes/common.php';

$id = $_GET['id'];
$query = "SELECT * FROM teachers WHERE id = $id";
$result = mysqli_fetch_assoc(mysqli_query($conn, $query));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aanvraag registratie SyntraPXL docenten</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
            <a href="admin.php"><img src="assets/logo.svg" class="img-fluid mt-5 mb-3" width="150px"></a>
                 <h1>Docent<span class="docent"> Details</span></h1>
                 <div class="intro mb-4">
                    
                 </div>
                  <div class="submitform">
                      <form method="post" action="index.php">

                            
                            <?php 
                            $querySector = "SELECT * FROM sectors ORDER BY name";
                            $resultSector = mysqli_query($conn, $querySector);

                            $queryCurrentSector = "SELECT sectors.id AS sector_id, sectors.name AS sectorName FROM teachers
                            JOIN sectors ON sectors.id = teachers.sector_id
                            WHERE teachers.id = $id";
                            $resultCurrentSector = mysqli_fetch_assoc(mysqli_query($conn, $queryCurrentSector));
                            ?>

                            <div class="row">
                                <div class="col-md-6">

                                <h3 class='docentdetails'> <?php echo $result['firstName']?> <?php echo $result['lastName']?> </h3>
                                <h3> <?php echo $result['type'] ?>  <span class='sectorpublic'> - <?php echo $resultCurrentSector['sectorName']?></span></h3>
                                <input type="hidden" name="filter" value="<?php echo $resultCurrentSector['sector_id']?>">
                            
                                        <div class="input-group mt-3">
                                        <span class="input-group-text public">Email</span>
                                        <input type="text" class="form-control" name="email" value="<?php echo $result['email']?>" disabled>
                                        </div>
                                    
                                        <div class="input-group mt-2">
                                        <span class="input-group-text public">Website</span>
                                        <input type="text" class="form-control" name="website" value="<?php echo $result['website']?>" disabled>
                                        </div>

                                        <div class="input-group mt-2">
                                        <span class="input-group-text public">Telefoon</span>
                                        <input type="text" class="form-control" name="tel" value="<?php echo $result['tel']?>" disabled>
                                        </div>
                                    
                                        <div class="input-group mt-2">
                                        <span class="input-group-text public">Ondernemingsnaam</span>
                                        <input type="text" class="form-control" name="companyName" value="<?php echo $result['companyName']?>" disabled>
                                        </div>
                                    
                                        <div class="input-group mt-2">
                                        <span class="input-group-text public">Straat & nummer</span>
                                        <input type="text" class="form-control" name="street_nr" value="<?php echo $result['street_nr']?>" disabled>
                                        </div>
                                        
                                        <div class="input-group mt-2 mb-2">
                                        <span class="input-group-text public">Postcode & gemeente</span>
                                        <input type="text" class="form-control" name="code_city" value="<?php echo $result['code_city']?>" disabled>
                                        </div>


                                </div>
                                <div class="col-md-6">
                                <h4 class='docentdetails'>Over <?php echo $result['firstName']?>: </h4>
                                <?php echo $result['bio']?>
                                </div>
                            </div>
                            <button type='submit'                    
                        class='btn btn-dark btn-sm me-3 mt-2 position-relative'>Meer docenten <?php echo $resultCurrentSector['sectorName']?></button> 
                    </form>        
                  </div>

            </div>
        </div>
    </div>
   
    <?PHP include 'footer.php'; ?>
</body>
</html>