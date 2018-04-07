<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


	$db = new _database(0x0);

	$exhinfo_data = $db->getall('salesforce.account',
		Array(
			"name",
			"cy_booth_number__c",
			"company_name_in_directory__c",
			"exh_country__c",
			"cy_attendee_allotment__c",
			"cy_additional_attendees__c"
		), Array(
			Array("sfid","=", $_POST['account_id']),
			Array("isdeleted","=", false),
			Array("_hc_lastop","!=", 'FAILED')
		),
		Array(
			'advanced'=>true
		)
	);

	$guest_data = $db->getall('salesforce.attendee__c',
		Array(
			"sfid"
		),
		Array(
			Array("Company__c","=", $_POST['account_id']),
			Array("Attendee_Type__c","=", 'Guest'),
			Array("Remove__c","=", false),
			Array("_hc_lastop","!=", 'FAILED')
		),
		Array(
			'advanced'=>true
		)
	);

	$exh_data = $db->getall('salesforce.attendee__c',
		Array(
			"sfid"
		),
		Array(
			Array("Company__c","=", $_POST['account_id']),
			Array("Attendee_Type__c","=", 'Exhibitor'),
			Array("Remove__c","=", false),
			Array("_hc_lastop","!=", 'FAILED')
		),
		Array(
			'advanced'=>true
		)
	);

	$data = Array(
		"name"=>$exhinfo_data[0]['name'],
		"booth_number"=>$exhinfo_data[0]['cy_booth_number__c'],
		"country"=>$exhinfo_data[0]['exh_country__c'],
		"attendee_allotment"=>$exhinfo_data[0]['cy_attendee_allotment__c'] + $exhinfo_data[0]['cy_additional_attendees__c'],
		"directory_cname"=>$exhinfo_data[0]['company_name_in_directory__c'],
		"attendees"=>intval(count($exh_data)),
		"guests"=>intval(count($guest_data)),
	);
	print_r(json_encode($data, true));

/*
	out(count($guest_data));
	out(count($exh_data));
	out($exhinfo_data);
	

function out($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

*/
?>
