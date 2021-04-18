<?php 

require_once("../Header/Header.php");
require_once("../Test_Authentification/Test_Authentification.php");
require_once("../Connexion/Connexion.php");

echo "<div id=\"contenu\">";
require_once("../Menu_Gauche/Menu.php");
 echo "<div id=\"bloc\">";
    echo "<h2>Dossier client</h2>";
   
            if(isset($_GET["message"]))
            {
               echo "<div class='msg'>".$_GET["message"]."</div>";

            }
          
    echo "<form method=\"post\">";
      
            
           

            
            
      echo "<div class=\"dossier-client\">";
        
            
            $query1 = "SELECT * FROM CLIENT WHERE CLIENT_NUM = '". $_GET["clientNum"]. "'";
            $result1 = mysql_query($query1);
            if (!$result1) 
            {
              die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row1 = mysql_fetch_array($result1)) 
              {
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Num&eacute;ro:</div><div class=dossier-client-right><input disabled name='numero' type='text' value='".$row1["CLIENT_NSS"]."'/></div><div class='dossier-client-right right_elements'>Classe:</div><div class='dossier-client-right left_elements'><input disabled name='classe' type='text' value='".$row1["CLIENT_CLASSE"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Nom:</div><div class=dossier-client-right><input disabled name='nom' type='text' value='".$row1["CLIENT_NOM"]."'/></div><div class='dossier-client-right right_elements'>N&deg;Forme:</div><div class='dossier-client-right left_elements'><input disabled name='numForm' type='text' value='".$row1["CLIENT_NUMERO_FORME"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code d'organisme d'affiliation:</div><div class=dossier-client-right><input disabled name='prenom' type='text' value='".$row1["CLIENT_CODE_AFFILIATION_ORGANISME"]."'/></div><div class='dossier-client-right right_elements'>Demandes:</div><div class='dossier-client-right left_elements'>
                <select id='demandes' onchange='openDemande(this.value)' name='demandes'>"; 
                echo "<option value=''>Choix...</option>";
                echo "<option value='../Demande1/?clientNom=".$row1["CLIENT_NOM"]."'>Demande1</option>";
                echo "<option value='../Demande2/?clientNom=".$row1["CLIENT_NOM"]."'>Demande2</option>";
                echo "<option value='../Demande3/?clientNom=".$row1["CLIENT_NOM"]."'>Demande3</option>";
                echo "<option value='../Demande_Ancien_Combattant/?clientNom=".$row1["CLIENT_NOM"]."'>Demande anciens combatants</option>";
                echo "</select></div></div>";                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Pr&eacute;nom:</div><div class=dossier-client-right><input disabled name='prenom' type='text' value='".$row1["CLIENT_PRENOM"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>B&eacute;n&eacute;ficiaire:</div><div class=dossier-client-right><input disabled name='beneficiare' type='text' value='".$row1["CLIENT_BENEFICIAIRE"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Adresse:</div><div class=dossier-client-right><textarea disabled name='adresse' rows='5'>".$row1["CLIENT_ADRESSE"]."</textarea></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Ville:</div><div class=dossier-client-right><input disabled name='ville' type='text' value='".$row1["CLIENT_VILLE"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code postal:</div><div class=dossier-client-right><input disabled name='codePostal' type='text' value='".$row1["CLIENT_CODE_POSTALE"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>E-mail:</div><div class=dossier-client-right><input disabled name='email' type='text' value='".$row1["CLIENT_EMAIL"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>T&eacute;l&eacute;phone domicile:</div><div class=dossier-client-right><input disabled name='domicile' type='text' value='".$row1["CLIENT_TELEPHONE_FIXE"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>T&eacute;l&eacute;phone portable:</div><div class=dossier-client-right><input disabled name='portable' type='text' value='".$row1["CLIENT_TELEPHONE_MOBILE"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>T&eacute;l&eacute;phone bureau:</div><div class=dossier-client-right><input disabled name='bureau' type='text' value='".$row1["CLIENT_TELEPHONE_BUREAU"]."'/></div></div>";
               
                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Organisme:</div><div class=dossier-client-right><select disabled name='organisme'>"; 
                echo "<option value=''>Choix...</option>";
                $query2 = "SELECT * FROM ORGANISME";
                $result2 = mysql_query($query2);
                if (!$result2) 
                {
                  die('<div class="msg">Erreur: ' . mysql_error().'</div>');
                }
                else
                {
                  
                  while ($row2 = mysql_fetch_array($result2)) 
                  {
                    if($row2["ORGANISME_NUM"] == $row1["CLIENT_ORGANISME"])
                    {
                      $selected = "selected";
                    }
                    else
                    {
                      $selected = "";
                    }
                    echo "<option ".$selected."  value='".$row2["ORGANISME_NUM"]."'>".$row2["ORGANISME_LIBELLE"]."</option>";		             
                  }
                  mysql_free_result($result2);
                  
                }
                echo "</select></div></div>"; 
                            
                
                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date de cr&eacute;ation:</div><div class=dossier-client-right>".$row1["CLIENT_DATE_CREATION"]."</div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date de modification:</div><div class=dossier-client-right>".$row1["CLIENT_DATE_MODIFICATION"]."</div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Commentaire:</div><div class=dossier-client-right><textarea disabled name='commentaire' rows='5'>".$row1["CLIENT_COMMENTAIRE"]."</textarea></div></div>";           
                
              }
               mysql_free_result($result1);
               
            }

           
              
          
            echo "</div>";
            echo "<div class=\"btn\">";
             
              echo '<input  value="Modifier" type="button" onclick="window.location.href=\'../Dossier_Client/?clientNum=', $_GET["clientNum"] ,'\'"></input>';
              
              echo   '<input type="button" value="Gestions des commandes"  onclick="window.location.href=\'../Commande_Client/?clientNum=', $_GET["clientNum"] ,'\'"></input>';
             
           echo " </div>";
          echo "</form>";

        echo "</div>";

     
      echo "</div>";
require_once("../Footer/Footer.php");

?>