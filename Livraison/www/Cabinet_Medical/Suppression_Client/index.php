<?php require_once("../Connexion/Connexion.php");?>
<?php
 $query = "DELETE FROM CLIENT WHERE CLIENT_NUM =".$_GET["clientNum"];
 $result = mysql_query("$query");
 if (!$result) 
 {
		    
	header("Location: ../Consultation_Client/?message=Erreur de supression");

 }
 else
 {
	mysql_free_result($result);
	header("Location: ../Consultation_Client/?message=Supression effectu%E9e");
	

 }
?>