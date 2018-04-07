
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
?>
<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


	$db = new _database(0x0);

	$optional= Array();
	if(!empty($_POST['orderby']) && !empty($_POST['order'])){
		$options = Array(
			"ascdesc"=>Array($_POST['orderby'], $_POST['order'])
		);
	}
	$optional['advanced'] = true;

	$exh_data = $db->getall('salesforce.attendee__c',
		Array(
			"sfid",
			"attendee_type__c",
			"company__c",
			"confirmation_number__c",
			"country__c",
			"email__c",
			"first_name__c",
			"last_name__c",
			"position__c",
			"remove__c"
		),
		Array(
			Array("company__c","=",$_GET['account_id']),
			Array("attendee_type__c","=",'Exhibitor'),
			Array("remove__c","=",false),
			Array("_hc_lastop","!=",'FAILED')
		),
		$optional
	);
	print_r(json_encode($exh_data, true));

?>
