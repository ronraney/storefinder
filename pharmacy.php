<?php
class Pharmacy{
 
    // database connection and table name
    private $conn;
    private $table_name = "pharmacies";
 
    // object properties
    public $id;
    public $name;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $lat;
    public $lng;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
// read products
function read(){
    // select all query
    $query = "SELECT
                *
            FROM
                " . $this->table_name . " 
            ";

    $stmt = $this->conn->prepare($query);
 
    $stmt->execute();
 
    return $stmt;
	}
// create pharmacy
function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, address=:address, city=:city, state=:state, zip=:zip, lat=:lat, lng=:lng";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->address=htmlspecialchars(strip_tags($this->address));
    $this->city=htmlspecialchars(strip_tags($this->city));
    $this->state=htmlspecialchars(strip_tags($this->state));
    $this->zip=htmlspecialchars(strip_tags($this->zip));
    $this->lat=htmlspecialchars(strip_tags($this->lat));
    $this->lng=htmlspecialchars(strip_tags($this->lng));
 
    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":address", $this->address);
    $stmt->bindParam(":city", $this->city);
    $stmt->bindParam(":state", $this->state);
    $stmt->bindParam(":zip", $this->zip);
    $stmt->bindParam(":lat", $this->lat);
    $stmt->bindParam(":lng", $this->lng);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
}