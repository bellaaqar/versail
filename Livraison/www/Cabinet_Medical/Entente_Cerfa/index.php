<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Etablissement Jean Labb&eacute; Orthop&eacute;die</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="Content-Language" content="fr" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="DC.Language" scheme="RFC3066" content="fr" />
    <link rel="stylesheet" type="text/css" href='http://localhost/Livraison/www/Cabinet_Medical/Styles/entente_cerfa.css' />

    
</head>
<body>
    <div id="page">
        <?php require_once("../Connexion/Connexion.php");?>
         <?php
            $query = "SELECT * FROM  COMMANDE  INNER JOIN CLIENT ON COMMANDE_CLIENT_NUM = CLIENT_NUM LEFT JOIN ORGANISME ON CLIENT_ORGANISME = ORGANISME_NUM WHERE COMMANDE_NUM =".$_GET["commandeNum"]." AND COMMANDE_CLIENT_NUM =".$_GET["clientNum"];
            
            $result = mysql_query($query);         
            if (!$result) 
            {
              die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
             
             
              while ($row = mysql_fetch_array($result)) 
              {
                
                echo "<div id=ligne1>";
                echo "<div id=nuss>";
                echo substr($row["CLIENT_NSS"],0,18);   
                echo "</div>";
                echo "<div id=nuss-suite>";
                echo substr($row["CLIENT_NSS"],-2);                
                echo "</div>";
                echo "<div id=organisme>";
                 echo $row["ORGANISME_CODE"];
                echo "</div>";
                echo "</div>";
                
                echo "<div id=ligne11>";
                echo $row["CLIENT_CODE_AFFILIATION_ORGANISME"];   
                echo "</div>";
               
                
                
                
                echo "<div id=ligne2>";
                echo "<div id=nom>";
                echo $row["CLIENT_NOM"];
                echo "</div>";
                echo "<div id=prenom>";
                echo $row["CLIENT_PRENOM"];
                echo "</div>";
                echo "</div>";
                
                echo "<div id=ligne3>";
                echo "<div id=identif>";
                echo $row["COMMANDE_PRESCRIPTEUR_CODE"];
                echo "</div>";
                echo "<div id=identif-pres>";
                echo $row["COMMANDE_PRESCRIPTEUR"];
                echo "</div>";
                echo "<div id=date>";
                echo $row["COMMANDE_DATE_PRESCRIPTION"];
                echo "</div>";
                echo "</div>";
                
                
                
                $display1="display:none";
                $display2="display:none";
                $display3="display:none";
                $display4="display:none";
                $display5="display:none";
                
                switch($row["COMMANDE_ATTRIBUTION"])
                {
                    case "1": $display1=""; break;
                    case "2": $display2=""; break;
                    case "3": $display3=""; break;
                    case "4": $display4=""; break;
                    case "5": $display5=""; break;
                    default:break;
                }
                
                echo "<div id=ligne7 style='".$display1."'>";
                echo "<img src='../Images/interface/valide.JPG'/>";
                echo "</div>";
                
                echo "<div id=ligne8 style='".$display2."'>";
                 echo "<img src='../Images/interface/valide.JPG'/>";
                echo "</div>";
                
                echo "<div id=ligne9 style='".$display3."'>";
                 echo "<img src='../Images/interface/valide.JPG'/>";
                echo "</div>";
                
                 echo "<div id=ligne12 style='".$display4."'>";
                 echo "<img src='../Images/interface/valide.JPG'/>";
                echo "</div>";
                
                 echo "<div id=ligne13 style='".$display5."'>";
                 echo "<img src='../Images/interface/valide.JPG'/>";
                echo "</div>";
                
                
                
                echo "<div id=ligne4>";
                echo "<table>";
                
                $refProduits = explode ("-",$row["COMMANDE_PRODUITS"]);
                $produitDesignation = "";
                $imgCodeBarre = "";
                $prix = 0;
                $TVA = 0;
                foreach($refProduits as $valeur)
                { 
                      if(strlen($valeur)>0)
                     {
                             $valsCalculateur = explode(".", $valeur);
                             
                             $nb = $valsCalculateur[0];
                             $produit = $valsCalculateur[1];
                         if($produit!="" && $produit!="000000")
                         {
                             $queryProduit = "SELECT * FROM  PRODUIT  WHERE PRODUIT_CODE = '".$produit."'";
                             $resultProduit = mysql_query($queryProduit);
                            
                             while ($rowProduit = mysql_fetch_array($resultProduit)) 
                             {
                                
                                
                                $prix           += $nb * $rowProduit["PRODUIT_PRIX"];
                                $prixHtProduit  = ($rowProduit["PRODUIT_PRIX"]/(1.055));
                                echo ' <tr>';
                                echo ' <td >';
                                echo $rowProduit["PRODUIT_DESIGNATION"];
                                echo ' </td>';
                                echo ' <td>';
                                echo $rowProduit["PRODUIT_CODE"];
                                if($rowProduit["PRODUIT_CODE_BARRE"] ==  "OUI")
                                {
                                    $imgCodeBarre = $imgCodeBarre."<img src='../Images/interface/".$rowProduit["PRODUIT_CODE"].".JPG'/><br/>";
                                }
                                echo ' </td>';
                                echo ' <td>';
                                $prixHT = $nb * round($prixHtProduit,2); 
                                
                                $TVA += ($nb * $rowProduit["PRODUIT_PRIX"]) - $prixHT;
                                echo $nb ." X " . $prixHT/$nb ." &euro;" ;
                                echo ' </td>';
                                echo ' </tr>';    
                                
                                
                                
                               
                             }
                         }
                     }
                     
                     
                     
                     
                     
                     
                     
                     
                }  
                echo ' <tr>';
                echo ' <td>';
                echo 'TVA 5,5 %';
                echo ' </td>';
                echo ' <td>';
                echo ' </td>';
                echo ' <td>';
                echo round($TVA,2). " &euro;";
                echo ' </td>';
                echo ' </tr>';
                
                echo ' <tr>';
                echo ' <td>';
                echo 'TOTAL TTC';
                echo ' </td>';
                echo ' <td>';
                echo ' </td>';
                echo ' <td>';
                echo round($prix,2). " &euro;";
                echo ' </td>';
                echo ' </tr>';
                $prixModerateur = 0;
                if(strrpos($row["CLIENT_CLASSE"],"65") > 0)
                {
                    echo ' <tr>';
                    echo ' <td>';
                    echo 'Ticket mod&eacute;rateur (-35%)';
                    echo ' </td>';
                    echo ' <td>';
                    echo ' </td>';
                    echo ' <td>';
                    $prixModerateur = ((35/100) * $prix);
                    echo round($prixModerateur,2). " &euro;";
                    echo ' </td>';
                    echo ' </tr>';
                }
                
                echo ' </table>';
                
                echo "</div>";
                
                echo "<div id=ligne5>";
                echo round($prix - $prixModerateur,2);
                
                echo "</div>";
                
                echo "<div id=ligne6>";
                echo "<div id=date-now>";
                $today = getdate();
                echo $today["mday"]."/".$today["mon"]."/".$today["year"];
                
                echo "</div>";
                echo "<div id=ville>";
                echo "Versailles";
                echo "</div>";
                echo "</div>";
                
                echo "<div id=ligne10>";
                echo 'SARL VERSAILLES ORTHOPEDIE<br/>';
                echo 'PODO-ORTHESISTE: OUIAME ALAOUI<br/>';
                echo '2 BIS, RUE SAINT HONORE 78000 VERSAILLES<br/>';
                echo 'AGREE SS 78 CH 582 C<br/>';
                echo 'AGREE SS 78 260 5828<br/>';
                echo 'TEL/FAX 01 39 50 18 53<br/>';
                echo "</div>";
                
                echo "<div id=ligne-all>&nbsp;";
                echo "</div>";
            
            }
           }
         ?>
        
     </div>
</body>
</html>
