<?php require_once("../Connexion/Connexion.php");

$filename = "orgsecu.txt";
$chemin = "../Export/";
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=".$filename);
readfile($chemin.$filename); 


/*header("Content-disposition: attachment; filename=orgsecu.txt");
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: text/plain\n");
header("Content-Length: ".filesize("../Export/" . "orgsecu.txt"));
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
header("Expires: 0");
readfile("../Export/" . "orgsecu.txt"); */

?>