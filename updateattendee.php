<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


	$db = new _database(0x0);

/*

	echo "test";

	$t = $db->getall("salesforce.attendee__c",
		Array(
			"attendee_type__c",
			"company__c",
			"country__c",
			"email__c",
			"first_name__c",
			"last_name__c",
			"position__c"
		),
		Array(
			'id'=>$_GET['sql_id']
		)
	);

	out($t);


	echo "update<br>";
	*/

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
			"id"=>$_POST['data']['sql_id']
		)
	);


function out($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

?>
