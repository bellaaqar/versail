<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>

<div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
  <div id="bloc">
    <h2>Modification commande</h2>    
    <form method="post">
      <?php
            

             if(isset($_POST["validation"]) && $_POST["validation"]== "ok" )
            {
              
              $query_update = "UPDATE COMMANDE SET";
              $query_update = $query_update." COMMANDE_DATE_ACCORD ='".$_POST["date"]."',";
              
              if(isset($_POST["orthese"]))
              {
                
                $query_update = $query_update." COMMANDE_ORTHESE ='".$_POST["orthese"]."',";
              }
              else
              {
                $query_update = $query_update." COMMANDE_ORTHESE ='',";
              }
              if(isset($_POST["piquage"]))
              {
                $query_update = $query_update." COMMANDE_PAT_COUP_PIC ='".$_POST["piquage"]."',";
              }
              else
              {
                $query_update = $query_update." COMMANDE_PAT_COUP_PIC ='',";
              }
              if(isset($_POST["montage"]))
              {
                $query_update = $query_update." COMMANDE_MONTAGE ='".$_POST["montage"]."',";
              }
              else
              {
                $query_update = $query_update." COMMANDE_MONTAGE ='',";
              }
              if(isset($_POST["finition"]))
              {
                $query_update = $query_update." COMMANDE_FINITION ='".$_POST["finition"]."',";
              }
              else
              {
                $query_update = $query_update." COMMANDE_FINITION ='',";
              }
              
              
              $query_update = $query_update." COMMANDE_DATE_ORTHESE ='".$_POST["dateOrthese"]."',";
              $query_update = $query_update." COMMANDE_DATE_PICAGE ='".$_POST["datePicage"]."',";
              $query_update = $query_update." COMMANDE_DATE_MONTAGE ='".$_POST["dateMontage"]."',";
              $query_update = $query_update." COMMANDE_DATE_FINITION ='".$_POST["dateFinition"]."',";
              $query_update = $query_update." COMMANDE_PRODUITS ='".$_POST["listeCommandes"]."',";
              $query_update = $query_update." COMMANDE_PRESCRIPTEUR ='".$_POST["prescripteur"]."',";
              $query_update = $query_update." COMMANDE_PRESCRIPTEUR_CODE ='".$_POST["prescripteurCode"]."',";
              
              $query_update = $query_update." COMMANDE_COMMENATIRE ='".$_POST["commentaire"]."',";
              $query_update = $query_update." COMMANDE_COMMENATIRE_FACTURE ='".$_POST["commentaireFacture"]."',";
              $today = getdate();
              $query_update = $query_update." COMMANDE_DATE_MODIFICATION ='".$today["mday"]."-".$today["mon"]."-".$today["year"]."',";
              
              $query_update = $query_update." COMMANDE_DATE_PRESCRIPTION ='".$_POST["datePrescription"]."',";
              $query_update = $query_update." COMMANDE_DEMANDE_DETENTE ='".$_POST["dateDemandeEntente"]."',";
              $query_update = $query_update." COMMANDE_FACTURATION ='".$_POST["dateFacturation"]."',";
              $query_update = $query_update." COMMANDE_REGLEMENT ='".$_POST["dateReglement"]."',";
              
              if(isset($_POST["ticketModerateur"]))
              {
                $query_update = $query_update." COMMANDE_TICKET_MODERATEUR ='".$_POST["ticketModerateur"]."',";
              }
              else
              {
                $query_update = $query_update." COMMANDE_TICKET_MODERATEUR ='',";
              }
              
              
              $query_update = $query_update." COMMANDE_ATTRIBUTION ='".$_POST["attribution"]."',";
              $query_update = $query_update." COMMANDE_STATUT ='".$_POST["statutCommande"]."'";
              $query_update = $query_update." WHERE COMMANDE_NUM =".$_GET["commandeNum"]." AND COMMANDE_CLIENT_NUM =".$_GET["clientNum"];
              
              $result = mysql_query($query_update);
              
              if (!$result) 
              {
               echo $query_insert;
                die('<div class="msg">Erreur: '. mysql_error().'\n'.$query_update.'</div>');
              }
              else
              {
                
                $query_insert = "UPDATE CLIENT SET CLIENT_NUMERO_FORME='".$_POST["forme"]."', CLIENT_CLASSE = '".$_POST["classe"]."' WHERE CLIENT_NUM =".$_GET["clientNum"];
                mysql_query($query_insert);
                
                
             
                 header("Location:../Consultation_Dossier_Commande/?commandeNum=".$_GET["commandeNum"]."&clientNum=".$_GET["clientNum"]."&message=Modification effectu%E9 avec succ%E9s");
               
                
                
              }


            }
            ?>
        <div class="dossier-client">
            <?php


              
           $query = "SELECT * FROM  COMMANDE  INNER JOIN CLIENT ON COMMANDE_CLIENT_NUM = CLIENT_NUM WHERE COMMANDE_NUM =".$_GET["commandeNum"]." AND COMMANDE_CLIENT_NUM =".$_GET["clientNum"];
           
           $result = mysql_query($query);
            if (!$result) 
            {
              die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              while ($row = mysql_fetch_array($result)) 
              {
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Nom et Pr&eacute;nom client: </div><div class='link-client'><strong><a href='../Commande_Client/?clientNum=".$_GET["clientNum"]."'>".$row["CLIENT_PRENOM"]." ".$row["CLIENT_NOM"]."</a></strong></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>N.SS:</div><div class=dossier-client-right>".$row["CLIENT_NSS"]."</div></div>";
                 
                 $typeRE = strpos($row["COMMANDE_NUM_FACTURE"], "RE");
                 $typeCH = strpos($row["COMMANDE_NUM_FACTURE"], "CH");
                 $typeSE = strpos($row["COMMANDE_NUM_FACTURE"], "SE");
                 if($typeRE > 0)
                 {
                    $typeCommande = "R&eacute;paration";
                    $clauseWhere  = " WHERE PRODUIT_TYPE = 'RE'";
                 }
                 else if($typeCH > 0)
                 {
                     $typeCommande =  "Chaussures";
                     $clauseWhere  = " WHERE PRODUIT_TYPE = 'CH'";
                 }
                 else if($typeSE > 0)
                 {
                     $typeCommande =  "Semelle";
                     $clauseWhere  = " WHERE PRODUIT_TYPE = 'SE'";
                 }
                 else
                 {
                     $typeCommande =  "Type inconnu";
                     $clauseWhere  = "";
                     
                 }
                 echo "<div class=dossier-client-ligne><div class=dossier-client-left>Type commande:</div><div class=dossier-client-right>".$typeCommande."</div></div>";
                 echo "<div class=dossier-client-ligne><div class=dossier-client-left>Num.commande:</div><div class=dossier-client-right>".$row["COMMANDE_NUM_FACTURE"]."</div></div>";
                 echo "<div class=dossier-client-ligne><div class=dossier-client-left>Classe:</div><div class=dossier-client-right>";
                 $selected1 = "";
                 $selected2 = "";
                 $selected3 = "";
                 $selected4 = "";
                 $selected5 = "";
                 switch($row["CLIENT_CLASSE"])
                 {
                    case "CLASSE A 100 %": $selected1 = "selected"; break;
                    case "CLASSE A 65 %":  $selected2 = "selected"; break;
                    case "CLASSE B 100 %": $selected3 = "selected"; break;
                    case "CLASSE B 65 %":  $selected4 = "selected"; break;
                    case "COMMANDE PRIVEE":  $selected5 = "selected"; break;
                 }
                 echo "<select name='classe'><option value=''>Choix...</option><option ".$selected1." value='CLASSE A 100 %' >CLASSE A 100 %</option><option ".$selected2." value='CLASSE A 65 %'>CLASSE A 65 %</option><option value='CLASSE B 100 %' ".$selected3.">CLASSE B 100 %</option><option value='CLASSE B 65 %' ".$selected4.">CLASSE B 65 %</option><option ".$selected5." value='COMMANDE PRIVEE' >COMMANDE PRIVEE</option></select></div></div>";
             
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date d'accord:</div><div class=dossier-client-right><input class='input-date-accord' maxLength='10' name='date' id='date' type='text' value='".$row["COMMANDE_DATE_ACCORD"]."'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('date',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg5' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Forme:</div><div class=dossier-client-right><input  name='forme' type='text' value='".$row["CLIENT_NUMERO_FORME"]."' /></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Prescripteur:</div><div class=dossier-client-right><input name='prescripteur' type='text' value='".$row["COMMANDE_PRESCRIPTEUR"]."' /></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code prescripteur:</div><div class=dossier-client-right><input name='prescripteurCode' type='text' value='".$row["COMMANDE_PRESCRIPTEUR_CODE"]."' /></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date prescription:</div><div class=dossier-client-right><input class='input-date-accord' maxLength='10' type='text' name='datePrescription' id='datePrescription' value='".$row["COMMANDE_DATE_PRESCRIPTION"]."'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('datePrescription',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg6' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
                $checked0 = "";
                $checked1 = "";
                $checked2 = "";
                $checked3 = "";
                if($row["COMMANDE_ORTHESE"]=="on")
                {
                    $checked0 = "checked";
                }
                if($row["COMMANDE_PAT_COUP_PIC"]=="on")
                {
                    $checked1 = "checked";
                    
                }
                if($row["COMMANDE_MONTAGE"]=="on")
                {
                    $checked2 = "checked";
                }
                if($row["COMMANDE_FINITION"]=="on")
                {
                    $checked3 = "checked";
                }                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Orth&eacute;se:</div><div class=dossier-client-right><input  class='size' name='orthese' $checked0   type='checkbox' /><input class='input-date' maxLength='10' type='text' name='dateOrthese' id='dateOrthese' value='".$row["COMMANDE_DATE_ORTHESE"]."'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateOrthese',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg1' alt='Modifier la date' title='Modifier la date'/></a> </div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Patronage/Couper/Piquage:</div><div class=dossier-client-right><input  class='size' name='piquage' $checked1  type='checkbox' /><input class='input-date' maxLength='10' type='text' name='datePicage' id='datePicage' value='".$row["COMMANDE_DATE_PICAGE"]."'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('datePicage',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg2' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Montage:</div><div class=dossier-client-right><input  class='size' name='montage' $checked2  type='checkbox' /></div><input class='input-date' type='text' maxLength='10' name='dateMontage' id='dateMontage' value='".$row["COMMANDE_DATE_MONTAGE"]."'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateMontage',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg3' alt='Modifier la date' title='Modifier la date'/></a></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Finition:</div><div class=dossier-client-right><input  class='size' name='finition' $checked3 type='checkbox' /><input class='input-date' type='text' maxLength='10' name='dateFinition' id='dateFinition' value='".$row["COMMANDE_DATE_FINITION"]."'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateFinition',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg4' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Liste des produits:</div><div class=dossier-client-right><input type='button' value='Voir' onclick='ShowProduit()'></div></div>"; 
                
                $checked = "";
                if($row["COMMANDE_TICKET_MODERATEUR"]=="on")
                {
                    $checked = "checked";
                }                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Exon&eacute;ration du ticket mod&eacute;rateur:</div><div class=dossier-client-right><input  class='size' name='ticketModerateur' $checked   type='checkbox' /></div></div>";
                
                
              $selected1 = "";
                $selected2 = "";
                $selected3 = "";
                $selected0 = "";           
                
                switch($row["COMMANDE_ATTRIBUTION"])
                {
                    case "1" : $selected1 = "selected";
                    break;
                    case "2" :  $selected2 = "selected";
                    break;
                    case "3" :  $selected3 = "selected";
                    break;
                    case "0" :  $selected0 = "selected"; 
                    break;
                    default :
                    break;
                }  
              
              
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Position de la demande</div><div class=dossier-client-right><select name='attribution'>"; 
              echo "<option value='0' $selected0>Choix...</option>";
              echo "<option value='1' $selected1>Premi&eacute;re attribution</option>";
              echo "<option value='2' $selected2>Deuxi&eacute;me attribution</option>";
              echo "<option value='3' $selected3>Renouvelement</option>";
              echo "<option value='4'>Appareil provisoire</option>";
              echo "<option value='5'>R&eacute;paration</option>";
              echo "</select></div></div>";
                
                              
                
                $selected1 = "";
                $selected2 = "";
                $selected3 = "";
                $selected0 = "";           
                
                switch($row["COMMANDE_STATUT"])
                {
                    case "1" : $selected1 = "selected";
                    break;
                    case "2" :  $selected2 = "selected";
                    break;
                    case "3" :  $selected3 = "selected";
                    break;
                    case "0" :  $selected0 = "selected"; 
                    break;
                    default :
                    break;
                }
                
                
                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Statut de la commande</div><div class=dossier-client-right><select name='statutCommande'>"; 
                echo "<option value='0' $selected0 >Choix...</option>";
                echo "<option value='1' $selected1 >Facture Cr&eacute;&eacute;e et non pay&eacute;e</option>";
                echo "<option value='2' $selected2 >Facture Cr&eacute;&eacute;e et pay&eacute;e</option>";
                echo "<option value='3' $selected3 >Commande annul&eacute;e</option>";
                echo "</select></div></div>";
                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date demande d'entente:</div><div class=dossier-client-right><input class='input-date-accord' maxLength='10' type='text' name='dateDemandeEntente' id='dateDemandeEntente' value='".$row["COMMANDE_DEMANDE_DETENTE"]."'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateDemandeEntente',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg7' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date de facturation:</div><div class=dossier-client-right><input class='input-date-accord' maxLength='10' type='text' name='dateFacturation' id='dateFacturation' value='".$row["COMMANDE_FACTURATION"]."'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateFacturation',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg8' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date de r&eacute;glement:</div><div class=dossier-client-right><input class='input-date-accord' maxLength='10' type='text' name='dateReglement' id='dateReglement' value='".$row["COMMANDE_REGLEMENT"]."'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateReglement',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg9' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
                
                
                
                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Commentaire pour facture:</div><div class=dossier-client-right><textarea name='commentaireFacture' rows='2'>".$row["COMMANDE_COMMENATIRE_FACTURE"]."</textarea></div></div>";
                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Commentaire:</div><div class=dossier-client-right><textarea name='commentaire' rows='5'>".$row["COMMANDE_COMMENATIRE"]."</textarea></div></div>";           
                $refProduits         = explode ("-",$row["COMMANDE_PRODUITS"]);
                $commandeProduits    = $row["COMMANDE_PRODUITS"];
                echo  '<input type="hidden" name="listeCommandes" value ="'.$row["COMMANDE_PRODUITS"].'" id="listeCommandes"></input>';

              }
              mysql_free_result($result);
              
            }    
         
             echo '</div>';
             echo '<div class="btn">';
              echo '<input type="hidden" value="ok" name="validation" />';
            echo '<input id="validation" type="submit" value = "Enregistrer" ></input>';
             echo '</div>';
            
        ?>
            <div id="calendar"></div>
            <?php
        
        echo '<div id="produit" style="display:none">';
        $query = "SELECT * FROM PRODUIT" . $clauseWhere;
           $result = mysql_query("$query");
            if (!$result) 
            {
              die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              $nbSupp           = "";
              $produitSupp      = "";
              $designationSupp  = "";
              $prixSupp         = "";
              while ($row = mysql_fetch_array($result)) 
              {
                $checked = "";
                foreach($refProduits as $valeur)
                { 
                     $selected1 = "";
                     $selected2 = "";
                     $selected3 = "";
                     $selected4 = "";
                     $selected5 = "";
                     //echo strlen($valeur)."__".$valeur;
                     if(strlen($valeur)>0)
                     {
                         list($nb, $produit) = explode(".", $valeur);
                           //echo $nb."__".$produit;                   
                         if($row["PRODUIT_CODE"] == $produit)
                         {
                            
                            switch($nb)
                            {
                                case "1" : $selected1 = "selected"; break;
                                case "2" : $selected2 = "selected"; break;
                                case "3" : $selected3 = "selected"; break;
                                case "4" : $selected4 = "selected"; break;
                                case "5" : $selected5 = "selected"; break;                            
                            }
                            
                            break;                       
                            
                         }
                     }
                     
                }     
                
                echo "<select class='size' onchange=AddProduit('".$row["PRODUIT_CODE"]."',this.options[this.selectedIndex].value,'','')>";
                 echo "<option value='0'>0</option>";
                 echo "<option value='1' ".$selected1.">1</option>";
                 echo "<option value='2' ".$selected2.">2</option>";
                 echo "<option value='3' ".$selected3.">3</option>";
                 echo "<option value='4' ".$selected4.">4</option>";
                 echo "<option value='5' ".$selected5.">5</option>";
                 echo "</select> ";
                 
                 echo $row["PRODUIT_DESIGNATION"] . " : " .$row["PRODUIT_PRIX"] . " &euro;<br><br>";           
          
              }
              mysql_free_result($result);
              foreach($refProduits as $valeur)
              {
                  if(strlen($valeur)>0)
                  {
                         list($nb, $produit) = explode(".", $valeur);  
                         if($produit == "000000")
                         {
                            list($nbSupp, $produitSupp,$designationSupp,$prixSupp) = explode(".", $valeur);
                            break;
                         }
                 }
              }
              $selected1 = "";
              $selected2 = "";
              $selected3 = "";
              $selected4 = "";
              $selected5 = "";
              switch($nbSupp)
              {
                  case "1" : $selected1 = "selected"; break;
                  case "2" : $selected2 = "selected"; break;
                  case "3" : $selected3 = "selected"; break;
                  case "4" : $selected4 = "selected"; break;
                  case "5" : $selected5 = "selected"; break;                            
              }
              
              echo "<select class='size' id='suppSelect' onchange=AddProduit('000000',this.options[this.selectedIndex].value,'suppDesi','suppPrix')>";
              echo "<option value='0'>0</option>";
              echo "<option value='1' ".$selected1.">1</option>";
              echo "<option value='2' ".$selected2.">2</option>";
              echo "<option value='3' ".$selected3.">3</option>";
              echo "<option value='4' ".$selected4.">4</option>";
              echo "<option value='5' ".$selected5.">5</option>";
              echo "</select> ";
              
              echo "Suppl&eacute;ment (D&eacute;signation/Prix) : <input type='text' value='".$designationSupp."' id='suppDesi' onblur=AddProduit('000000',document.getElementById('suppSelect').options[document.getElementById('suppSelect').selectedIndex].value,'suppDesi','suppPrix')> <input class='prix' type='text' id='suppPrix' value='".$prixSupp."' onblur=AddProduit('000000',document.getElementById('suppSelect').options[document.getElementById('suppSelect').selectedIndex].value,'suppDesi','suppPrix')> &euro;"; 
              
              
              
              
              
            }
        echo '<a class="femer" href="javascript:" onclick="HideProduit()">Fermer</a></div>';
        
        
        ?>
           

        </form>

        </div>

        
      </div>
<?php require_once("../Footer/Footer.php");?>