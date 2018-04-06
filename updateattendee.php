<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


	$db = new _database(0x0);

	print_r(
	Array(
			"first_name__c"=> $_POST["data"]["firstname"]
		));

	$db->update("salesforce.attendee__c",
		Array(
			"first_name__c"=> $_POST["data"]["firstname"]
		),
		Array(
			"id"=>$_POST['sql_id']
		)
	);
	echo 1;
	

function out($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

?>
