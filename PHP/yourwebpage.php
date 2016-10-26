<html>
	<br><br>	
	<a href='./yourwebpage.php?id=1'>Send gpxURL to Scenic</a>
	<br><br>
	<a href='./yourwebpage.php?id=2'>Send route polyline to Scenic</a>
	<br><br>
	<a href='./yourwebpage.php?id=3'>Send route coordinates to Scenic</a>
	<br><br>
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
			$polyline = '_p~iF~ps|U_ulLnnqC_mqNvxq`@';
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
	}
	

	
?>