<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__). $ds . '..') . $ds;

require_once("{$base_dir}includes{$ds}database.php"); // Including database

// class start
class Location
{
    private $table = 'user_location';

    public $id;
    public $user_id;
    public $longitude;
    public $latitude;
    public $address;
    
    // contructor
    public function __construct()
    {
    }
 
    // validating if params exists or not
    public function validate_params($value)
    {
        return (!empty($value));
    }

    // storing user location
    public function add_location()
    {
        global $database;

        $this->user_id = trim(htmlspecialchars(strip_tags($this->user_id)));
        $this->longitude = trim(htmlspecialchars(strip_tags($this->longitude)));
        $this->latitude = trim(htmlspecialchars(strip_tags($this->latitude)));
        $this->address = trim(htmlspecialchars(strip_tags($this->address)));
        
        $sql = "INSERT INTO $this->table (userID, longitude, latitude, address) VALUES (
            '" .$database->escape_value($this->user_id). "',
            '" .$database->escape_value($this->longitude). "',
            '" .$database->escape_value($this->latitude). "'
            '" .$database->escape_value($this->address). "'
            )";
            
        $result = $database->query($sql);
        
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // method to return the list of location per user
    public function get_location_per_user()
    {
        global $database;
        
        $this->user_id = trim(htmlspecialchars(strip_tags($this->user_id)));

        $sql = "SELECT * FROM $this->table WHERE userID = '" .$database->escape_value($this->user_id). "'";

        $result = $database->query($sql);

        return $database->fetch_array($result);
    }

} // class ends

// object
$location = new Location();