<?php
class Database{
	
	private $host  = "db";
    private $user  = "user";
    private $password   = "password";
    private $database  = "appDB"; 
    
    public function getConnection(){	
        // $mysqli = new mysqli("db", "user", "password", "appDB");	
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>
