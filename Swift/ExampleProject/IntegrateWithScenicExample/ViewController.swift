//
//  ViewController.swift
//  UniLinkTest
//
//  Created by Guido van Eijsden on 05/09/16.
//  Copyright © 2016 Guido van Eijsden. All rights reserved.
//

import UIKit
import CoreLocation

class ViewController: UIViewController {
    
    let scenic = ScenicAPI()
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    @IBAction func tappedButton(_ sender: AnyObject) {
        scenic.sendToScenicForImport(gpxurl: "http://www.motomappers.com/Accentrix.GPX")
    }
    
    @IBAction func tappedButton1(_ sender: AnyObject) {
        scenic.sendToScenicForImport(polyline: "_p~iF~ps|U_ulLnnqC_mqNvxq`@", name: "PolylineName Swift", descr: "Polyline Description Swift")
    }
    
    @IBAction func tappedButton2(_ sender: AnyObject) {
        var coordinates = Array<CLLocationCoordinate2D>()
        coordinates.append(CLLocationCoordinate2D(latitude: 28.5020112345,longitude: 77.0853534524))
        coordinates.append(CLLocationCoordinate2D(latitude: 28.5021994638,longitude: 77.0848774538))
        coordinates.append(CLLocationCoordinate2D(latitude: 28.5026335458,longitude: 77.0850589642))
        coordinates.append(CLLocationCoordinate2D(latitude: 28.5029786472,longitude: 77.085397485))
        scenic.sendToScenicForImport(coordinates: coordinates, name: "Coordinates Swift", descr: "Coordinates Descritpion Swift")
    }
    
}

