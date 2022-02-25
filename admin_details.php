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
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

                            <input type="hidden" class="form-control" name="id" value="<?php echo $result['id']?>">
                          
                            <div class="input-group mt-2">
                            <span class="input-group-text" id="inputGroup-sizing-default">Voornaam</span>
                            <input type="text" class="form-control" name="firstName" value="<?php echo $result['firstName']?>" required>
                            </div>

                            <div class="input-group mt-2">
                            <span class="input-group-text" id="inputGroup-sizing-default">Achternaam</span>
                            <input type="text" class="form-control" name="lastName" value="<?php echo $result['lastName']?>" required>
                            </div>

                            <div class="input-group mt-2">
                            <span class="input-group-text" id="inputGroup-sizing-default">Achternaam</span>
                            <input type="text" class="form-control" name="email" value="<?php echo $result['email']?>" required>
                            </div>
                           
                            <div class="input-group mt-2">
                            <span class="input-group-text" id="inputGroup-sizing-default">Website</span>
                            <input type="text" class="form-control" name="website" value="<?php echo $result['website']?>" required>
                            </div>

                            <div class="input-group mt-2">
                            <span class="input-group-text" id="inputGroup-sizing-default">Telefoon</span>
                            <input type="text" class="form-control" name="tel" value="<?php echo $result['tel']?>" required>
                            </div>
                          
                            <div class="input-group mt-2">
                            <span class="input-group-text" id="inputGroup-sizing-default">Ondernemingsnaam</span>
                            <input type="text" class="form-control" name="companyName" value="<?php echo $result['companyName']?>" required>
                            </div>
                          
                            <div class="input-group mt-2">
                            <span class="input-group-text" id="inputGroup-sizing-default">Straat & nummer</span>
                            <input type="text" class="form-control" name="street_nr" value="<?php echo $result['street_nr']?>" required>
                            </div>
                             
                            <div class="input-group mt-2 mb-2">
                            <span class="input-group-text" id="inputGroup-sizing-default">Postcode & gemeente</span>
                            <input type="text" class="form-control" name="code_city" value="<?php echo $result['code_city']?>" required>
                            </div>
                           
                            <textarea class="form-control" name="bio" id="editor"><?php echo $result['bio']?></textarea>
                            <button type="submit" class="btn btn-sm btn-success mt-2" name="bijwerken" value="bijwerken">Bijwerken</button>
                            <button type="submit" onclick="return confirm('Ben u zeker?')" class="btn btn-sm btn-danger mt-2" name="verwijderen" value="verwijderen">Verwijderen</button>
                     
                    </form>        
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