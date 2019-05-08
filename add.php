<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Create a Record </title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="libs/bootstrap-3.3.7-dist/css/bootstrap.min.css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body background="bg.jpg">

    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>REGISTRAZIONE STUDENTE</h1>
        </div>
 
<?php
 if($_POST){
    //include database connection
    include 'libs/db_connect.php';
  
    try{
  
        //write query
        $query = "INSERT INTO studente (matricola,nome,cognome) values (?,?,?)";
  
        //prepare query for excecution
        $stmt = $db->prepare($query);
  
        //bind the parameters
        //this is the first question mark
        $stmt->bindParam(1, $_POST['matricola']);
  
        //this is the second question mark
        $stmt->bindParam(2, $_POST['nome']);
  
        //this is the third question mark
        $stmt->bindParam(3, $_POST['cognome']);
  
       
  
        // Execute the query
        if($stmt->execute()){
            echo "Record was saved.";
        }else{
            die('Unable to save record.');
        }
  
    }catch(PDOException $exception){ //to handle error
        echo "Error: " . $exception->getMessage();
    }
}
?>


 <!-- html form here where the product information will be entered -->
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>matricola</td>
                    <td><input type='text' name='matricola' class='form-control' /></td>
                </tr>
                <tr>
                    <td>nome</td>
                    <td><input type='text' name='nome' class='form-control'></textarea></td>
                </tr>
                <tr>
                    <td>cognome</td>
                    <td><input type='text' name='cognome' class='form-control' /></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back Lista Studenti</a>
                    </td>
                </tr>
            </table>
        </form>

    </div> <!-- end .container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="libs/jquery-3.1.1.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="libs/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

</body>
</html>
