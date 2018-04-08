<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


	$db = new _database(0x0);


	$optional= Array();
	$optional['advanced'] = true;

	$exhinfo_data = $db->getall('salesforce.account',
		Array(
			"cy_attendee_allotment__c",
			"cy_additional_attendees__c"
		),
		Array(
			Array("sfid","=",$_POST['account_id']),
			Array("isdeleted","=",false),
			Array("_hc_lastop","!=",'FAILED')
		),
		$optional
	);
	$exh_data = $db->getall('salesforce.attendee__c',
		Array(
			"sfid"
		),
		Array(
			Array("company__c","=",$_POST['account_id']),
			Array("attendee_type__c","=",'Exhibitor'),
			Array("remove__c","=",false),
			Array("_hc_lastop","!=",'FAILED')
		),
		$optional
	);

	$guest_data = $db->getall('salesforce.attendee__c',
		Array(
			"sfid"
		),
		Array(
			Array("company__c","=",$_POST['account_id']),
			Array("attendee_type__c","=",'Guest'),
			Array("remove__c","=",false),
			Array("_hc_lastop","!=",'FAILED')
		),
		$optional
	);

	if( (count($exh_data) + count($guest_data)) <= $exhinfo_data[0]['cy_attendee_allotment__c'] + $exhinfo_data[0]['cy_additional_attendees__c']){
		$data = Array(
			"attendee_type__c"=> $_POST["data"]["attendeetype"],
			"company__c"=> $_POST["account_id"],
			"country__c"=> $_POST["data"]["country"],
			"email__c"=> $_POST["data"]["email"],
			"first_name__c"=> $_POST["data"]["firstname"],
			"last_name__c"=> $_POST["data"]["lastname"],
			"position__c"=> $_POST["data"]["position"],
			"remove__c"=>false
		);
		if($_POST["data"]["attendeetype"] == "Guest"){
			$data['guest_company_name__c'] = $_POST["data"]["company"];
		}
		$insert = $db->insert("salesforce.attendee__c",
			$data
		);
		echo 1;
	}else{
		echo 2;
	}
	

function out($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

?>
