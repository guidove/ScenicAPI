>*This document is part of the [README.md](README.md) in the Scenic-Integration repository. If you haven't read the README yet it's recommended to do that first.*

# Direct Universal Links
As described in the README, the *Customised* Universal Links will not work offline. This document describes how to implement the *Direct* Universal Links that do work offline. Please note they are only useful for:

- Websites/apps that work offline themselves and 
- that want to enable their users to navigate with Scenic while offline

**Important**:

- unlike the Customized Universal Links described in the README, the Direct Universal Links **do NOT support desktop browsing**. (I.e. if a user clicks on a Direct Universal Link on your website they will not be redirected to the Scenic WebApp, but to the Scenic App Store Page) 
- Direct Universal Links are **only available for Navigation**, not for Import.

## Structure of the Direct Link
`https://scenicapp.space/api/openScenic.php?<parameter1name>=<parameter1value>&<parameter2name>=<parameter2value>&...etc`

### Sending a single coordinate (location)
Example: `https://scenicapp.space/api/openScenic.php?navigatelocation=23.12345,-99.654321&name=Best%20View%20Ever`

Parameter Name  |  Parameter Value  |  Comments
---  |  ---  |  ---
`navigatelocation`  |  `lat`,`lon`  |  **Required**<br>- Dot as decimal separator <br>- `lat` and `lon` separated by comma.
`name` | Name of the location | **Optional**<br>Needs to be url encoded<br>E.g. 'Your Location Name' becomes 'Your%20Location%20Name' 	

### Sending a route (coordinates)
Example: `https://scenicapp.space/api/openScenic.php?navigatecoordinates=28.5020112345,77.0853534524|28.5021994638,77.0848774538|28.5026335458,77.0850589642|28.5029786472,77.085397485&name=Best%20Route%20Ever&routeMode=F&vehicleType=C`

Parameter Name  |  Parameter Value  |  Comments
---  |  ---  |  ---
`navigatecoordinates`  |  `lat1`,`lon1`&#124;`lat2`,`lon2`&#124;`lat3`,`lon3`  |  **Required**<br>- Dot as decimal separator <br>- `lat` and `lon` separated by comma.<br>- Coordinates separated by pipe symbol<br>- Max 200 Coordinates
`name` | Name of the route | **Optional**<br>Needs to be url encoded<br>E.g. 'Awesome Route' becomes 'Awesome%20Route' 	
`vehicleType` | C for Car/Motorcycle<br>B for Bicycle<br>P for Pedestrian | **Optional**<br>Defaults to C 	
`routeMode` | F for Fastest<br>S for Shortest<br>E for Efficient | **Optional**<br>Defaults to F

Please note that the entire [URL can not exceed 2000 characters](http://stackoverflow.com/questions/417142/what-is-the-maximum-length-of-a-url-in-different-browsers). If the route has many coordinates it's very likely you exceed this. In that case it's recommended to use the polyline version to send a route (see below) as this compacts the same amount of coordinates into a smaller string.

### Sending a route (polyline)
Example: ```https://scenicapp.space/api/openScenic.php?navigatepolyline=wxk~FvbgvOkEuaBj]m}Ajm@qnBp`Axv@bj@qaAxk@mjCjM{cB&name=Best%20Route%20Ever&routeMode=F&vehicleType=C```

Parameter Name  |  Parameter Value  |  Comments
---  |  ---  |  ---
`navigatepolyline`  |  coordinates encoded to a polyline string  |  **Required**<br>- [Google Polyline Algorithm](https://developers.google.com/maps/documentation/utilities/polylinealgorithm)<br> - The polyline can not represent more than 200 coordinates
`name` | Name of the route | **Optional**<br>Needs to be url encoded<br>E.g. 'Awesome Route' becomes 'Awesome%20Route' 	
`vehicleType` | C for Car/Motorcycle<br>B for Bicycle<br>P for Pedestrian | **Optional**<br>Defaults to C 	
`routeMode` | F for Fastest<br>S for Shortest<br>E for Efficient | **Optional**<br>Defaults to F 	
