# Scenic-Integration
Scenic Integration is for online route planners and apps that want to offer a navigation solution to their users. I.e. users can use Scenic to navigate routes they create or find on your website or in your app.

This repository currently offers PHP, JavaScript and Swift Libraries to Integrate your website and iOS app with Scenic

## What's Scenic
Scenic is a Motorcycle Navigation App for iOS (iPhone/iPad/iPodTouch). With Scenic users can prepare, navigate and record/track/document their Motorcycle Trips. For more information see [MotoMappers.com](http://www.motomappers.com) and [Scenic on the App Store](https://itunes.apple.com/us/app/scenic-tour-planner-navigation/id1089668246)

## Integration Options
Currently Scenic offers 2 ways of integrating:

1. Provide links/buttons on your website or in your iOS app to send a route to Scenic.
2. User can access routes he/she creates/favorites on your site directly from Scenic and start navigating them. This kind of integration is custom and is not covered in this repository. If you're interested please feel free to [contact MotoMappers](mailto:support@motomappers). For an example please download the Scenic app and see how it already integrates with [Furkot](www.furkot.com) and [RouteYou](www.routeyou.com) in this way.

## Technical Options
There are 2 ways you can call the Scenic Universal Links

1. Using GET request (links with parameters included in the link)
2. Using POST request (the parameters are included in the body of the request)

POST request are recommended. This repository includes JavaScript, PHP and Swift libraries to make this easy to implement.
GET requests are easier to implement, but they have 2 disadvantages: (1) the route data (e.g. the url to the gpx file) is exposed to the public as it's inside the link and (2) url length is [limited to 2000 characters](http://stackoverflow.com/questions/417142/what-is-the-maximum-length-of-a-url-in-different-browsers) which could become a problem when using the polyline or coordinates universal links.

# GET requests
Using the GET requests is as simple as putting a link on your website. The link format is:
`https://scenicapp.space/Scenic/api/import/<endpointname>?<parameter1name>=<parameter1value>&<parameter2name>=<parameter2value>&...etc`
- Endpoint names are `gpxurl`, `polyline` and `coordinates`
- All parameter values need to be urlencoded EXCEPT polyline and coordinates
- If you use GET requests from another iOS app you need to include the parametername `fromOtherApp` with parametersvalue `1`. So, at the end of the url add `&fromOtherApp=1`

For more info and a full example see the HTTP-GET folder of this repository.

# POST requests
All the below text applies to POST requests

## Website Integration
To provide links/buttons for sending routes to Scenic from your website you need the **JavaScript** library or the **PHP** library.
The libraries recognize if a user is browsing on an iOS device or not: 
- If the user is browsing on an iOS device and Scenic is installed, Scenic will automatically open upon clicking the link/button. If Scenic is not installed the Scenic App Store page will open.
- If the user is not browsing on an iOS device the user is directed to a Scenic Webpage, upon where he/she can enter their Scenic credentials. The route is then uploaded to their Scenic account and upon opening Scenic on their device he/she will be notified that a route is ready to be imported.

### PHP Library
####Installation
Include scenicapi.php in your php page(s):
`include_once('scenicapi.php');`
####Usage
The php library offers 3 functions (i.e. 3 ways to send a route to Scenic):
- `sendToScenicForImport_gpxurl($gpxurl, $source)`
- `sendToScenicForImport_polyline($polyline, $name, $descr, $source)`
- `sendToScenicForImport_coordinates($coordinates, $name, $descr, $source)`

For more info and examples see the PHP folder of this repository.

### JavaScript Library
####Installation
Include scenicapi.js in your html page(s):
`<script src='scenicapi.js'></script>`
####Usage
The JavaScript library offers 3 functions (i.e. 3 ways to send a route to Scenic):
- `sendToScenicForImport_gpxurl(gpxurl, source)`
- `sendToScenicForImport_polyline(polyline, name, descr, source)`
- `sendToScenicForImport_coordinates(coordinates, name, descr, source)`

For more info and examples please see the JavaScript folder of this repository.

## iOS App Integration
To send routes from your iOS App to Scenic you need the **Swift** library. This library utilizes the universal links of the Scenic app. If the Scenic app is installed Scenic will automatically open. If Scenic is not installed the Scenic App Store page will open.

### Swift Library
The Swift Library is written in **Swift 3**
####Installation
Drag the `ScenicAPI.swift` file to your project. Make sure to check 'Copy items if needed'.
####Usage
Create an instance of the ScenicAPI class: `let scenic = scenicAPI()`

Now use any of the 3 available functions (i.e. 3 ways to send a route to Scenic):
- `scenic.sendToScenicForImport(gpxurl: String)`
- `scenic.sendToScenicForImport(polyline: String, name: String, descr: String)`
- `scenic.sendToScenicForImport(coordinates: Array<CLLocationCoordinate2D>, name: String, descr: String)`

For more info and an example project please see the Swift folder of this repository.


# FAQs
- How many route points can Scenic handle? -> Scenic can handle routes with thousands of points
- If I send a gpxurl, will that url need to be reachable forever? -> No, Scenic creates a copy of the GPX at the url and stores it (until the user imports it) on the Scenic server. Your URL can stop existing a few seconds after the user clicked the link.
- Will an imported route be stored on Scenic side? -> Yes. Whenever a user imports a route it will be added to his account so he can navigate it as much as he wants. The user can also edit it, duplicate it and publish it for all other Scenic users to see.




