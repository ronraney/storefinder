<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once 'core.php';
include_once 'utilities.php';
include_once 'database.php';
include_once 'pharmacy.php';
 
// utilities
$utilities = new Utilities();
 
// instantiate database and pharmacy object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$pharmacy = new Pharmacy($db);
 
// query pharmacies
$stmt = $pharmacy->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // pharmacies array
    $pharmacies_arr=array();
    $pharmacies_arr["records"]=array();
    $pharmacies_arr["paging"]=array();
 
    // retrieve our table contents

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $pharmacy_item=array(
            "id" => $id,
            "name" => $name,
            "address" => $address,
            "city" => $city,
            "state" => $state,
            "zip" => $zip,
            "lat" => $lat,
            "lng" => $lng,
        );
 
        array_push($pharmacies_arr["records"], $pharmacy_item);
    }
 
 
    // include paging
    $total_rows=$pharmacy->count();
    $page_url="{$home_url}read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $pharmacies_arr["paging"]=$paging;
 
    echo json_encode($pharmacies_arr);
}
 
else{
    echo json_encode(
        array("message" => "No pharmacies found.")
    );
}
?>