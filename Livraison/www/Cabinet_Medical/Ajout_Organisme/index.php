<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>
<div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
  <div id="bloc">
    <h2>Ajouter nouveau Organisme</h2>
    <form method="post">
      <?php
            if(isset($_POST["validation"]) && $_POST["validation"]== "ok" )
            {
              $query_insert = "INSERT INTO ORGANISME (ORGANISME_LIBELLE,ORGANISME_ADRESSE,ORGANISME_CODE_POSTAL,ORGANISME_VILLE,ORGANISME_TEL,ORGANISME_FAX,ORGANISME_EMAIL,ORGANISME_DATE_CREATION,ORGANISME_DATE_MODIFICATION,ORGANISME_COMMENTAIRE,ORGANISME_CODE) VALUES(";
              $query_insert = $query_insert."'".str_replace("'","''",$_POST["nom"])."'";
              $query_insert = $query_insert." ,'".str_replace("'","''",$_POST["adresse"])."'";
              $query_insert = $query_insert." ,'".$_POST["codePostal"]."'";
              $query_insert = $query_insert." ,'".str_replace("'","''",$_POST["ville"])."'";
              $query_insert = $query_insert." ,'".$_POST["tel"]."'";
              $query_insert = $query_insert." ,'".$_POST["fax"]."'";
              $query_insert = $query_insert." ,'".$_POST["email"]."'";
              $today = getdate();
              $query_insert = $query_insert." ,'".$today["mday"]."-".$today["mon"]."-".$today["year"]."'";
              $query_insert = $query_insert." ,'".$today["mday"]."-".$today["mon"]."-".$today["year"]."'";
              $query_insert = $query_insert." ,'".str_replace("'","''",$_POST["commentaire"])."'";
              $query_insert = $query_insert." ,'".$_POST["organismeCode"]."')";
              $result = mysql_query($query_insert);
              if (!$result) 
              {
                die('<div class="msg">Erreur: '. mysql_error().'</div>');
              }
              else
              {
                mysql_free_result($result);
                header("Location:../Consultation_Organisme/?message=Ajout effectu%E9 avec succ%E9s");
              }

            }
            ?>
      <div class="dossier-client">
        <?php
            
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code organisme:</div><div class=dossier-client-right><input name='organismeCode' type='text'/></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Nom organisme:</div><div class=dossier-client-right><input name='nom' type='text'/></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Adresse:</div><div class=dossier-client-right><textarea name='adresse' rows='5'></textarea></div></div>";              
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code postal:</div><div class=dossier-client-right><input name='codePostal' type='text' /></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Ville:</div><div class=dossier-client-right><input name='ville' type='text' /></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>T&eacute;l&eacute;phone</div><div class=dossier-client-right><input name='tel' type='text'/></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Fax:</div><div class=dossier-client-right><input name='fax' type='text'/></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left> Email:</div><div class=dossier-client-right><input name='email' type='text' /></div></div>";
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