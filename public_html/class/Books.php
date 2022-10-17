<?php
class Books{   
    
    private $ordersTable = "books";      
    public $id;
    public $title;
    public $author;
    public $taken;   
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->ordersTable." WHERE ID = ?");
            
			$stmt->bind_param("i", $this->id);

			
            					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->ordersTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->ordersTable."(title,author,taken)
			VALUES(?,?,?)");
		if( ! $stmt ){ //если ошибка - убиваем процесс и выводим сообщение об ошибке.
			die( "SQL Error: {$this->conn->errno} - {$this->conn->error}" );
		}
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->author = htmlspecialchars(strip_tags($this->author));
		$this->taken = htmlspecialchars(strip_tags($this->taken));
	
		$stmt->bind_param("ssi", $this->title, $this->author, $this->taken);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->ordersTable." 
			SET title= ?, author = ?, taken = ?
			WHERE id = ?");
		if( ! $stmt ){ //если ошибка - убиваем процесс и выводим сообщение об ошибке.
			die( "SQL Error: {$this->conn->errno} - {$this->conn->error}" );
		}
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->author = htmlspecialchars(strip_tags($this->author));
		$this->taken= htmlspecialchars(strip_tags($this->taken));
	 
		$stmt->bind_param("ssii", $this->title, $this->author, $this->taken,$this->id);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	function delete(){
		
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->ordersTable." 
			WHERE id = ?");
		if( ! $stmt ){ //если ошибка - убиваем процесс и выводим сообщение об ошибке.
			die( "SQL Error: {$this->conn->errno} - {$this->conn->error}" );
		}
		$this->id = htmlspecialchars(strip_tags($this->id));
	 
		$stmt->bind_param("i", $this->id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}