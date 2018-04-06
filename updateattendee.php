<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


	$db = new _database(0x0);

	$db->getall(
		Array(
			'*'
		),
		Array(
			'id'=>$_GET['sql_id']
		)
	);

	/*

	echo $db->update("salesforce.attendee__c",
		Array(
			"first_name__c"=> "Johnny"
		),
		Array(
			"id"=>$_POST['sql_id']
		)
	);
*/	

function out($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

?>
