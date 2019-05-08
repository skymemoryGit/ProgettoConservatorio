<?php
	//print_r(PDO::getAvailableDrivers());
	$dbname='yejianchen';
	$dbusername='postgres';	
	$dbpassword='1234';		
	
	// Connessione al database
	//Nuova istanza della classe PDO
	try{
		$db=new PDO("pgsql:dbname=$dbname",$dbusername,$dbpassword);
		//Se ci sono errori li scrive
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connessione col DB OK";
		//echo "passo dopo la stringa connessione";
    
    
    }
	catch (PDOException $e) {
		echo "Errore". $e->getMessage();
		}
		

		//echo "dopo catch";

		/*
		$sql=$db->query("SELECT * FROM studente;");
		$sql->setFetchMode(PDO::FETCH_BOTH);


		
				while($row=$sql->fetch()){
					
						$lstStand=$row;
				  echo '<tr><td>'.$row['matricola'].'</td><td>'.$row['nome'].'</td><td>'.$row['cognome'].'</td>';
					}
			*/

			


 
?>
	


		

