<?php
include 'connection.php';
include 'common.php';


$query = "SELECT * FROM teachers WHERE approved = 1";
$result = mysqli_query($conn, $query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <!-- Include the datatable dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready( function () {
        $('#myTable').DataTable({
    language: {
        search: "Zoeken in de tabel:",
        lengthMenu: "_MENU_ resultaten weergeven",
        zeroRecords: "Geen resultaten gevonden",
        infoEmpty: "Geen resultaten om weer te geven",
        search: "Zoeken:",
        emptyTable: "Geen resultaten aanwezig in de tabel",
        infoThousands: ".",
        loadingRecords: "Een moment geduld aub - bezig met laden...",
        info: "_START_ tot _END_ van _TOTAL_ resultaten",
        infoFiltered: " (gefilterd uit _MAX_ resultaten)",
        paginate: {
        "first": "Eerste",
        "last": "Laatste",
        "next": "Volgende",
        "previous": "Vorige"
    },
    }
    });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
            <a href="admin.php"><img src="assets/logo.svg" class="img-fluid mt-5 mb-3" width="150px"></a>
            <h1>Docent<span class="docent"> Verwerkt</span></h1>

                 <div class="nav mb-4 mt-4">
                        <a href="admin.php" class="btn btn-outline-secondary position-relative">
                            Open
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                               <?PHP include 'includes/countOpen.php'?>
                            </span>
                        </a>

                        <a href="admin_closed.php" class="btn btn-secondary position-relative">
                            Verwerkt
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?PHP include 'includes/countClosed.php'?>
                            </span>
                        </a>
                </div>
                        
                 

                 <?PHP if (isset($_REQUEST['bijwerken'])) { ?> 
                    <div class="alert alert-success" role="alert">
                        Docent werd bijgewerkt...
                        </div>
                    <?PHP } ?>

                    <?PHP if (isset($_REQUEST['verwijderen'])) { ?> 
                    <div class="alert alert-danger" role="alert">
                        Docent werd verwijderd...
                        </div>
                    <?PHP } ?>

                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Voornaam</th>
                                <th>Achternaam</th>
                                <th>Email</th>
                                <th>Tel</th>
                                <th>Onderneming</th>        
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "<td><a href='admin_details.php?id=".$row['id']."' class='btn btn-danger btn-sm'>details</a></td>";
                                echo "<td>".$row['firstName']."</td>";
                                echo "<td>".$row['lastName']."</td>";
                                echo "<td>".$row['email']."</td>";
                                echo "<td>".$row['tel']."</td>";
                                echo "<td>".$row['companyName']."</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <?PHP include 'footer.php'; ?>
</body>
</html>