<?php 
  include ('config/config.php');
  include ('php/objects/_database.php');
 
 
//account
//attendee__c


$db = new _database(0x0);
$exh_data = $db->getall('salesforce.CountryList__c',
	Array(
		"name"
	)
);

$country_list = Array();
foreach ($exh_data as $key => $value) {
	array_push($country_list, $value['name']);
}
sort($country_list);
print_r(json_encode($country_list, true));
	

function out($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

?>
