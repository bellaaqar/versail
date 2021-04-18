<?php 

require_once("../Header/Header.php");
require_once("../Test_Authentification/Test_Authentification.php");
require_once("../Connexion/Connexion.php");

echo "<div id=\"contenu\">";
require_once("../Menu_Gauche/Menu.php");
 echo "<div id=\"bloc\">";
    echo "<h2>Dossier client</h2>";
    echo "<form method=\"post\">";
      
            
           

            if(isset($_POST["validation"]) && $_POST["validation"]== "ok" )
            {
              $query_update = "UPDATE CLIENT SET";
              $query_update = $query_update." CLIENT_NSS ='".$_POST["numeroSS1"]." ".$_POST["numeroSS2"]." ".$_POST["numeroSS3"]." ".$_POST["numeroSS4"]." ".$_POST["numeroSS5"]." ".$_POST["numeroSS6"]." ".$_POST["numeroSS7"]."',";
              $query_update = $query_update." CLIENT_NOM ='".str_replace("'","''",$_POST["nom"])."',";
              $query_update = $query_update." CLIENT_PRENOM ='".str_replace("'","''",$_POST["prenom"])."',";
              $query_update = $query_update." CLIENT_ADRESSE ='".str_replace("'","''",$_POST["adresse"])."',";
              $query_update = $query_update." CLIENT_VILLE ='".str_replace("'","''",$_POST["ville"])."',";
              $query_update = $query_update." CLIENT_CODE_POSTALE ='".$_POST["codePostal"]."',";
              $query_update = $query_update." CLIENT_EMAIL ='".$_POST["email"]."',";              
              $query_update = $query_update." CLIENT_TELEPHONE_FIXE ='".$_POST["domicile"]."',";
              $query_update = $query_update." CLIENT_TELEPHONE_MOBILE ='".$_POST["portable"]."',";
              $query_update = $query_update." CLIENT_TELEPHONE_BUREAU ='".$_POST["bureau"]."',";
             
              $query_update = $query_update." CLIENT_NUMERO_FORME ='".$_POST["numForm"]."',";
              $query_update = $query_update." CLIENT_BENEFICIAIRE ='".$_POST["beneficiare"]."',";
              $query_update = $query_update." CLIENT_CLASSE ='".$_POST["classe"]."',";
             
              $query_update = $query_update." CLIENT_CODE_AFFILIATION_ORGANISME ='".$_POST["codeAffiliationOrganisme"]."',";
                                    
              
              if(isset($_POST["organisme"]))
              {
                $query_update = $query_update."	CLIENT_ORGANISME ='".str_replace("'","''",$_POST["organisme"])."',";
              }
              $today = getdate();
              $query_update = $query_update." CLIENT_DATE_MODIFICATION ='".$today["mday"]."-".$today["mon"]."-".$today["year"]."',";
              $query_update = $query_update." CLIENT_DATE_MODIFICATION_INTERNE ='".$today["year"]."-".$today["mon"]."-".$today["mday"]."',";
              $query_update = $query_update." CLIENT_COMMENTAIRE ='".str_replace("'","''",$_POST["commentaire"])."'";
              $query_update = $query_update." WHERE CLIENT_NUM ='".$_GET["clientNum"]."'";
              $result = mysql_query($query_update);
              if (!$result) 
              {
                die('<div class="msg">Erreur: '. mysql_error().'</div>');
              }
              else
              {
                mysql_free_result($result);
                header("Location:../Consultation_Dossier_Client/?message=modification effectu%E9 avec succ%E9s&clientNum=".$_GET["clientNum"]);
              }

            }
            
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
                
                 echo "<div class=dossier-client-ligne><div class=dossier-client-left>Num&eacute;ro:</div><div class=dossier-client-right>";
                 echo '<input class="ss1" name=numeroSS1 maxlength=1  type=text value="'.substr(str_replace(" ","",$row1["CLIENT_NSS"]),0,1).'"></input>';
                 echo '<input class="ss2" name=numeroSS2 maxlength=2  type=text value="'.substr(str_replace(" ","",$row1["CLIENT_NSS"]),1,2).'"></input>';
                 echo '<input class="ss3" name=numeroSS3 maxlength=2  type=text value="'.substr(str_replace(" ","",$row1["CLIENT_NSS"]),3,2).'"></input>';
                 echo '<input class="ss4" name=numeroSS4 maxlength=2  type=text value="'.substr(str_replace(" ","",$row1["CLIENT_NSS"]),5,2).'"></input>';
                 echo '<input class="ss5" name=numeroSS5 maxlength=3  type=text value="'.substr(str_replace(" ","",$row1["CLIENT_NSS"]),7,3).'"></input>';
                 echo '<input class="ss6" name=numeroSS6 maxlength=3  type=text value="'.substr(str_replace(" ","",$row1["CLIENT_NSS"]),10,3).'"></input>';
                 echo '<input class="ss7" name=numeroSS7 maxlength=2  type=text value="'.substr(str_replace(" ","",$row1["CLIENT_NSS"]),13,2).'"></input>';
                 echo"</div>";
                 echo "<div class='dossier-client-right right_elements_classe'>Classe:</div><div class='dossier-client-right left_elements'>";
                 $selected1 = "";
                 $selected2 = "";
                 $selected3 = "";
                 $selected4 = "";
                 $selected5 = "";
                 switch($row1["CLIENT_CLASSE"])
                 {
                    case "CLASSE A 100 %": $selected1 = "selected"; break;
                    case "CLASSE A 65 %":  $selected2 = "selected"; break;
                    case "CLASSE B 100 %": $selected3 = "selected"; break;
                    case "CLASSE B 65 %":  $selected4 = "selected"; break;
                    case "COMMANDE PRIVEE":$selected5 = "selected"; break;
                 }
                 echo "<select name='classe'><option value=''>Choix...</option><option ".$selected1." value='CLASSE A 100 %' >CLASSE A 100 %</option><option ".$selected2." value='CLASSE A 65 %'>CLASSE A 65 %</option><option value='CLASSE B 100 %' ".$selected3.">CLASSE B 100 %</option><option value='CLASSE B 65 %' ".$selected4.">CLASSE B 65 %</option><option ".$selected5." value='COMMANDE PRIVEE' >COMMANDE PRIVEE</option></select></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code d'organisme d'affiliation :</div><div class=dossier-client-right><input  name='codeAffiliationOrganisme' type='text' value='".$row1["CLIENT_CODE_AFFILIATION_ORGANISME"]."'/></div><div class='dossier-client-right right_elements'>N&deg;Forme:</div><div class='dossier-client-right left_elements'><input  name='numForm' type='text' value='".$row1["CLIENT_NUMERO_FORME"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Nom:</div><div class=dossier-client-right><input  name='nom' type='text' value='".$row1["CLIENT_PRENOM"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Pr&eacute;nom:</div><div class=dossier-client-right><input  name='prenom' type='text' value='".$row1["CLIENT_PRENOM"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>B&eacute;n&eacute;ficiaire:</div><div class=dossier-client-right><input  name='beneficiare' type='text' value='".$row1["CLIENT_BENEFICIAIRE"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Adresse:</div><div class=dossier-client-right><textarea  name='adresse' rows='5'>".$row1["CLIENT_ADRESSE"]."</textarea></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Ville:</div><div class=dossier-client-right><input  name='ville' type='text' value='".$row1["CLIENT_VILLE"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code postal:</div><div class=dossier-client-right><input  name='codePostal' type='text' value='".$row1["CLIENT_CODE_POSTALE"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>E-mail:</div><div class=dossier-client-right><input name='email' type='text' value='".$row1["CLIENT_EMAIL"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>T&eacute;l&eacute;phone domicile:</div><div class=dossier-client-right><input  name='domicile' type='text' value='".$row1["CLIENT_TELEPHONE_FIXE"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>T&eacute;l&eacute;phone portable:</div><div class=dossier-client-right><input  name='portable' type='text' value='".$row1["CLIENT_TELEPHONE_MOBILE"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>T&eacute;l&eacute;phone bureau:</div><div class=dossier-client-right><input  name='bureau' type='text' value='".$row1["CLIENT_TELEPHONE_BUREAU"]."'/></div></div>";
                
                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Organisme:</div><div class=dossier-client-right><select name='organisme'>"; 
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
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Commentaire:</div><div class=dossier-client-right><textarea name='commentaire' rows='5'>".$row1["CLIENT_COMMENTAIRE"]."</textarea></div></div>";           
                
              }
               mysql_free_result($result1);
               
            }

           
              
          
            echo "</div>";
            echo "<div class=\"btn\">";
              echo "<input type=\"hidden\" value=\"ok\" name=\"validation\" />";
              echo "<input type=\"submit\" value=\"Enregistrer\"></input>";
              
              echo   '<input type="button" value="Gestions des commandes"  onclick="window.location.href=\'../Commande_Client/?clientNum=', $_GET["clientNum"] ,'\'"></input>';
             
           echo " </div>";
          echo "</form>";

        echo "</div>";

     
      echo "</div>";
require_once("../Footer/Footer.php");

?>