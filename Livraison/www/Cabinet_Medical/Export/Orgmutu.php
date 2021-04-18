<?php require_once("../Connexion/Connexion.php");

header("Content-disposition: attachment; filename=orgmutu.txt");
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: text/plain\n");
header("Content-Length: ".filesize("../Export/" . "orgmutu.txt"));
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
header("Expires: 0");
readfile("../Export/" . "orgmutu.txt"); 

?>