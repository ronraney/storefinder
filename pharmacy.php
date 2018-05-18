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
}