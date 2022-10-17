<?php
class Orders{   
    
    private $ordersTable = "orders";      
    public $id;
    public $book_id;
    public $date_end;
    public $user_id;   
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
			INSERT INTO ".$this->ordersTable."(book_id, date_end, user_id)
			VALUES(?,?,?)");
		if( ! $stmt ){ //если ошибка - убиваем процесс и выводим сообщение об ошибке.
			die( "SQL Error: {$this->conn->errno} - {$this->conn->error}" );
		}
		$this->book_id = htmlspecialchars(strip_tags($this->book_id));
		$this->date_end = htmlspecialchars(strip_tags($this->date_end));
		$this->user_id = htmlspecialchars(strip_tags($this->user_id));
	
		$stmt->bind_param("isi", $this->book_id, $this->date_end, $this->user_id);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->ordersTable." 
			SET book_id= ?, date_end = ?, user_id = ?
			WHERE id = ?");
		if( ! $stmt ){ //если ошибка - убиваем процесс и выводим сообщение об ошибке.
			die( "SQL Error: {$this->conn->errno} - {$this->conn->error}" );
		}
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->book_id = htmlspecialchars(strip_tags($this->book_id));
		$this->date_end = htmlspecialchars(strip_tags($this->date_end));
		$this->user_id = htmlspecialchars(strip_tags($this->user_id));
	 
		$stmt->bind_param("isii", $this->book_id, $this->date_end, $this->user_id,$this->id);
		
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