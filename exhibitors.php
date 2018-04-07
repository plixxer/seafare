<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


  $db = new _database(0x0);

  $conditions= Array();
  if(!empty($_POST['orderby']) && !empty($_POST['order'])){
    $options = Array(
      "ascdesc"=>Array($_POST['orderby'], $_POST['order'])
    );
  }

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
      Array("company__c","=",$_POST['account_id']),
      Array("attendee_type__c","=",'Exhibitor'),
      Array("remove__c","=",false),
      Array("_hc_lastop","!=",'FAILED')
    ),
    $conditions,
    Array(
      'advanced'=>true
    )
  );
  print_r(json_encode($exh_data, true));

?>
