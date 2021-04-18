
<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>
<div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
  <div id="bloc">
    <h2>Ajouter utilisateur</h2>
    <?php
            if(isset($_GET["message"]))
            {
               echo "<div class='msg'>".$_GET["message"]."</div>";
            }
          ?>
    <form method="post">
      <?php
            if(isset($_POST["validation"]) && $_POST["validation"]== "ok" )
            {
              $query_insert = "INSERT INTO UTILISATEUR (UTILISATEUR_NOM,UTILISATEUR_PRENOM,UTILISATEUR_LOGIN,UTILISATEUR_PWD,UTILISATEUR_DATE_CREATION,UTILISATEUR_DATE_MODIFICATION,UTILISATEUR_COMMENTAIRE) VALUES(";
              $query_insert = $query_insert."'".str_replace("'","''",$_POST["nom"])."'";
              $query_insert = $query_insert." ,'".str_replace("'","''",$_POST["prenom"])."'";
              $query_insert = $query_insert." ,'".$_POST["login"]."'";
              $query_insert = $query_insert." ,'".$_POST["pwd"]."'";              
              $today = getdate();
              $query_insert = $query_insert." ,'".$today["mday"]."-".$today["mon"]."-".$today["year"]."'";
              $query_insert = $query_insert." ,'".$today["mday"]."-".$today["mon"]."-".$today["year"]."'";
              $query_insert = $query_insert." ,'".str_replace("'","''",$_POST["commentaire"])."')";
              $result = mysql_query($query_insert);
              if (!$result) 
              {
                die('<div class="msg">Erreur: '. mysql_error().'</div>');
              }
              else
              {
                mysql_free_result($result);
                header("Location:../Ajout_Utilisateur/?message=Ajout effectu%E9 avec succ%E9s");
              }

            }
            ?>
      <div class="dossier-client">
        <?php
            
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Nom :</div><div class=dossier-client-right><input name='nom' type='text'/></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>P&eacute;nom:</div><div class=dossier-client-right><input name='prenom' type='text'/></div></div>";              
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Login</div><div class=dossier-client-right><input name='login' type='text' /></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Mot de pass:</div><div class=dossier-client-right><input name='pwd' type='text' /></div></div>";
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
