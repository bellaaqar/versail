<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>

<div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
  <div id="bloc">
    <h2>Ajouter nouveau client</h2>
    <form method="post">
      <?php
            
           

            if(isset($_POST["validation"]) && $_POST["validation"]== "ok" )
            {
              $query_insert = "INSERT INTO CLIENT (CLIENT_NSS,CLIENT_NOM,CLIENT_PRENOM,CLIENT_ADRESSE,CLIENT_VILLE,CLIENT_CODE_POSTALE,CLIENT_TELEPHONE_FIXE,CLIENT_TELEPHONE_MOBILE,CLIENT_TELEPHONE_BUREAU,CLIENT_ORGANISME,CLIENT_DATE_CREATION,CLIENT_DATE_MODIFICATION,CLIENT_DATE_MODIFICATION_INTERNE,CLIENT_COMMENTAIRE,CLIENT_CLASSE,CLIENT_NUMERO_FORME,CLIENT_BENEFICIAIRE,CLIENT_EMAIL,CLIENT_CODE_AFFILIATION_ORGANISME) VALUES(";
              $query_insert = $query_insert."'".$_POST["numeroSS1"]." ".$_POST["numeroSS2"]." ".$_POST["numeroSS3"]." ".$_POST["numeroSS4"]." ".$_POST["numeroSS5"]." ".$_POST["numeroSS6"]." ".$_POST["numeroSS7"]."'";
              $query_insert = $query_insert." ,'".str_replace("'","''",$_POST["nom"])."'";
              $query_insert = $query_insert." ,'".str_replace("'","''",$_POST["prenom"])."'";
              $query_insert = $query_insert." ,'".str_replace("'","''",$_POST["adresse"])."'";
              $query_insert = $query_insert." ,'".str_replace("'","''",$_POST["ville"])."'";
              $query_insert = $query_insert." ,'".$_POST["codePostal"]."'";
              $query_insert = $query_insert." ,'".$_POST["domicile"]."'";
              $query_insert = $query_insert." ,'".$_POST["portable"]."'";
              $query_insert = $query_insert." ,'".$_POST["bureau"]."'";
              $query_insert = $query_insert.",'".str_replace("'","''",$_POST["organisme"])."'";            
              
              $today = getdate();
              $query_insert = $query_insert." ,'".$today["mday"]."-".$today["mon"]."-".$today["year"]."'";
              $query_insert = $query_insert." ,'".$today["mday"]."-".$today["mon"]."-".$today["year"]."'";
              $query_insert = $query_insert." ,'".$today["year"]."-".$today["mon"]."-".$today["mday"]."'";
              $query_insert = $query_insert." ,'".str_replace("'","''",$_POST["commentaire"])."'";
              
               $query_insert = $query_insert." ,'".$_POST["classe"]."'";
               $query_insert = $query_insert." ,'".$_POST["numForm"]."'";              
               $query_insert = $query_insert." ,'".$_POST["beneficiaire"]."'";
              
               $query_insert = $query_insert." ,'".$_POST["email"]."'";
               $query_insert = $query_insert." ,'".$_POST["codeAffiliationOrganisme"]."')";
               echo $query_insert;
              $result = mysql_query($query_insert);
              if (!$result) 
              {
               
                die('<div class="msg">Erreur: '. mysql_error().'</div>');
              }
              else
              {
                mysql_free_result($result);
                $result = "SELECT LAST_INSERT_ID() FROM CLIENT";
                $result = mysql_query($result);
                while ($row = mysql_fetch_array($result)) 
                {
                    header("Location:../Consultation_Dossier_Client/?message=Ajout effectu%E9 avec succ%E9s&clientNum=".$row[0]);
                }
                
              }
              

            }
            ?>
      <div class="dossier-client">
        <?php
            
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Num&eacute;ro:</div><div class=dossier-client-right>";
               echo '<input class="ss1" name=numeroSS1 maxlength=1  type=text></input>';
                 echo '<input class="ss2" name=numeroSS2 maxlength=2  type=text></input>';
                 echo '<input class="ss3" name=numeroSS3 maxlength=2  type=text></input>';
                 echo '<input class="ss4" name=numeroSS4 maxlength=2  type=text></input>';
                 echo '<input class="ss5" name=numeroSS5 maxlength=3  type=text></input>';
                 echo '<input class="ss6" name=numeroSS6 maxlength=3  type=text></input>';
                 echo '<input class="ss7" name=numeroSS7 maxlength=2  type=text></input>';
              
              
              echo"</div><div class='dossier-client-right right_elements_classe'>Classe:</div><div class='dossier-client-right left_elements'>";
              echo "<select name='classe'><option value=''>Choix...</option><option  value='CLASSE A 100 %' >CLASSE A 100 %</option><option  value='CLASSE A 65 %'>CLASSE A 65 %</option><option value='CLASSE B 100 %' >CLASSE B 100 %</option><option value='CLASSE B 65 %'>CLASSE B 65 %</option><option value='COMMANDE PRIVEE' >COMMANDE PRIVEE</option></select></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code d'organisme d'affiliation:</div><div class=dossier-client-right><input name='codeAffiliationOrganisme' type='text' /></div><div class='dossier-client-right right_elements'>N&deg;Forme:</div><div class='dossier-client-right left_elements'><input name='numForm' type='text'/></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Nom:</div><div class=dossier-client-right><input name='nom' type='text' /></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Pr&eacute;nom:</div><div class=dossier-client-right><input name='prenom' type='text' /></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>B&eacute;n&eacute;ficiaire:</div><div class=dossier-client-right><input name='beneficiare' type='text'/></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Adresse:</div><div class=dossier-client-right><textarea name='adresse' rows='5'></textarea></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Ville:</div><div class=dossier-client-right><input name='ville' type='text'/></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code postal:</div><div class=dossier-client-right><input name='codePostal' type='text'/></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>E-mail:</div><div class=dossier-client-right><input name='email' type='text'/></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>T&eacute;l&eacute;phone domicile:</div><div class=dossier-client-right><input name='domicile' type='text' /></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>T&eacute;l&eacute;phone portable:</div><div class=dossier-client-right><input name='portable' type='text' /></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>T&eacute;l&eacute;phone bureau:</div><div class=dossier-client-right><input name='bureau' type='text' /></div></div>";
              
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
                  echo "<option   value='".$row2["ORGANISME_NUM"]."'>".$row2["ORGANISME_LIBELLE"]."</option>";		             
                }
                mysql_free_result($result2);
              }
                  
              echo "</select></div></div>";        
              
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Commentaire:</div><div class=dossier-client-right><textarea name='commentaire' rows='5'></textarea></div></div>";           
         

           

          
          ?>
            </div>
            <div class="btn">
              <input type="hidden" value="ok" name="validation" />
              <input type="submit" value="Enregistrer"></input>
            </div>
          </form>

        </div>

        
      </div>
<?php require_once("../Footer/Footer.php");?>