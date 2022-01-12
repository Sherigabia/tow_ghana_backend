<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__). $ds . '..') . $ds;

require_once("{$base_dir}includes{$ds}database.php"); // Including database
require_once("{$base_dir}includes{$ds}Bcrypt.php"); // Including Bcrypt

// Class user Start
class user
{
    private $table = 'user_details';

    public $id;
    public $firstname;
    public $lastname;
    public $phone_number;
    public $email;
    public $password;
    public $token;
    
    // contructor
    public function __construct()
    {
    }

    // validating if params exists or not
    public function validate_params($value)
    {
        return (!empty($value));
    }

    // to check if email is unique or not
    public function check_unique_email()
    {
        global $database;

        $this->email = trim(htmlspecialchars(strip_tags($this->email)));

        $sql = "SELECT id FROM $this->table WHERE email = '" .$database->escape_value($this->email). "'";

        $result = $database->query($sql);
        $user_id = $database->fetch_row($result);

        return empty($user_id);
    }

    //check unique phone number
    public function check_unique_phone_number(){
        global $database;
        $this->phone_number = trim(htmlspecialchars(strip_tags($this->phone_number)));

        $sql = "SELECT id FROM $this->table WHERE phone_number = '".$database->escape_value($this->phone_number)."' ";
        $result = $database->query($sql);
        $user_id = $database->fetch_row($result);

        return empty($user_id);
    }

    // saving new data in our database
    public function register_user()
    {
        global $database;

        $this->firstname = trim(htmlspecialchars(strip_tags($this->firstname)));
        $this->lastname = trim(htmlspecialchars(strip_tags($this->lastname)));
        $this->phone_number = trim(htmlspecialchars(strip_tags($this->phone_number)));
        $this->email = trim(htmlspecialchars(strip_tags($this->email)));
        $this->password = trim(htmlspecialchars(strip_tags($this->password)));
        
        $sql = "INSERT INTO $this->table (firstname, lastname, phone_number, email, password) VALUES (
            '" .$database->escape_value($this->firstname). "',
            '" .$database->escape_value($this->lastname). "',
            '" .$database->escape_value($this->phone_number). "',
            '" .$database->escape_value($this->email). "',
            '" .$database->escape_value(Bcrypt::hashPassword($this->password)). "'
       
        )";

        $user_saved = $database->query($sql);

        if ($user_saved) {
           return true;
        } else {
            return false;
        }
    }

    // login function
    public function login()
    {
        global $database;

        $this->email = trim(htmlspecialchars(strip_tags($this->email)));
        $this->password = trim(htmlspecialchars(strip_tags($this->password)));

        $sql = "SELECT * FROM $this->table WHERE email = '" .$database->escape_value($this->email). "'";

        $result = $database->query($sql);
        $user = $database->fetch_row($result);

        if (empty($user)) {
            return "User doesn't exist.";
        } else {
            if (Bcrypt::checkPassword($this->password, $user['password'])) {
                unset($user['password']);
                return $user;
            } else {
                return "Password doesn't match.";
            }
        }
    }
    // forgot Password function
    public function forgotPassword()
    {
        global $database;

        $this->phone_number = trim(htmlspecialchars(strip_tags($this->phone_number)));
      
        $sql = "SELECT * FROM $this->table WHERE phone_number = '" .$database->escape_value($this->phone_number). "'";

        $result = $database->query($sql);
        $update = $database->fetch_row($result);
        
        if ($update) {
                    // code to reset password goes here   
          $token = 256641;
          //md5($this->phone_number).rand(10,9999);
          $expFormat = mktime(
          date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
          );
          $expDate = date("Y-m-d H:i:s",$expFormat);
          $query = "UPDATE $this->table set   reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE phone_number='" .$this->phone_number . "'";
          $update = $database->query($query);
          if ($update) {
              return 'Password Token Sent ';
           } else {
               return false;
           }

        } else {
            return false;
        }
    }

    //update password function
    public function updatePassword(){
        global $database;

        $this->token = trim(htmlspecialchars(strip_tags($this->token)));
        $this->password = trim(htmlspecialchars(strip_tags($this->password)));

        $sql = "SELECT * FROM $this->table WHERE reset_link_token = '" .$database->escape_value($this->token). "'";

        $result = $database->query($sql);
        $update = $database->fetch_row($result);
        
        if ($update) {
            
          $query = "UPDATE $this->table set  password='" .$database->escape_value(Bcrypt::hashPassword($this->password))."' WHERE reset_link_token='" .$this->token . "'";
          $update = $database->query($query);
          if ($update) {
              return 'Password Updated';
           } else {
               return false;
           }

        } else {
            return false;
        }
    }
    // method to return the list of user
    public function all_users() {
        global $database;

        $sql = "SELECT id, firstname, lastname, email FROM $this->table";

        $result = $database->query($sql);

        return $database->fetch_array($result);
    }


    // // //forgot password function
    // public function forgotPassword()
    // {
    //     global $database;
    
    //     $this->email = trim(htmlspecialchars(strip_tags($this->email)));
    //     $sql = "SELECT * FROM $this->table WHERE email = '" .$database->escape_value($this->email). "'";

    //     $result = $database->query($sql);

    //     if($result->num_rows > 0){
    //         while($row = $result->fetch_assoc()){
    //         $id = $row
    //         }
    //     }
    // }
    
} // Class Ends

// user object
$user = new user();