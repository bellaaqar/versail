<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>

<div id="contenu">
    <?php require_once("../Menu_Gauche/Menu.php");?>
    <div id="bloc">
        <h2>Consultation des statistiques commandes r&eacute;l&eacute;es</h2>

        <form method="post">
            <?php
             $today = getdate();
             $todayFormate      =  "01"."-"."01"."-".$today["year"];
             $finAnneeFormate   =  "31"."-"."12"."-".$today["year"];       
             
            $dateDebut  = $today["year"]."-"."01"."-"."01";
            $dateFin    = $today["year"]."-"."12"."-"."31";
            if(isset($_POST["dateDebut"]))
            {
                $dates              = explode ("-",$_POST["dateDebut"]);
                $dateDebut          = $dates[2]."-".$dates[1]."-".$dates[0];
                $todayFormate       = $dates[0]."-".$dates[1]."-".$dates[2];
            }
            if(isset($_POST["dateFin"]))
            {
                $dates              = explode ("-",$_POST["dateFin"]);
                $dateFin            = $dates[2]."-".$dates[1]."-".$dates[0]; 
                $finAnneeFormate    = $dates[0]."-".$dates[1]."-".$dates[2]; 
            } 
             
             
            ?>
            <div id="dates">
                <div id="date_debut">
                    <div class="dossier-client-ligne">
                        <div class="dossier-client-left">Date d&eacute;but:</div>
                        <div class="dossier-client-right">
                            <input class='input-date-accord' maxLength='10' name='dateDebut' id='dateDebut' type='text' value='<?echo $todayFormate;?>'/>
                            <a href='javascript:'>
                                <img src='../Images/interface/calendar.gif' border='0' onclick="displayCalendar('dateDebut',this.offsetLeft,this.offsetTop, event)" id='calendarImg5' alt='Modifier la date' title='Modifier la date'/>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="date-fin">
                    <div class="dossier-client-ligne">
                        <div class="dossier-client-left">Date fin:</div>
                        <div class="dossier-client-right">
                            <input class='input-date-accord' maxLength='10' name='dateFin' id='dateFin' type='text' value='<?echo $finAnneeFormate;?>'/>
                            <a href='javascript:'>
                                <img src='../Images/interface/calendar.gif' border='0' onclick="displayCalendar('dateFin',this.offsetLeft,this.offsetTop, event)" id='calendarImg5' alt='Modifier la date' title='Modifier la date'/>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="btn">

                    <input type="submit" value="Afficher les statistiques"/>

                </div>
            </div>
        </form>
        <div id="calendar"></div>

        <table>
            <tr>
                <th>Nombre de commandes r&eacute;l&eacute;es</th>
                <th>le chiffre d'affaires correspondant</th>
            </tr>


            <?php
            
            $nbDemendeEntente = 0;
            $CA = 0;             
            
            $query = "SELECT count(*) AS NB FROM COMMANDE WHERE  STR_TO_DATE(COMMANDE_FACTURATION , '%d-%m-%Y' )>='".$dateDebut."' AND STR_TO_DATE(COMMANDE_FACTURATION , '%d-%m-%Y')<='".$dateFin."' AND COMMANDE_STATUT =  '2'" ;
           
            $result = mysql_query("$query");
            if (!$result) 
            {
             die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
               
                     $nbDemendeEntente = $row["NB"];
              } 
              mysql_free_result($result);
            }
            
             $query = "SELECT sum(COMMANDE_PRIX) AS CA FROM COMMANDE WHERE STR_TO_DATE(COMMANDE_FACTURATION , '%d-%m-%Y' )>='".$dateDebut."' AND STR_TO_DATE(COMMANDE_FACTURATION , '%d-%m-%Y')<='".$dateFin."' AND COMMANDE_STATUT =  '2'" ;
            
            $result = mysql_query("$query");
            if (!$result) 
            {
             die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
               
                     $CA = $row["CA"];
              } 
              mysql_free_result($result);
            }

            
            
             echo "<tr>";            
             echo "<th>".$nbDemendeEntente."</th>";            
             echo " <th>".$CA." &euro;</th>  "; 
             echo "</tr>";          
            
            ?>

        </table>
        <br/>
        <br/>

        <h2>la liste des commandes r&eacute;l&eacute;es</h2>

        <?php
            echo '<table>
                ';
                echo '<tr>
                    ';
                    echo '<th></th>';
                    echo '<th>Nom Pr&eacute;nom</th>';
                    echo '<th>Num.commande</th>';
                    echo '<th></th>';

                    echo '
                </tr>';
                
                
                $query = "SELECT * FROM COMMANDE INNER JOIN CLIENT ON COMMANDE_CLIENT_NUM = CLIENT_NUM WHERE STR_TO_DATE(COMMANDE_FACTURATION , '%d-%m-%Y' )>='".$dateDebut."' AND STR_TO_DATE(COMMANDE_FACTURATION , '%d-%m-%Y')<='".$dateFin."' AND COMMANDE_STATUT =  '2'" ;
                
                $result = mysql_query("$query");
                while ($row = mysql_fetch_array($result)) 
              {
                echo '<tr  onmousemove="lavend(this)" onmouseout ="transp(this)">'
                      ,'<td><a href="javascript:window.location.href=\'../Consultation_Dossier_Commande/?clientNum=', $row["CLIENT_NUM"].'&commandeNum='.$row["COMMANDE_NUM"] ,'\'" ><img border=0 src="../Images/interface/loupe.gif" title="Consulter" ></img></a></td>'
                      ,'<td><nobr>',$row["CLIENT_NOM"],' ',$row["CLIENT_PRENOM"], '</nobr</td>'
                      ,'<td>',$row["COMMANDE_NUM_FACTURE"],'</td>'
                      ,'<td><a href="javascript:window.location.href=\'../Dossier_Commande/?clientNum=', $row["CLIENT_NUM"].'&commandeNum='.$row["COMMANDE_NUM"] ,'\'" ><img border=0 src="../Images/interface/b_edit.png" title="Modifier" ></img></a></td>';
                     
                     echo '</tr>';
                     
              } 
              mysql_free_result($result);
        
        
        echo '</table>';
                
             ?>

    </div>


</div>
<?php require_once("../Footer/Footer.php");?>