<?php
include 'connection.php';
include 'includes/common.php';

if (isset($_POST['filter'])) {

    $sectorId = $_POST['filter'];
    $query = "SELECT
    teachers.id,
    teachers.firstName,
    teachers.lastName,
    teachers.email,
    teachers.tel,
    teachers.companyName
    FROM teachers 
    JOIN sectors ON sectors.id = teachers.sector_id
    WHERE approved = 1 AND sector_id = $sectorId
    ";
    $queryResult = mysqli_query($conn, $query);

} else {
   
    $query = "SELECT * FROM teachers WHERE approved = 1";
    $queryResult = mysqli_query($conn, $query);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SyntraPXL docenten op de kaart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <style>
        input[type="search"] {
            border-style: solid!important;
            border-color: #d10000!important;
            border-width: 2px!important;
            background-color: #d1000010!important;
            padding: 7px!important;
            width: 100%;
        }
    </style>

<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWuWTaHtAfkhEP9o1VaA38djolEfKF77Y&callback=initMap"
		async defer></script>

      

	<script type="text/javascript">
	var map;
	var geocoder;		

	function initMap() {
		var mapLayer = document.getElementById("map-layer");
		var centerCoordinates = new google.maps.LatLng(37.6, -95.665);
		var defaultOptions = { center: centerCoordinates, zoom: 4 }

		map = new google.maps.Map(mapLayer, defaultOptions);
		geocoder = new google.maps.Geocoder();
		
		<?php
		if (! empty($countryResult)) {
		    foreach ($countryResult as $k => $v) {
		        ?>  
		         	geocoder.geocode( { 'address': '<?php echo $countryResult[$k]["country"]; ?>' }, function(LocationResult, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							var latitude = LocationResult[0].geometry.location.lat();
							var longitude = LocationResult[0].geometry.location.lng();
						} 
		        	    		new google.maps.Marker({
		            	        position: new google.maps.LatLng(latitude, longitude),
		            	        map: map,
		            	        title: '<?php echo $countryResult[$k]["country"]; ?>'
		            	    });
					});
			    <?php
		    }
		}
		?>		
	}
	</script>


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
                 <img src="assets/logo.svg" class="img-fluid mt-5 mb-3" width="150px">
                 <h1>SyntraPXL<span class="docent"> Docenten op de kaart</span></h1>
                 <img class="img-fluid mb-2" src="https://via.placeholder.com/1300x250/C00000/F5F5F5%20?Text=Digital.com%20C/O%20https://placeholder.com/#How_To_Use_Our_Placeholders">
                <div class="map" id="map-layer"></div>
                </div>
        </div>


        <div class="row">
            <div class="col">
                 
                 <div class="intro mb-4 mt-2">
                 <form method="POST" action="">
                 <?php 
                 $querySector = "SELECT * FROM sectors ORDER BY name";
                 $SectorResult = mysqli_query($conn, $querySector);
                 // print_r($SectorResult);

                 while ($rowSector = mysqli_fetch_assoc($SectorResult)) {
                    // count the teachers number
                    $rowSectorid= $rowSector['id'];
                    $queryDocent = "SELECT COUNT(*) AS totalDocent FROM teachers 
                    JOIN sectors ON teachers.sector_id = sectors.id
                    WHERE approved = 1 AND sectors.id = $rowSectorid";
                    $docentResult = mysqli_fetch_assoc(mysqli_query($conn, $queryDocent));

                    // Echo the button not active

                    if (!isset($_POST['filter'])) {
                        $sectorId = "";
                    }

                    if ($rowSectorid == $sectorId) {

                        echo "<button type='submit'                    
                        class='btn btn-dark btn-sm me-3 mb-2 position-relative' 
                        name='filter' value=".$rowSector['id'].">".$rowSector['name']."
                        <span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger'>
                                ".$docentResult['totalDocent']."
                                </span>
                        </button>";

                    } else {

                        echo "<button type='submit'                    
                        class='btn btn-outline-dark btn-sm me-3 mb-2 position-relative' 
                        name='filter' value=".$rowSector['id'].">".$rowSector['name']."
                        <span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger'>
                                 ".$docentResult['totalDocent']."
                               </span>
                        </button>";

                    }

                 }

                 ?>
                 </form>
<!--           
                / get all sectors
                create form with post to index.php
                / iterate sector 
                    / echo button with sector id in name
                    get count from sector with current id in the loop 
                    echo the count
                
                Create post conditions - if sector id 
                Adjust the query

                Query with all sector - if no button is pressed -->
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
                            while ($row = mysqli_fetch_assoc($queryResult)){
                                echo "<tr>";
                                echo "<td><a href='public_details.php?id=".$row['id']."' class='btn btn-danger btn-sm'>details</a></td>";
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
    </div>

   
<?PHP include 'footer.php'; ?>
</body>
</html>