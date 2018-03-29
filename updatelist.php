<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
 
//account
//attendee__c


  $db = new _database(0x0);

  $exh_data = $db->update('salesforce.attendee__c',
    Array(
      $_POST['field'] => $_POST['value']
    ),
    Array(
      'id'=>$_POST['id']
    )
  );
  print_r(json_encode($exh_data, true));

?>
