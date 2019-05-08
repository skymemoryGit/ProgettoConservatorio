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
<?php
$visual='False';
if($visual=='False'){
echo('
<h1>PDO: Read Records</h1><form action="index_log.php" method="GET">
Nome utente:<br>
<input type="text" name="user"  placeholder="username">
<br>
Password:<br>
<input type="password" name="psw"  placeholder="**********">
<input type="submit" value="Invia">
</form>');

$user=$_REQUEST["user"];
$psw=$_REQUEST["psw"];
$_SESSION["user"] = $user;
$_SESSION["psw"] = $psw;


if (empty($_REQUEST['user']) || empty($_REQUEST['psw'])) {
echo("Username or Password is invalid");
}
else{
if(isset($_SESSION["user"])){
	
		echo("Benvenuto ".$user."!");
		
	}
	$visual='True';
}
}
if($visual=='True'){
echo('<form action="index_log.php" method="GET">
<input type="submit" value="Logout">
</form>');
$action = isset($_GET['action']) ? $_GET['action'] : "";
  
// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div>Record was deleted.</div>";
}


//include database connection
include 'libs/db_connect.php';

//select all data

$query = "SELECT id, firstname, lastname, username FROM ye_isuru";
$stmt = $con-> prepare( $query );
$stmt->execute();
  
//this is how to get number of rows returned
$num = $stmt->rowCount();
  
//check if more than 0 record found
if($num>0){
  
    //start table
    echo "<table border='1'>";
  
        //creating our table heading
        echo "<tr>";
            echo "<th>Firstname</th>";
            echo "<th>Lastname</th>";
            echo "<th>Username</th>";
            echo "<th>Action</th>";
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
                echo "<td>{$firstname}</td>";
                echo "<td>{$lastname}</td>";
                echo "<td>{$username}</td>";
                echo "<td>";
                    //we will use this links on next part of this post
                    echo "<a href='edit.php?id={$id}'>Edit</a>";
                    echo " / ";
                    //we will use this links on next part of this post
                    echo "<a href='#' onclick='delete_user( {$id} );'>Delete</a>";
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
}
?> 

<!-- dynamic content will be here -->

 
</body>
</html>
