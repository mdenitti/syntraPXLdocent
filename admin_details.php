<?php
include 'connection.php';
include 'common.php';
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
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
            <a href="admin.php"><img src="assets/logo.svg" class="img-fluid mt-5 mb-3" width="150px"></a>
                 <h1>Docent<span class="docent"> Update</span></h1>
                 <div class="intro mb-4">
                     Bijwerken van gegevens docent + aanpassen status & sector...
                 </div>
                  <div class="submitform">
                      <form method="post" action="admin.php">

                            <?php if ($result['approved'] == 0) { ?>
                            <select name="approved" class="form-select offline">
                                <option value="0" selected>Offline</option>
                                <option value="1">Online</option>
                            </select>
                            <?php } ?>

                            <?php if ($result['approved'] == 1) { ?>
                            <select name="approved" class="form-select online">
                                <option value="0">Offline</option>
                                <option value="1" selected>Online</option>
                            </select>
                            <?php } ?>

                            
                            <?php 
                            $querySector = "SELECT * FROM sectors ORDER BY name";
                            $resultSector = mysqli_query($conn, $querySector);

                            $queryCurrentSector = "SELECT sectors.id AS sector_id, sectors.name AS sectorName FROM teachers
                            JOIN sectors ON sectors.id = teachers.sector_id
                            WHERE teachers.id = $id";
                            $resultCurrentSector = mysqli_fetch_assoc(mysqli_query($conn, $queryCurrentSector));
                            ?>

                            <select name="sector_id" class="form-select mt-2">

                                <?php 
                                while ($rowSector = mysqli_fetch_assoc($resultSector)) {
                                
                                        if ($resultCurrentSector['sector_id'] == $rowSector['id']) {
                                            echo "<option value='".$rowSector['id']."' selected>".$rowSector['name']."</option>";
                                        } else {
                                            echo "<option value='".$rowSector['id']."'>".$rowSector['name']."</option>";
                                        }
                                }
                                ?>

                                </select>
                              

                            <!-- Get the current sector for the teacher
                            Show all availble sectors -->

                            <input type="hidden" class="form-control mt-2" name="id" value="<?php echo $result['id']?>">
                            <input type="text" class="form-control mt-2" name="firstName" value="<?php echo $result['firstName']?>" required>
                            <input type="text" class="form-control mt-2" name="lastName" value="<?php echo $result['lastName']?>" required>
                            <input type="text" class="form-control mt-2" name="email" value="<?php echo $result['email']?>" required>
                            <input type="text" class="form-control mt-2" name="website" value="<?php echo $result['website']?>" required>
                            <input type="text" class="form-control mt-2" name="tel" value="<?php echo $result['tel']?>" required>
                            <input type="text" class="form-control mt-2" name="companyName" value="<?php echo $result['companyName']?>" required>
                            <input type="text" class="form-control mt-2" name="street_nr" value="<?php echo $result['street_nr']?>" required>
                            <input type="text" class="form-control mt-2" name="code_city" value="<?php echo $result['code_city']?>" required>
                            <textarea class="form-control mt-2" name="bio"><?php echo $result['bio']?></textarea>
                            <button type="submit" class="btn btn-sm btn-success mt-2" name="bijwerken" value="bijwerken">Bijwerken</button>
                            <button type="submit" onclick="return confirm('Ben u zeker?')" class="btn btn-sm btn-danger mt-2" name="verwijderen" value="verwijderen">Verwijderen</button>
                     
                    </form>        
                  </div>

            </div>
        </div>
    </div>
    <?PHP include 'footer.php'; ?>
</body>
</html>