<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'database.php';
 
// instantiate product object
include_once 'product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$pharmacy = new Pharmacy($db);
 
// get posted data-
$data = json_decode(file_get_contents("php://input"));
 
// set pharmacy property values
$pharmacy->name = $data->name;
$pharmacy->address = $data->address;
$pharmacy->city = $data->city;
$pharmacy->state = $data->state;
$pharmacy->zip = $data->zip;
$pharmacy->lat = $data->lat;
$pharmacy->lng = $data->lng;
$pharmacy->created = date('Y-m-d H:i:s');
 
// create the pharmacy
if($pharmacy->create()){
    echo '{';
        echo '"message": "Pharmacy was created."';
    echo '}';
}
 
// if unable to create the pharmacy, tell the user
else{
    echo '{';
        echo '"message": "Unable to create pharmacy."';
    echo '}';
}
?>