<?php

	class Database{
		private $host = "sql2.njit.edu";
		private $user = "cecc";
		private $pass = "slavonic7";
		private $dbname = "cecc";
		private $dbh;
		private $error;
		private $stmt;

		public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        	// Create a new PDO instanace
	        try{
	            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
	        }
	        // Catch any errors
	        catch(PDOException $e){
	            $this->error = $e->getMessage();
	        }
        }//end construct
        
        
        
        
        public function query($query){
			$this->stmt = $this->dbh->prepare($query);
		}//end of query
		
		public function bind($param, $value, $type = null){
			if (is_null($type)) {
				switch (true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}
			$this->stmt->bindValue($param, $value, $type);
		}//end of bind
				
		public function execute(){
    		return $this->stmt->execute();
		}
		
		
		public function lastInsertId(){
    		return $this->dbh->lastInsertId();
		}
		
		public function resultset(){
   			
			$this->execute();
   		 	
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);

		}//end of result set
				
		
		public function single(){
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}//end of single
		
		
		public function rowCount(){
    		return $this->stmt->rowCount();
		}//end of rowCount

		public function beginTransaction(){
    		return $this->dbh->beginTransaction();
		}
		
		public function endTransaction(){
    		return $this->dbh->commit();
		}
		public function cancelTransaction(){
   			return $this->dbh->rollBack();
		}			
		public function debugDumpParams(){
    		return $this->stmt->debugDumpParams();
		}		
		
	}//end databse



?>
