<html>
	<br><br>
	<h1>Links to send a route to Scenic for IMPORT. Scenic will open (if installed) and import of the route will start
	</h1>
	<br><br>	
	<a href='./yourwebpage.php?id=1'>Send gpxURL to Scenic for IMPORT</a>
	<br><br>
	<a href='./yourwebpage.php?id=2'>Send route polyline to Scenic for IMPORT</a>
	<br><br>
	<a href='./yourwebpage.php?id=3'>Send route coordinates to Scenic for IMPORT</a>
	<br><br>
	<br><br>
	<h1>Links to send a route or location to Scenic for NAVIGATION. Scenic will open (if installed) and the route or location will be ready to navigate. All the user has to do is tap 'Start'.
	</h1>
	<br><br>
	<a href='./yourwebpage.php?id=4'>Send route polyline to Scenic for NAVIGATION</a>
	<br><br>
	<a href='./yourwebpage.php?id=5'>Send route coordinates to Scenic for NAVIGATION</a>
	<br><br>
	<a href='./yourwebpage.php?id=6'>Send location coordinate to Scenic for NAVIGATION</a>

</html>

<?php
	
	if (isset($_GET['id'])) {
		include_once('scenicapi.php');
		
		$id = $_GET['id'];
		
		if ($id == 1) {
		
			// Get the required parameters for this route id from your database
			// ... your code
			// ... your code
			$gpxurl = 'http://www.motomappers.com/Accentrix.GPX';
			
			sendToScenicForImport_gpxurl($gpxurl, "YourWebsiteName PHP");
		}
		else if ($id == 2) {
		
			// Get the required parameters for this route id from your database
			// ... your code
			// ... your code
			$polyline = 'wxk~FvbgvOkEuaBj]m}Ajm@qnBp`Axv@bj@qaAxk@mjCjM{cB';
			$name = 'Polyline Name PHP';
			$description = 'Polyline Description PHP';
			
			sendToScenicForImport_polyline($polyline, $name, $description, "YourWebsiteName PHP");
		}
		else if ($id == 3) {
		
			// Get the required parameters for this route id from your database
			// ... your code
			// ... your code
			$coordinates = array
				(
					array("lat"=>28.5020112345,"lon"=>77.0853534524),
					array("lat"=>28.5021994638,"lon"=>77.0848774538),
					array("lat"=>28.5026335458,"lon"=>77.0850589642),
					array("lat"=>28.5029786472,"lon"=>77.085397485)
				);
			$name = 'Coordinates Name PHP';
			$description = 'Coordinates Description PHP';
			
			sendToScenicForImport_coordinates($coordinates, $name, $description, "YourWebsiteName PHP");
		}
		else if ($id == 4) {
			
			// Get the required parameters for this route id from your database
			// ... your code
			// ... your code
			$polyline = 'wxk~FvbgvOkEuaBj]m}Ajm@qnBp`Axv@bj@qaAxk@mjCjM{cB';			
			sendToScenicForNavigation_polyline($polyline, "Route From Web", "F", "C");
		}
		else if ($id == 5) {
		
			// Get the required parameters for this route id from your database
			// ... your code
			// ... your code
			$coordinates = array
				(
					array("lat"=>28.5020112345,"lon"=>77.0853534524),
					array("lat"=>28.5021994638,"lon"=>77.0848774538),
					array("lat"=>28.5026335458,"lon"=>77.0850589642),
					array("lat"=>28.5029786472,"lon"=>77.085397485)
				);
			sendToScenicForNavigation_coordinates($coordinates, "Route From Web", "F", "C");
		}
		else if ($id == 6) {
			// Get the required parameters for this location id from your database
			// ... your code
			// ... your code
			$coordinate = array("lat"=>19.415,"lon"=>-99.098377);
			sendToScenicForNavigation_coordinate($coordinate, "Location From Web");
		}
	}
	

	
?>