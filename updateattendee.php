<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


	$db = new _database(0x0);


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

	echo $db->update("salesforce.attendee__c",
		Array(
			"attendee_type__c"=>"attendee_type__c",
			"company__c"=>"company__c",
			"country__c"=>"country__c",
			"email__c"=>"email__c",
			"first_name__c"=>"first_name__c",
			"last_name__c"=>"last_name__c",
			"position__c"=>"position__c"
		),
		Array(
			"id"=>$_GET['sql_id']
		)
	);


function out($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

?>
