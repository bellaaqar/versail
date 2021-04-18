<?php require_once("../Connexion/Connexion.php");?>
<?php
 $query = "DELETE FROM ORGANISME WHERE ORGANISME_NUM =".$_GET["organismeNum"];
 $result = mysql_query("$query");
 if (!$result) 
 {
		    
	header("Location: ../Consultation_Organisme/?message=Erreur de supression");

 }
 else
 {
	mysql_free_result($result);
	header("Location: ../Consultation_Organisme/?message=Supression effectu&eacute;e");
	

 }
?>