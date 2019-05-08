<!DOCTYPE HTML>
<html>
    <head>
        <title>Update A Record</title>
  
    </head>
<body>
 
<!-- dynamic content will be here -->
<?php
//include database connection
include 'libs/db_connect.php';
 
if($_POST){
    try{
  
        //write query
        //in this case, it seemed like we have so many fields to pass and
        //its kinda better if we'll label them and not use question marks
        //like what we used here
        $query = "update studente
                    set matricola = :matricola, nome = :nome, cognome = :cognome
                    where matricola = :matricola";
  
        //prepare query for excecution
        $stmt = $db->prepare($query);
  
        //bind the parameters
        $stmt->bindParam(':matricola', $_POST['matricola']);
        $stmt->bindParam(':nome', $_POST['nome']);
        $stmt->bindParam(':cognome', $_POST['cognome']);
        
  
        // Execute the query
        if($stmt->execute()){
            echo "Record was updated.";
        }else{
            die('Unable to update record.');
        }
  
    }catch(PDOException $exception){ //to handle error
        echo "Error: " . $exception->getMessage();
    }
}
?> 


<?php
try {
  
    //prepare query
    $query = "select matricola, nome, cognome from studente where matricola = ? ";
    $stmt = $db->prepare( $query );
  
    //this is the first question mark
    $stmt->bindParam(1,$_REQUEST['matricola']);
  
    //execute our query
    $stmt->execute();
  
    //store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    //values to fill up our form
    $matricola = $row['matricola'];
    $nome = $row['nome'];
    $cognome= $row['cognome'];
    
  
}catch(PDOException $exception){ //to handle error
    echo "Error: " . $exception->getMessage();
}
?>


!--we have our html form here where new user information will be entered-->
<form action='#' method='post' border='0'>
    <table>
        <tr>
            <td>nome</td>
            <td><input type='text' name='nome' value='<?php echo $nome;?>' /></td>
        </tr>
        <tr>
            <td>cognome</td>
            <td><input type='text' name='cognome' value='<?php echo $cognome;?>' /></td>
        </tr>
        
        
            <td></td>
            <td>
                <!-- so that we could identify what record is to be updated -->
                <input type='hidden' name='matricola' value='<?php echo $matricola ?>' />
 
                <input type='submit' value='Edit' />
  
                <a href='index_log.php'>Back to index</a>
            </td>
        </tr>
    </table>
</form>


<h1>PDO: Update a Record</h1>
  
</body>
</html>
