<?php 
  include ('config/config.php');
  include ('php/objects/_database.php');
 
//account
//attendee__c


	$db = new _database(0x0);

	$optional= Array();
	if(!empty($_POST['orderby']) && !empty($_POST['order'])){
		$optional = Array(
			"ascdesc"=>Array($_POST['orderby'], $_POST['order'])
		);
	}
	$optional['advanced'] = true;

	$guest_data = $db->getall('salesforce.attendee__c',
		Array(
			"sfid",
			"attendee_type__c",
			"company__c",
			"guest_company_name__c",
			"confirmation_number__c",
			"country__c",
			"guest_email__c",
			"first_name__c",
			"last_name__c",
			"position__c",
			"remove__c"
		),
		Array(
			Array("company__c","=",$_POST['account_id']),
			Array("attendee_type__c","=",'Guest'),
			Array("remove__c","=",false),
			Array("_hc_lastop","!=",'FAILED')
		),
		$optional
	);
	print_r(json_encode($guest_data, true));
?>
