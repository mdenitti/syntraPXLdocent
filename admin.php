<?php
include 'connection.php';
include 'common.php';


$query = "SELECT * FROM teachers";
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
        $('#myTable').DataTable();
    } );
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
            <img src="assets/logo.svg" class="img-fluid mt-5 mb-3" width="150px">
                 <h1>Admin</h1>


                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <th>firstName</th>
                                <th>lastName 2</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                 while ($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$row['firstName']."</td>";
                    echo "<td>".$row['lastName']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "</tr>";
                 }
              
                 ?>


                         
                            
                        </tbody>
                    </table>

            </div>
        </div>
    </div>
</body>
</html>