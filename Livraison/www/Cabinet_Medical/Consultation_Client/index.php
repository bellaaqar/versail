<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>

      <div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
        <div id="bloc">
          <h2>Consultation de la liste des clients</h2>
          
          <?php
          if(isset($_GET["message"]))
          {
               echo "<div class='msg'>".$_GET["message"]."</div>";

          }
          if(isset($_GET["page"]))
          {
               $page = $_GET["page"];
          }
          else
          {
            $page = 0;
          }
          
            echo "<div id=pagination>";
            $queryCount = "SELECT COUNT(*) AS NB_CLIENT FROM CLIENT";
            $resultCount = mysql_query("$queryCount");
            while ($row = mysql_fetch_array($resultCount)) 
            {
                $countClient = $row["NB_CLIENT"];
                $nbPage = ceil($countClient / 20) ;
                
                
                if($nbPage>20)
                {
                    if($page>0)
                    {
                        $pageCurrent = $page-20;
                        echo " <a href='../Consultation_Client/?page=0' title='Premi&egrave;re page'><<</a>";
                        echo " <a href='../Consultation_Client/?page=".$pageCurrent."'>Page pr&eacute;c&eacute;dente</a>";
                    }
                    if($page < $nbPage)
                    {
                        $pageCurrent = $page+20;
                        if($pageCurrent>$nbPage)
                        {
                            $pageCurrent = $nbPage;
                        }
                        echo " <a href='../Consultation_Client/?page=".$pageCurrent."'>Page suivante</a>";
                        echo " <a href='../Consultation_Client/?page=".$nbPage."' title='D&eacute;rni&egrave;re page'>>></a>";
                    }
                }         
                 
                
            }
            echo "</div>";
          ?>
          
          <table>
            <tr>
              <th></th>
              <th></th>
              <th>N.SS</th>
              <th>Nom</th>
              <th>Pr&eacute;nom</th>
              <th width="134px">Adresse</th>
              <th>Code postal</th>
              <th>Ville</th>
              <th>T&eacute;l&eacute;phone</th>
                <th></th>
                <?php 
                if( $_SESSION['Utilisateur'] == "Admin")
                echo '<th></th>';
                ?>
              
         
            </tr>

            <?php  
                      
            $query = "SELECT * FROM CLIENT ORDER BY CLIENT_DATE_MODIFICATION_INTERNE DESC LIMIT ".$page." , 20 ";
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
                        ,'<td><a href="javascript:window.location.href=\'../Commande_Client/?clientNum=', $row["CLIENT_NUM"] ,'\'" ><img border=0 src="../Images/interface/icone_panier.gif" title="Gestion commande" ></img></a></td>'
                      ,'<td><a href="javascript:window.location.href=\'../Consultation_Dossier_Client/?clientNum=', $row["CLIENT_NUM"] ,'\'" ><img border=0 src="../Images/interface/loupe.gif" title="Consulter client" ></img></a></td>'
                      ,'<td><nobr>',$row["CLIENT_NSS"],'</nobr</td>'
                      ,'<td>',$row["CLIENT_NOM"],'</td>'
                      ,'<td>',$row["CLIENT_PRENOM"],'</td>'                   
                      ,'<td>',$row["CLIENT_ADRESSE"],'</td>'                   
                      ,'<td>',$row["CLIENT_CODE_POSTALE"],'</td>'
                      ,'<td>',$row["CLIENT_VILLE"],'</td>'                   
                      ,'<td>',$row["CLIENT_TELEPHONE_FIXE"],'</td>'
                      ,'<td><a href="javascript:window.location.href=\'../Dossier_Client/?clientNum=', $row["CLIENT_NUM"] ,'\'" ><img border=0 src="../Images/interface/b_edit.png" title="Modifier" ></img></a></td>';
                      if( $_SESSION['Utilisateur'] == "Admin")
                      {
                        echo '<td><a href="javascript:if(confirm(\'Voulez-vous supprimer ce client?\'))window.location.href=\'../Suppression_Client/?clientNum='.$row["CLIENT_NUM"],'\'" ><img border=0 src="../Images/interface/b_drop.png" title="Effacer" ></img></a></td>';
                      }
                       
                     echo '</tr>';
                     
              } 
              mysql_free_result($result);
            }

            

          
          ?>
        </table>


        
      </div>

        
      </div>
<?php require_once("../Footer/Footer.php");?>