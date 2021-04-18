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
     <link rel="stylesheet" type="text/css" href='http://localhost/Livraison/www/Cabinet_Medical/Styles/facture.css' />
    
</head>
<body>
    <div id="page">
        <?php require_once("../Connexion/Connexion.php");?>
        <h3>
            Podo Orth&eacute;siste</h3>
        <table class="entete">
            <tr>
                <td class="left">
                    <img src="../Images/interface/logo.GIF" />
                </td>
                <td class="right">
                    <div class="titre">
                        Etablissement Jean Labb&eacute; Orthop&eacute;die</div>
                    <div class="description">
                        Fabricant sur mesure, qualit&eacute;, confort et &eacute;l&eacute;gance Sp&eacute;cialiste des semelles orthop&eacute;diques,
                        chaussures orthop&eacute;diques chaussures th&eacute;rapeutiques anti-varus et anti-valgus
                    </div>
                </td>
            </tr>
        </table>
        
        <?php
        $query = "SELECT * FROM  COMMANDE  INNER JOIN CLIENT ON COMMANDE_CLIENT_NUM = CLIENT_NUM WHERE COMMANDE_NUM =".$_GET["commandeNum"]." AND COMMANDE_CLIENT_NUM =".$_GET["clientNum"];
        $result = mysql_query($query);         
        if (!$result) 
        {
          die('<div class="msg">Erreur: ' . mysql_error().'</div>');
        }
        else
        {
                      
          while ($row = mysql_fetch_array($result)) 
          {
            
            


            
             echo "<div class='date'>";
             $today = getdate();
             echo "Versailles le : ".$today["mday"]."/".$today["mon"]."/".$today["year"];
             echo "</div>";
             
             
             
            echo "<div class='beneficiare'>";
            echo "B&eacute;n&eacute;ficiaire : ". $row["CLIENT_PRENOM"] ." " . $row["CLIENT_NOM"];
            echo "</div>";
            echo "<div class='adresse'>";
            echo "Adresse : ". $row["CLIENT_ADRESSE"] ." " . $row["CLIENT_CODE_POSTALE"] . " " . $row["CLIENT_VILLE"];
            echo "</div>";
             
             echo "<h2> Facture </h2>";
             
             
             
             
              echo ' <table class="entete">';
               
               
                $refProduits = explode ("-",$row["COMMANDE_PRODUITS"]);
                $produitDesignation = "";
                $imgCodeBarre = "";
                $prix = 0;
                $TVA = 0;
                $prixTS = 0;
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
                         else if ($produit == "000000" )
                         {
                                $designationSupp = $valsCalculateur[2];
                                $prixSupp = $valsCalculateur[3];
                                $prixTS        += $nb * $prixSupp;
                                $prixHtProduit = ($prixSupp/(1.055));
                                
                                echo ' <tr>';
                                echo ' <td >';
                                echo $designationSupp;
                                echo ' </td>';
                                echo ' <td>';
                                echo ' </td>';
                                echo ' <td>';
                                $prixHT = $nb * round($prixHtProduit,2);
                                
                                $TVA += ($nb * $prixSupp) - $prixHT;
                                echo $nb ." X " . $prixHT/$nb ." &euro;" ;
                                echo ' </td>';
                                echo ' </tr>'; 
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
                echo round($prix,2) + round($prixTS,2). " &euro;";
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
                    
                    echo ' <tr>';
                    echo ' <td>';
                    echo 'Total avec ticket mod&eacute;rateur';
                    echo ' </td>';
                    echo ' <td>';
                    echo ' </td>';
                    echo ' <td>';                    
                    echo round($prix + $prixTS - $prixModerateur,2). " &euro;";
                    echo ' </td>';
                    echo ' </tr>';
                }
                 
                
                echo ' </table>';
             
             if($row["COMMANDE_COMMENATIRE_FACTURE"]!="")
             {
                 echo '<div id="commentaire">';
                 echo 'Commentaire :<br />';
                 
                 echo $row["COMMANDE_COMMENATIRE_FACTURE"];
                 echo '</div>';
             }
             
             
             echo "<div class=signature>";
             echo "Mme Ouiame Alaoui";
             echo "</div>";
            
          }
        }
        ?>
        
        
       
    <div class="bas-page">
    2 Bis Rue Saint Honor&eacute; 78000 Versailles
    Tel/Fax : 01 39 50 18 53
    Mobile : 06 17 18 25 43
    Podo Orth&eacute;siste agr&eacute;&eacute; : n&deg;  78 CH 582 C et n&deg; 78 2 60582 8
    </div>
   
</body>
</html>
