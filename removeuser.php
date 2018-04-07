<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


$db = new _database(0x0);

$ids = json_decode($_POST['ids']);

$datas = Array();
foreach ($ids as $key => $value) {
	array_push(
		$datas,
		$db->remove(
			'salesforce.attendee__c',
			Array(
				'sfid'=>$value
			)
		)
	);
}
print_r(json_encode($datas, true));
?>
