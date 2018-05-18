<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
// include database and object file
include_once 'database.php';
include_once 'pharmacy.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare Pharmacy object
$pharmacy = new Pharmacy($db);
 
// get pharmacy id
$data = json_decode(file_get_contents("php://input"));
 
// set pharmacy id to be deleted
$pharmacy->id = $data->id;
 
// delete the pharmacy
if($pharmacy->delete()){
    echo '{';
        echo '"message": "Pharmacy was deleted."';
    echo '}';
}
 
// if unable to delete the pharmacy
else{
    echo '{';
        echo '"message": "Unable to delete object."';
    echo '}';
}
?>