<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once 'database.php';
include_once 'pharmacy.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare Pharmacy object
$pharmacy = new Pharmacy($db);
 
// set ID property of pharmacy to be edited
$pharmacy->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of pharmacy to be edited
$pharmacy->readOne();
 
// create array
$pharmacy_arr = array(
    "id" =>  $pharmacy->id,
    "name" => $pharmacy->name,
    "address" => $pharmacy->address,
    "city" => $pharmacy->city,
    "state" => $pharmacy->state,
    "zip" => $pharmacy->zip,
    "lat" => $pharmacy->lat,
    "lng" => $pharmacy->lng 
);
 
// make it json format
print_r(json_encode($pharmacy_arr));
?>
