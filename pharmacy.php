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
// used when filling up the update pharmacy form
function readOne(){
 
    // query to read single record
    $query = "SELECT
                *
            FROM
                " . $this->table_name . " p
            WHERE
                p.id = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->name = $row['name'];
    $this->address = $row['address'];
    $this->city = $row['city'];
    $this->state = $row['state'];    
    $this->zip = $row['zip'];
	 $this->lat = $row['lat'];
	 $this->lng = $row['lng'];
}
// update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                name=:name, address=:address, city=:city, state=:state, zip=:zip, lat=:lat, lng=:lng;
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->address=htmlspecialchars(strip_tags($this->address));
    $this->city=htmlspecialchars(strip_tags($this->city));
    $this->state=htmlspecialchars(strip_tags($this->state));
    $this->zip=htmlspecialchars(strip_tags($this->zip));
    $this->lat=htmlspecialchars(strip_tags($this->lat));
    $this->lng=htmlspecialchars(strip_tags($this->lng));
 
    // bind new values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":address", $this->address);
    $stmt->bindParam(":city", $this->city);
    $stmt->bindParam(":state", $this->state);
    $stmt->bindParam(":zip", $this->zip);
    $stmt->bindParam(":lat", $this->lat);
    $stmt->bindParam(":lng", $this->lng);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
// delete the product
function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
// search products
function search($keywords){
 
    // select all query
    $query = "SELECT
                *
            FROM
                " . $this->table_name . " p
            WHERE
                p.name LIKE ? OR p.address LIKE ? OR p.city LIKE ? OR p.state LIKE ? OR p.zip LIKE ?
            ORDER BY
                p.state, p.city";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
    $stmt->bindParam(4, $keywords);
    $stmt->bindParam(5, $keywords);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
// read products with pagination
public function readPaging($from_record_num, $records_per_page){
 
    // select query
    $query = "SELECT
                *
            FROM
                " . $this->table_name . " p
            ORDER BY p.state, p.city
            LIMIT ?, ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values from database
    return $stmt;
}
// used for paging products
public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    return $row['total_rows'];
}
}