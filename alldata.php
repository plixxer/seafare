<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


  $db = new _database(0x0);
  echo "attendee:<BR>";
  $exh_data = $db->getall('salesforce.attendee__c',
    Array(
      "*"
    ),
    Array(
      'Remove__c'=>false
    )
  );
  out($exh_data);
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
