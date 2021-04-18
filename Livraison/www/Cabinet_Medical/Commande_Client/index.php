<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>




<div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
        <div id="bloc">
          <h2>Gestion des commandes</h2>
          

          <?php
           $query = "SELECT * FROM CLIENT WHERE CLIENT_NUM =".$_GET["clientNum"];
           $result = mysql_query("$query");
            if (!$result) 
            {
              die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
                echo '<div class="link-client">Liste des commandes de: <a href="../Consultation_Dossier_Client/?clientNum='.$_GET["clientNum"].'"><strong>'.$row["CLIENT_PRENOM"].' '.$row["CLIENT_NOM"].'</strong></a></div><br/>';
              }
              mysql_free_result($result);
            }
             echo   '<input type="button" value="Nouvelle commande"  onclick="window.location.href=\'../Ajout_Commande/?clientNum=', $_GET["clientNum"] ,'\'"></input>';

          ?>
        
          <table>
            <tr>
                <th></th>
              <th>N.Commande</th>
              <th>Date de commande</th>
              <th>Date d'accord</th>
              <th>Date de modification</th>
                <th></th>
                <?php 
                if( $_SESSION['Utilisateur'] == "Admin")
                echo '<th></th>';
                ?>
              
            </tr>

            <?php            
            $query = "SELECT * FROM COMMANDE WHERE COMMANDE_CLIENT_NUM=".$_GET["clientNum"] ." ORDER BY COMMANDE_NUM DESC";
            $result = mysql_query("$query");
            if (!$result) 
            {
             die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
                echo '<tr  onmousemove="lavend(this)" onmouseout ="transp(this)">'
                      ,'<td><a href="javascript:window.location.href=\'../Consultation_Dossier_Commande/?clientNum=', $_GET["clientNum"].'&commandeNum='.$row["COMMANDE_NUM"] ,'\'" ><img border=0 src="../Images/interface/loupe.gif" title="Consulter" ></img></a></td>'
                      ,'<td><nobr>',$row["COMMANDE_NUM_FACTURE"],'</nobr</td>'
                      ,'<td>',$row["COMMANDE_DATE_CREATION"],'</td>'
                      ,'<td>',$row["COMMANDE_DATE_ACCORD"],'</td>' 
                      ,'<td>',$row["COMMANDE_DATE_MODIFICATION"],'</td>'
                       ,'<td><a href="javascript:window.location.href=\'../Dossier_Commande/?clientNum=', $_GET["clientNum"].'&commandeNum='.$row["COMMANDE_NUM"] ,'\'" ><img border=0 src="../Images/interface/b_edit.png" title="Modifier" ></img></a></td>';
                       if( $_SESSION['Utilisateur'] == "Admin")
                      echo '<td><a href="javascript:if(confirm(\'Voulez-vous supprimer cette commande?\'))window.location.href=\'../Suppression_Commande/?clientNum='.$_GET["clientNum"].'&commandeNum='.$row["COMMANDE_NUM"],'\'" ><img border=0 src="../Images/interface/b_drop.png" title="Effacer" ></img></a></td>';
                     echo '</tr>';
                     
              } 
              mysql_free_result($result);
            }
          ?>
        </table>
      </div>
        
      </div>
<?php require_once("../Footer/Footer.php");?>