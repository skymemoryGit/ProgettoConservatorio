<!DOCTYPE HTML>
<html>
    <head>
        <title>PDO Read Records - code from codeofaninja.com</title>
  
    </head>

<script type='text/javascript'>
function delete_user( id ){
  
    var answer = confirm('Are you sure?');
    if ( answer ){
  
        //if user clicked ok, pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id=' + id;
    }
}
</script>
<body>
<!-- just a header label -->
<h1>PDO: Read Records</h1>
  
<?php
$action = isset($_GET['action']) ? $_GET['action'] : "";
  
// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div>Record was deleted.</div>";
}


//include database connection
include 'libs/db_connect.php';
  
//select all data
$query = "SELECT matricola, nome, cognome FROM studente";
$stmt = $db-> prepare( $query );
$stmt->execute();
  
//this is how to get number of rows returned
$num = $stmt->rowCount();
  
//check if more than 0 record found
if($num>0){
  
    //start table
    
    echo "<table border='1'>";
  
        //creating our table heading
        echo "<tr>";
            echo "<th>MATRICOLA</th>";
            echo "<th>NOME</th>";
            echo "<th>COGNOME</th>";
            echo "<th>OPERAZIONI</th>";
            
        echo "</tr>";
  
        //retrieve our table contents
        //fetch() is faster than fetchAll()
        //http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //extract row
            //this will make $row['firstname'] to
            //just $firstname only
            extract($row);
  
            //creating new table row per record
            echo "<tr>";
                echo "<td>{$matricola}</td>";
                echo "<td>{$nome}</td>";
                echo "<td>{$cognome}</td>";
                echo "<td>";
                    //we will use this links on next part of this post
                    echo "<a href='edit.php?matricola={$matricola}'>Edit</a>";
                    echo " / ";
                    //we will use this links on next part of this post
                    echo "<a href='#' onclick='delete_user( {$matricola} );'>Delete</a>";
                echo "</td>";
            echo "</tr>";
        }
  
    //end table
    echo "</table>";
  
}
  
//if no records found
else{
    echo "No records found.";
}
?> 
<!-- dynamic content will be here -->
 
</body>
</html>
