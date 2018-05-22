<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'database.php';
include_once 'pharmacy.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare pharmacy object
$pharmacy = new Pharmacy($db);
 
// get id of pharmacy to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of pharmacy to be edited
$pharmacy->id = $data->id;
 
// set pharmacy property values
$pharmacy->name = $data->name;
$pharmacy->address = $data->address;
$pharmacy->city = $data->city;
$pharmacy->state = $data->state;
$pharmacy->zip = $data->zip;
$pharmacy->lat = $data->lat;
$pharmacy->lng = $data->lng;
$pharmacy->updated = date('Y-m-d H:i:s');
 
// update the pharmacy
if($pharmacy->update()){
    echo '{';
        echo '"message": "Pharmacy was updated."';
    echo '}';
}
 
// if unable to update the pharmacy, tell the user
else{
    echo '{';
        echo '"message": "Unable to update pharmacy."';
    echo '}';
}
?>