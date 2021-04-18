<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>
<div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
  <div id="bloc">
    <h2>Consulter Organisme</h2>
    <form method="post">
      
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
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code organisme:</div><div class=dossier-client-right><input disabled name='organismeCode' type='text' value='".$row["ORGANISME_CODE"]."' /></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Nom organisme:</div><div class=dossier-client-right><input disabled name='nom' type='text' value='".$row["ORGANISME_LIBELLE"]."'/></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Adresse:</div><div class=dossier-client-right><textarea disabled name='adresse' rows='5'>".$row["ORGANISME_ADRESSE"]."</textarea></div></div>";              
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code postal:</div><div class=dossier-client-right><input disabled name='codePostal' type='text' value='".$row["ORGANISME_CODE_POSTAL"]."' /></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Ville:</div><div class=dossier-client-right><input disabled name='ville' type='text' value='".$row["ORGANISME_VILLE"]."' /></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>T&eacute;l&eacute;phone</div><div class=dossier-client-right><input disabled name='tel' type='text' value='".$row["ORGANISME_TEL"]."'/></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Fax:</div><div class=dossier-client-right><input disabled name='fax' type='text value='".$row["ORGANISME_FAX"]."''/></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left> Email:</div><div class=dossier-client-right><input disabled name='email' type='text' value='".$row["ORGANISME_EMAIL"]."'' /></div></div>";
                  echo "<div class=dossier-client-ligne><div class=dossier-client-left>Commentaire:</div><div class=dossier-client-right><textarea disabled name='commentaire' rows='5'>".$row["ORGANISME_COMMENTAIRE"]."</textarea></div></div>";  
              }
             }        
            
         
          ?>
            </div>
            <div class="btn">
              <input type="hidden" value="ok" name="validation" />
             <?php 
             echo ' <input type="button" value="Modifier" onclick="window.location.href=\'../Dossier_Organisme/?organismeNum=',$_GET["organismeNum"] ,'\'"></input>';             
            
             ?>
            </div>
          </form>

        </div>

        
      </div>
<?php require_once("../Footer/Footer.php");?>