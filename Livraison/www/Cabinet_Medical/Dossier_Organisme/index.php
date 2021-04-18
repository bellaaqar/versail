<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>
<div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
  <div id="bloc">
    <h2>Modifier Organisme</h2>
    <form method="post">
      <?php
            if(isset($_POST["validation"]) && $_POST["validation"]== "ok" )
            {
              
              $query_update = "UPDATE ORGANISME SET";
              $query_update = $query_update." ORGANISME_LIBELLE ='".$_POST["nom"]."',";
              $query_update = $query_update." ORGANISME_ADRESSE ='".$_POST["adresse"]."',";
              $query_update = $query_update." ORGANISME_CODE_POSTAL ='".$_POST["codePostal"]."',";
              $query_update = $query_update." ORGANISME_VILLE ='".$_POST["ville"]."',";
              $query_update = $query_update." ORGANISME_TEL ='".$_POST["tel"]."',";
              $query_update = $query_update." ORGANISME_FAX ='".$_POST["fax"]."',";
              $query_update = $query_update." ORGANISME_EMAIL ='".$_POST["email"]."',";
              $today = getdate();
              $query_update = $query_update." ORGANISME_DATE_MODIFICATION ='".$today["mday"]."-".$today["mon"]."-".$today["year"]."',";
              $query_update = $query_update." ORGANISME_CODE ='".$_POST["organismeCode"]."',";
              $query_update = $query_update." ORGANISME_COMMENTAIRE ='".str_replace("'","''",$_POST["commentaire"])."'";
              
              $query_update = $query_update." WHERE ORGANISME_NUM = ".$_GET["organismeNum"];              
              
              $result = mysql_query($query_update);
              if (!$result) 
              {
                die('<div class="msg">Erreur: '. mysql_error().'</div>');
              }
              else
              {
                mysql_free_result($result);
                header("Location:../Consultation_Organisme/?message=Modification effectu%E9 avec succ%E9s");
              }

            }
            ?>
      <div class="dossier-client">
        <?php
            
             $query = "SELECT * FROM  ORGANISME  WHERE ORGANISME_NUM =".$_GET["organismeNum"];
           
           $result = mysql_query($query);
            if (!$result) 
            {
              die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code organisme:</div><div class=dossier-client-right><input name='organismeCode' type='text' value='".$row["ORGANISME_CODE"]."' /></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Nom organisme:</div><div class=dossier-client-right><input  name='nom' type='text' value='".$row["ORGANISME_LIBELLE"]."'/></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Adresse:</div><div class=dossier-client-right><textarea  name='adresse' rows='5'>".$row["ORGANISME_ADRESSE"]."</textarea></div></div>";              
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code postal:</div><div class=dossier-client-right><input  name='codePostal' type='text' value='".$row["ORGANISME_CODE_POSTAL"]."' /></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Ville:</div><div class=dossier-client-right><input  name='ville' type='text' value='".$row["ORGANISME_VILLE"]."' /></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>T&eacute;l&eacute;phone</div><div class=dossier-client-right><input  name='tel' type='text' value='".$row["ORGANISME_TEL"]."'/></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Fax:</div><div class=dossier-client-right><input  name='fax' type='text value='".$row["ORGANISME_FAX"]."''/></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left> Email:</div><div class=dossier-client-right><input  name='email' type='text' value='".$row["ORGANISME_EMAIL"]."'' /></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Commentaire:</div><div class=dossier-client-right><textarea  name='commentaire' rows='5'>".$row["ORGANISME_COMMENTAIRE"]."</textarea></div></div>";  
              }
             }        
            
         
          ?>
            </div>
            <div class="btn">
              <input type="hidden" value="ok" name="validation" />
              <input type="submit" value="Modifier"></input>
            </div>
          </form>

        </div>

        
      </div>
<?php require_once("../Footer/Footer.php");?>