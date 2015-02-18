
<?php


require_once('connect.php');

class Admin{

	//class level properties
	public $id;
	public $userid;
	public $contentid;
	public $organizationid;

	public function __construct($passed_admin){
		
		$this->id = $passed_admin;
		
		$database = new Database();
		
		$database->query('SELECT *
							FROM edh_ads
							WHERE id = :userid');
		
		$database->bind(':userid', $passed_admin);
		
		$row = $database->single();
		
		//populate the class level properties
		$this->id = $row['id'];
		$this->userid = $row['userid'];
		$this->contentid = $row['contentid'];
		$this->organizationid = $row['organizationid'];
	}
?>








