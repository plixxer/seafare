<?php 
  include ('config/config.php');
  include ('php/objects/_database.php');
 
//account
//attendee__c


  $db = new _database(0x0);
  echo "ACCOUNT:<BR>";

  $exh_data = $db->getall('salesforce.account',
    Array(
      "*"
    )
  );
  out($exh_data);
  

function out($arr){
  echo "<pre>";
  print_r($arr);
  echo "</pre>";
}

?>
