<?php

include ('Database.php');

class User{

	//class level properties
	public $id;
	public $name;
	public $email;
	public $secondaryemail;
	public $address;
	public $city;
	public $zipcode;
	public $phonenumber;
	public $password;

	public function __construct($passed_user){
		 
		$this->id = $passed_user;
		
		$database = new Database();
		
		$database->query('SELECT *
							FROM edh_users
							WHERE id = :id');
		
		$database->bind(':id', $passed_user);
		
		$row = $database->single();
		
		//populate the class level properties
		$this->id = $row['id'];
		$this->name = $row['name'];
		$this->email = $row['email'];
		$this->secondaryemail = $row['secondaryemail'];
		$this->address = $row['address'];
		$this->city = $row['city'];
		$this->zipcode = $row['zipcode'];
		$this->phonenumber = $row['phonenumber'];
		$this->password = $row['password'];
	}
	
	public function displaySimpleProfile(){


		print "<h1>" . $this->id ." " .$this->name . " " . "</h1>";
		print "<table>
				<tr><th>Email:</th><td> " . $this->email ."</td>
				<th>Secondary Email:</td><td> " . $this->secondaryemail ."</td></tr>
				<tr><th>Address:</td><td> " . $this->address ."</td>
				<th>City:</td><td> " . $this->city ."</td></tr>
				<th>Zip-code:</th><td> " . $this->zipcode ."</td>
				<th>Phone number:</th><td> " . $this->phonenumber ."</td>
				</table>";
		

		


	}
	
}
?>








