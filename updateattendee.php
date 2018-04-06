<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


try {
	$db = new _database(0x0);

	$db->update("salesforce.attendee__c",
		Array(
			"first_name__c"=> "Johnny"
		),
		Array(
			"id"=>$_POST['sql_id']
		)
	);
	echo 1;
	
} catch (Exception $e) {
	var_dump($e->getMessage());
}
	

function out($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

?>
