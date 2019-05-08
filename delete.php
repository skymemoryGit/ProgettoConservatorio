<?php
include 'libs/db_connect.php';
// delete sql query
$sql = "DELETE FROM studente WHERE matricola = ?";

// prepare the sql statement
if($stmt = $db->prepare($sql)){
  
    // bind the id of the record to be deleted
    // we use "i" here for integer
    $stmt->bindParam(1, $_GET['matricola']);
  
    // execute the delete statement
    if($stmt->execute()){


    // redirect to index page
        // parameter "action=deleted" is used to show that something was deleted
        header('Location: index.php?action=deleted');
  
    }else{
        die("Unable to delete.");
    }
  
}
?>
