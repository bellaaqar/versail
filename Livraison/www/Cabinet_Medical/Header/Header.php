<?php

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">';
 echo ' <head>';
  echo '  <title>Etablissement Jean Labb&eacute; Orthop&eacute;die</title>';
  echo '  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />';
  echo '  <meta http-equiv="Content-Language" content="fr" />';
  echo '  <meta http-equiv="Content-Script-Type" content="text/javascript" />';
  echo '  <meta http-equiv="Content-Style-Type" content="text/css" />';
  echo '  <meta name="DC.Language" scheme="RFC3066" content="fr" />';
  echo '  <script language="JavaScript" src="../Scripts/functions.js"></script>';
   echo '  <script language="JavaScript" src="../Scripts/calendar.js"></script>';

  echo '  <link rel="stylesheet" href="../Styles/style.css" type="text/css" media="screen" title="Normal" />';
   echo '  <link rel="stylesheet" href="../Styles/calendar.css" type="text/css" media="screen" />';
 echo ' </head>';
 echo ' <body>';
 echo '   <div id="page">';
  echo '    <div id="header">';
    echo '    <div class="logo"> <img src="../Images/interface/logo.GIF"/></div>';
    if(isset($_SESSION['Utilisateur']))
    {
     echo '     <span class="deconnexion" ><a href="../Authentification/?out=1">D&eacute;connexion</a></span>';
    }
   echo '   <a href="../Accueil/">';
 
   echo '     <span class="titre2">Podo Orthop&eacute;die </span>';
   echo '     <span class="titre1">Etablissement Jean Labb&eacute; Orthop&eacute;die</span>';
   
   echo '   </a>';
   echo '   </div>';
     ?>
