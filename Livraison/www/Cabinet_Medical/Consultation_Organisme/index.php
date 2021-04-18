<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>

      <div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
        <div id="bloc">
          <h2>Consultation de la liste des organisme</h2>
           <?php
            if(isset($_GET["message"]))
            {
               echo "<div class='msg'>".$_GET["message"]."</div>";
            }
          ?>

          <table>
            <tr>
               <th></th>
                <th>Code organisme</th>
              <th>Nom</th>
              <th>Date de c&eacute;ation</th>
              <th>Date de modification</th>
              <th>T&eacute;l&eacute;phone</th>
              <th>Fax</th>
                <th></th>
                <?php 
                if( $_SESSION['Utilisateur'] == "Admin")
                echo '<th></th>';
                ?>
                
            </tr>

            <?php            
            $query = "SELECT * FROM ORGANISME ORDER BY ORGANISME_DATE_MODIFICATION DESC";
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
                       ,'<td><a href="javascript:window.location.href=\'../Consultation_Dossier_Organisme/?organismeNum=', $row["ORGANISME_NUM"] ,'\'" ><img border=0 src="../Images/interface/loupe.gif" title="Consulter" ></img></a></td>'
                      ,'<td>',$row["ORGANISME_CODE"],'</td>'
                      ,'<td>',$row["ORGANISME_LIBELLE"],'</td>'
                      ,'<td>',$row["ORGANISME_DATE_CREATION"],'</td>'                   
                      ,'<td>',$row["ORGANISME_DATE_MODIFICATION"],'</td>'                   
                      ,'<td>',$row["ORGANISME_TEL"],'</td>'
                      ,'<td>',$row["ORGANISME_FAX"],'</td>'               
                      
                       ,'<td><a href="javascript:window.location.href=\'../Dossier_Organisme/?organismeNum=', $row["ORGANISME_NUM"] ,'\'" ><img border=0 src="../Images/interface/b_edit.png" title="Modifier" ></img></a></td>';
                       if( $_SESSION['Utilisateur'] == "Admin")
                      echo '<td><a href="javascript:if(confirm(\'Voulez-vous supprimer cet organisme?\'))window.location.href=\'../Suppression_Organisme/?organismeNum='.$row["ORGANISME_NUM"],'\'" ><img border=0 src="../Images/interface/b_drop.png" title="Effacer" ></img></a></td>';
                       
                      echo '</tr>';
                     
              } 
              mysql_free_result($result);
            }

            

          
          ?>
        </table>


        
      </div>

        
      </div>
<?php require_once("../Footer/Footer.php");?>