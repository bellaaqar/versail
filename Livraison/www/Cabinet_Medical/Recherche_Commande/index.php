<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>

<div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
  <div id="bloc">
    <h2>Recherche Commande</h2>
    <form method="post">

        <div class="recherche-commande">
        <?php
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Num.Commande:</div><div class=dossier-client-right><input class='input-date-accord' name='numCommande' id='date' type='text'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Orth&eacute;se:</div><div class=dossier-client-right><input  class='size' name='orthese' type='checkbox' /><input class='input-date' maxLength='10' type='text' name='dateOrthese' id='dateOrthese' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateOrthese',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg1' alt='Modifier la date' title='Modifier la date'/></a> </div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Patronage/Couper/Piquage:</div><div class=dossier-client-right><input  class='size' name='piquage'  type='checkbox' /><input class='input-date' maxLength='10' type='text' name='datePicage' id='datePicage' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('datePicage',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg2' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Montage:</div><div class=dossier-client-right><input  class='size' name='montage' type='checkbox' /><input class='input-date' type='text' maxLength='10' name='dateMontage' id='dateMontage' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateMontage',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg3' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Finition:</div><div class=dossier-client-right><input  class='size' name='finition' type='checkbox' /><input class='input-date' type='text' maxLength='10' name='dateFinition' id='dateFinition' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateFinition',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg4' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date d'accord:</div><div class=dossier-client-right><input class='input-date-accord' maxLength='10' name='date' id='date' type='text' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('date',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg5' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Statut de la commande</div><div class=dossier-client-right><select name='statutCommande'>"; 
                echo "<option value=''>Choix...</option>";
                echo "<option value='1'>Facture Cr&eacute;&eacute;e et non pay&eacute;e</option>";
                echo "<option value='2'>Facture Cr&eacute;&eacute;e et pay&eacute;e</option>";
                echo "<option value='3'>Commande annul&eacute;e</option>";
                echo "</select></div></div>"; 
        ?>
            <div class="btn-recherche">
                <input type="hidden" value="ok" name="validation" />
                <input type="submit" value="Rechercher"></input>
            </div>
    </div>
        <?php
  if(isset($_POST["validation"]) && $_POST["validation"]== "ok" )
  {
        echo '<table>';
        echo '<tr>';        
        echo '<th></th>';        
        echo '<th>Nom Pr&eacute;nom</th>';       
        echo '<th>Num.commande</th>';      
        echo '<th></th>';

        echo '</tr>';
        
        $query = "SELECT * FROM COMMANDE INNER JOIN CLIENT ON COMMANDE_CLIENT_NUM = CLIENT_NUM where "; 
        $query = $query."COMMANDE_NUM_FACTURE LIKE '%". $_POST["numCommande"] ."%' AND ";
        $query = $query."COMMANDE_ORTHESE LIKE '%". $_POST["orthese"] ."%' AND ";
        $query = $query."COMMANDE_PAT_COUP_PIC LIKE '%". $_POST["piquage"] ."%' AND ";
        $query = $query."COMMANDE_MONTAGE LIKE '%". $_POST["montage"] ."%' AND ";
        $query = $query."COMMANDE_FINITION LIKE '%". $_POST["finition"] ."%' AND ";
        if($_POST["dateOrthese"] != "jj-mm-aaaa")
            $query = $query."COMMANDE_DATE_ORTHESE LIKE '%". $_POST["dateOrthese"] ."%' AND ";
        if($_POST["datePiquage"] != "jj-mm-aaaa")
            $query = $query."COMMANDE_DATE_PICAGE LIKE '%". $_POST["datePiquage"] ."%' AND ";
        if($_POST["dateMontage"] != "jj-mm-aaaa")
            $query = $query."COMMANDE_DATE_MONTAGE LIKE '%". $_POST["dateMontage"] ."%' AND ";
        if($_POST["dateFinition"] != "jj-mm-aaaa")
            $query = $query."COMMANDE_DATE_FINITION LIKE '%". $_POST["dateFinition"] ."%' AND ";
        if($_POST["date"] != "jj-mm-aaaa")
            $query = $query."COMMANDE_DATE_ACCORD LIKE '%". $_POST["date"] ."%' AND ";
        $query = $query."COMMANDE_STATUT LIKE '%". $_POST["statutCommande"] ."%'";
        
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
        
        
     }

  ?>
     
    </form>
      <div id="calendar"></div>
  </div>

  
</div>
<?php require_once("../Footer/Footer.php");?>