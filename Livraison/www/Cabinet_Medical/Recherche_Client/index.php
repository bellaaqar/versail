<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>

<div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
  <div id="bloc">
    <h2>Recherche client</h2>
    <form method="post">
      <div class="recherche-client">
        <div class="recherche-client-ligne">
          <div class="recherche-client-left">N.SS:</div>
          <div class="recherche-client-right">
            <?php
            $value1 = "";
            if(isset($_POST["numeroSS1"]))
            {
              $value1 = $_POST["numeroSS1"];
            }
             $value2 = "";
            if(isset($_POST["numeroSS2"]))
            {
              $value2 = $_POST["numeroSS2"];
            }
             $value3 = "";
            if(isset($_POST["numeroSS3"]))
            {
              $value3 = $_POST["numeroSS3"];
            }
             $value4 = "";
            if(isset($_POST["numeroSS4"]))
            {
              $value4 = $_POST["numeroSS4"];
            }
             $value5 = "";
            if(isset($_POST["numeroSS5"]))
            {
              $value5 = $_POST["numeroSS5"];
            }
             $value6 = "";
            if(isset($_POST["numeroSS6"]))
            {
              $value6 = $_POST["numeroSS6"];
            }
             $value7 = "";
            if(isset($_POST["numeroSS7"]))
            {
              $value7 = $_POST["numeroSS7"];
            }
            echo '<input class="ss1" name=numeroSS1 maxlength=1  type=text value="'.$value1.'"></input>';
            echo '<input class="ss2" name=numeroSS2 maxlength=2  type=text value="'.$value2.'"></input>';
            echo '<input class="ss3" name=numeroSS3 maxlength=2  type=text value="'.$value3.'"></input>';
            echo '<input class="ss4" name=numeroSS4 maxlength=2  type=text value="'.$value4.'"></input>';
            echo '<input class="ss5" name=numeroSS5 maxlength=3  type=text value="'.$value5.'"></input>';
            echo '<input class="ss6" name=numeroSS6 maxlength=3  type=text value="'.$value6.'"></input>';
            echo '<input class="ss7" name=numeroSS7 maxlength=2  type=text value="'.$value7.'"></input>';
            ?>
            
          </div>
        </div>
        <div class="recherche-client-ligne">
          <div class="recherche-client-left">Nom:</div>
          <div class="recherche-client-right">
            <?php
            $value = "";
            if(isset($_POST["Nom"]))
            {
              $value = $_POST["Nom"];
            }
            echo '<input name=Nom type=text value="'.$value.'"></input>';
            ?>
          </div>
        </div>
        <div class="recherche-client-ligne">
          <div class="recherche-client-left">Pr&eacute;nom:</div>
          <div class="recherche-client-right">
            <?php
            $value = "";
            if(isset($_POST["prenom"]))
            {
              $value = $_POST["prenom"];
            }
            echo '<input name=prenom type=text value="'.$value.'"></input>';
            ?>
            
          </div>
        </div>
        <div class="recherche-client-ligne">
          <div class="recherche-client-left">Ville:</div>
          <div class="recherche-client-right">
            <?php
            $value = "";
            if(isset($_POST["ville"]))
            {
            $value = $_POST["ville"];
            }
            echo '<input name="ville" type="text" value="'.$value.'"></input>';
            ?>

          </div>
        </div>
        <div class="recherche-client-ligne">
          <div class="recherche-client-left">Code postal:</div>
          <div class="recherche-client-right">
            <?php
            $value = "";
            if(isset($_POST["codePostal"]))
            {
            $value = $_POST["codePostal"];
            }
            echo '<input name="codePostal" type="text" value="'.$value.'"></input>';
            ?>            
          </div>
        </div>
       
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
        echo '<th></th>';
        echo '<th>N.SS</th>';
        echo '<th>Nom</th>';
        echo '<th>Pr&eacute;nom</th>';
        echo '<th>Adresse</th>';
        echo '<th>Code postal</th>';
        echo '<th>Ville</th>';
        echo '<th>T&eacute;l&eacute;phone</th>';
        echo '<th></th>';
        echo '<th style="display:none"></th>';

        echo '</tr>';
        
       
       
        
        $query = "SELECT * FROM CLIENT where "; 
        $query = $query."SUBSTRING(REPLACE(CLIENT_NSS,' ',''),1,1) LIKE '%". $_POST["numeroSS1"] ."%' AND "; 
        $query = $query."SUBSTRING(REPLACE(CLIENT_NSS,' ',''),2,2) LIKE '%". $_POST["numeroSS2"] ."%' AND ";  
        $query = $query."SUBSTRING(REPLACE(CLIENT_NSS,' ',''),4,2) LIKE '%". $_POST["numeroSS3"] ."%' AND ";  
        $query = $query."SUBSTRING(REPLACE(CLIENT_NSS,' ',''),6,2) LIKE '%". $_POST["numeroSS4"] ."%' AND ";  
        $query = $query."SUBSTRING(REPLACE(CLIENT_NSS,' ',''),8,3) LIKE '%". $_POST["numeroSS5"] ."%' AND "; 
        $query = $query."SUBSTRING(REPLACE(CLIENT_NSS,' ',''),11,3) LIKE '%". $_POST["numeroSS6"] ."%' AND ";  
        $query = $query."SUBSTRING(REPLACE(CLIENT_NSS,' ',''),14,2) LIKE '%". $_POST["numeroSS7"] ."%' AND ";  
        $query = $query."CLIENT_NOM LIKE '%". $_POST["Nom"] ."%' AND ";  
        $query = $query."CLIENT_PRENOM LIKE '%". $_POST["prenom"] ."%' AND ";  
        $query = $query."CLIENT_VILLE LIKE '%". $_POST["ville"] ."%' AND ";  
        $query = $query."CLIENT_CODE_POSTALE LIKE '%". $_POST["codePostal"] ."%'";
        
        
        $result = mysql_query("$query");
       
        while ($row = mysql_fetch_array($result)) 
        {
          
        
          echo '<tr title="Acc&eacute;der au dossier" onmousemove="lavend(this)" onmouseout ="transp(this)">'
                  ,'<td><a href="javascript:window.location.href=\'../Commande_Client/?clientNum=', $row["CLIENT_NUM"] ,'\'" ><img border=0 src="../Images/interface/icone_panier.gif" title="Gestion commande" ></img></a></td>'
                 ,'<td><a href="javascript:window.location.href=\'../Consultation_Dossier_Client/?clientNum=', $row["CLIENT_NUM"] ,'\'" ><img border=0 src="../Images/interface/loupe.gif" title="Consulter" ></img></a></td>'
                ,'<td><nobr>',$row["CLIENT_NSS"],'</nobr</td>'
                ,'<td>',$row["CLIENT_NOM"],'</td>'
                ,'<td>',$row["CLIENT_PRENOM"],'</td>'                   
                ,'<td>',$row["CLIENT_ADRESSE"],'</td>'                   
                ,'<td>',$row["CLIENT_CODE_POSTALE"],'</td>'
                ,'<td>',$row["CLIENT_VILLE"],'</td>'                   
                ,'<td>',$row["CLIENT_TELEPHONE_FIXE"],'</td>'
		    ,'<td><a href="javascript:window.location.href=\'../Dossier_Client/?clientNum=', $row["CLIENT_NUM"] ,'\'" ><img border=0 src="../Images/interface/b_edit.png" title="Modifier" ></img></a></td>'
                ,'<td style="display:none" ><a href="javascript:if(confirm(\'Voulez-vous supprimer ce client?\'))window.location.href=\'../Suppression_Client/?clientNum='.$row["CLIENT_NUM"],'\'" ><img border=0 src="../Images/interface/b_drop.png" title="Effacer" ></img></a></td>'                   
                ,'</tr>';
               
        } 

        mysql_free_result($result);              
        echo '</table>';
     }

  ?>

    </form>
  </div>

  
</div>
<?php require_once("../Footer/Footer.php");?>