<?php 
  include ('config/config.php');
  include ('php/objects/_database.php');
 
//account
//attendee__c


	$db = new _database(0x0);



	$data = Array(
		"attendee_type__c"=>		$_POST['data']['attendeetype'],
		"company__c"=>				$_POST['account_id'],
		"country__c"=>				$_POST['data']['country'],
		"first_name__c"=>			$_POST['data']['firstname'],
		"last_name__c"=>			$_POST['data']['lastname'],
		"position__c"=>				$_POST['data']['position']
	);

	if($_POST['data']['attendeetype'] == "Guest"){
		$data['guest_company_name__c'] = $_POST["data"]["company"];
		$data['guest_email__c'] = $_POST["data"]["email"];
	}else{
		$data['email__c'] = $_POST["data"]["email"];
	}


	echo $db->update("salesforce.attendee__c",
		$data,
		Array(
			"sfid"=>$_POST['data']['sql_id']
		)
	);


function out($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

?>
