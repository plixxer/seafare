<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


  $db = new _database(0x0);

  $exh_data = $db->getall('salesforce.attendee__c',
    Array(
      "id",
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
      'company__c'=>$_GET['account_id'],
      'attendee_type__c'=>'Exhibitor',
      'remove__c'=>false
    ),
    Array(
      "ascdesc"=>Array("first_name__c", "ASC")
    )
  );
  print_r(json_encode($exh_data, true));
  

function out($arr){
  echo "<pre>";
  print_r($arr);
  echo "</pre>";
}

?>
