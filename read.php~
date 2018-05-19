<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once 'database.php';
include_once 'pharmacy.php';
 
// instantiate database and pharmacy object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$pharmacy = new Pharmacy($db);
 
// query pharmacies
$stmt = $pharmacy->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // pharmacies array
    $pharmacies_arr=array();
    $pharmacies_arr["records"]=array();
 
    // retrieve our table contents
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        
        extract($row);
 
        $pharmacy_item=array(
            "id" => $id,
            "name" => $name,
            "address" => $address,
            "city" => $city,
            "state" => $state,
            "zip" => $zip,
            "lat" => $lat,
            "lng" => $lng
        );
 
        array_push($pharmacies_arr["records"], $pharmacy_item);
    }
 
    echo json_encode($pharmacies_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>