<?php require_once("../Connexion/Connexion.php");?>
<?php
 $query = "DELETE FROM COMMANDE WHERE COMMANDE_NUM =".$_GET["commandeNum"];
 $result = mysql_query("$query");
 if (!$result) 
 {
		    
	header("Location: ../Commande_Client/?clientNum=".$_GET["clientNum"]."&message=Erreur de supression");

 }
 else
 {
	mysql_free_result($result);
	header("Location: ../Commande_Client/?clientNum=".$_GET["clientNum"]."&message=Supression effectu%E9e");
	

 }
?>