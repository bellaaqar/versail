<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>

      <div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
        <div id="bloc">
          <h2>Consultation des statistiques g&eacute;n&eacute;rales</h2>
            
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
                                <input class='input-date-accord' maxLength='10' name='dateDebut' id='dateDebut' type='text' value='<?php echo $todayFormate;?>'/>
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
                                <input class='input-date-accord' maxLength='10' name='dateFin' id='dateFin' type='text' value='<?php echo $finAnneeFormate;?>'/>
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
              
              <th>Nombre d'accord re&ccedil;u</th>
              <th>Nombre de commande factur&eacute;e</th>
              <th>Nombre de commande r&eacute;gl&eacute;e</th>
              <th>orth&eacute;se</th>
              <th>Patronage/Couper/Piquage</th>
              <th>Montage</th>
              <th>Finition</th>
              <th>CA potentiel</th>        
              
         
            </tr>

            <?php
            
            $nbAccord = 0;
            $nbCommandeFacture = 0; 
            $nbCommandeRegle = 0; 
            $CA = 0; 
            $orthese = 0;
            $picage = 0;
            $montage = 0;
            $finition = 0; 
            
           
                      
            $query = "SELECT count(*) AS NB FROM COMMANDE WHERE  STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y' )>='".$dateDebut."' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y')<='".$dateFin."'" ;
           
            $result = mysql_query("$query");
            if (!$result) 
            {
             die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
               
                     $nbAccord = $row["NB"];
              } 
              mysql_free_result($result);
            }
            
            $query = "SELECT count(*) AS NB FROM COMMANDE WHERE COMMANDE_STATUT =  '1' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y' )>='".$dateDebut."' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y')<='".$dateFin."'" ;
           
            $result = mysql_query("$query");
            if (!$result) 
            {
             die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
               
                     $nbCommandeFacture = $row["NB"];
              } 
              mysql_free_result($result);
            }
            
            $query = "SELECT count(*) AS NB FROM COMMANDE WHERE COMMANDE_STATUT =  '2' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y' )>='".$dateDebut."' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y')<='".$dateFin."'" ;
            
            $result = mysql_query("$query");
            if (!$result) 
            {
             die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
               
                     $nbCommandeRegle = $row["NB"];
              } 
              mysql_free_result($result);
            }
            
            $query = "SELECT sum(COMMANDE_PRIX) AS CA FROM COMMANDE WHERE STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y' )>='".$dateDebut."' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y')<='".$dateFin."'" ;
            
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

            $query = "SELECT count(*) AS NB FROM COMMANDE WHERE COMMANDE_ORTHESE = 'on' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y' )>='".$dateDebut."' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y')<='".$dateFin."'" ;
            
            $result = mysql_query("$query");
            if (!$result) 
            {
             die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
               
                     $orthese = $row["NB"];
              } 
              mysql_free_result($result);
            }
            
            $query = "SELECT count(*) AS NB FROM COMMANDE WHERE COMMANDE_PAT_COUP_PIC = 'on' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y' )>='".$dateDebut."' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y')<='".$dateFin."'" ;
            
            $result = mysql_query("$query");
            if (!$result) 
            {
             die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
               
                     $picage = $row["NB"];
              } 
              mysql_free_result($result);
            }
            
            $query = "SELECT count(*) AS NB FROM COMMANDE WHERE COMMANDE_MONTAGE = 'on' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y' )>='".$dateDebut."' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y')<='".$dateFin."'" ;
            
            $result = mysql_query("$query");
            if (!$result) 
            {
             die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
               
                     $montage = $row["NB"];
              } 
              mysql_free_result($result);
            }
            
            $query = "SELECT count(*) AS NB FROM COMMANDE WHERE COMMANDE_FINITION = 'on' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y' )>='".$dateDebut."' AND STR_TO_DATE(COMMANDE_DATE_ACCORD , '%d-%m-%Y')<='".$dateFin."'" ;
            
            $result = mysql_query("$query");
            if (!$result) 
            {
             die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
               
                     $finition = $row["NB"];
              } 
              mysql_free_result($result);
            }

            echo "<tr>";
            
             echo "<th>".$nbAccord."</th>";
             echo "<th>".$nbCommandeFacture."</th>";
             echo " <th>".$nbCommandeRegle."</th>";
             echo " <th>".$orthese."</th>";
             echo " <th>".$picage."</th>";
             echo " <th>".$montage."</th>";
             echo " <th>".$finition."</th>";
             echo " <th>".$CA." &euro;</th>  ";      
              
         
            echo "</tr>";

          
          ?>
        </table>

          
        
      </div>

        
      </div>
<?php require_once("../Footer/Footer.php");?>