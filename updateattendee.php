<?php 
  include ('config/config.php');
  include ('php/objects/_database.php');
 
//account
//attendee__c


	$db = new _database(0x0);

	echo $db->update("salesforce.attendee__c",
		Array(
			"attendee_type__c"=>		$_POST['data']['attendeetype'],
			"company__c"=>				$_POST['account_id'],
			"country__c"=>				$_POST['data']['country'],
			"email__c"=>				$_POST['data']['email'],
			"first_name__c"=>			$_POST['data']['firstname'],
			"last_name__c"=>			$_POST['data']['lastname'],
			"position__c"=>				$_POST['data']['position']
		),
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
