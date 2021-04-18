<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>

<div id="contenu"><?php require_once("../Menu_Gauche/Menu.php");?>
  <div id="bloc">
    <h2>Ajouter nouvelle commande</h2>    
    <form method="post">
      <?php
            
          
            if(isset($_POST["validation"]))
            {
              $query_insert = "INSERT INTO COMMANDE (COMMANDE_CLIENT_NUM,COMMANDE_DATE_ACCORD,COMMANDE_ORTHESE,COMMANDE_PAT_COUP_PIC,COMMANDE_MONTAGE,	COMMANDE_FINITION,	COMMANDE_COMMENATIRE,COMMANDE_DATE_CREATION,COMMANDE_DATE_MODIFICATION,COMMANDE_DATE_ORTHESE,COMMANDE_DATE_PICAGE,COMMANDE_DATE_MONTAGE,COMMANDE_DATE_FINITION,COMMANDE_STATUT,COMMANDE_PRODUITS,COMMANDE_COMMENATIRE_FACTURE,COMMANDE_PRESCRIPTEUR, COMMANDE_DEMANDE_DETENTE,COMMANDE_DATE_PRESCRIPTION,COMMANDE_FACTURATION,COMMANDE_REGLEMENT,COMMANDE_ATTRIBUTION,COMMANDE_TICKET_MODERATEUR, COMMANDE_PRESCRIPTEUR_CODE) VALUES(";
              $query_insert = $query_insert."'".$_GET["clientNum"]."'";              
              $query_insert = $query_insert." ,'".$_POST["date"]."'";
              if(isset($_POST["orthese"]))
              {
                $query_insert = $query_insert." ,'".$_POST["orthese"]."'";
              }
              else
              {
                $query_insert = $query_insert." ,''";
              }
              if(isset($_POST["piquage"]))
              {
                $query_insert = $query_insert." ,'".$_POST["piquage"]."'";
              }
              else
              {
                $query_insert = $query_insert." ,''";
              }
              if(isset($_POST["montage"]))
              {
                $query_insert = $query_insert." ,'".$_POST["montage"]."'";
              }
              else
              {
                $query_insert = $query_insert." ,''";
              }
              if(isset($_POST["finition"]))
              {
                $query_insert = $query_insert." ,'".$_POST["finition"]."'";  
              }
              else
              {
                $query_insert = $query_insert." ,''";
              }
              $query_insert = $query_insert." ,'".str_replace("'","''",$_POST["commentaire"])."'";
              $today = getdate();
              $query_insert = $query_insert." ,'".$today["mday"]."-".$today["mon"]."-".$today["year"]."'";
              $query_insert = $query_insert." ,'".$today["mday"]."-".$today["mon"]."-".$today["year"]."'";
                           
              $query_insert = $query_insert." ,'".$_POST["dateOrthese"]."'";
              $query_insert = $query_insert." ,'".$_POST["datePicage"]."'";
              $query_insert = $query_insert." ,'".$_POST["dateMontage"]."'";
              $query_insert = $query_insert." ,'".$_POST["dateFinition"]."'";
              
              $query_insert = $query_insert." ,'".$_POST["statutCommande"]."'";
              $query_insert = $query_insert." ,'".$_POST["listeCommandes"]."'";
               
               $query_insert = $query_insert." ,'".$_POST["commentaireFacture"]."'";
               $query_insert = $query_insert." ,'".$_POST["prescripteur"]."'";
               
               $query_insert = $query_insert." ,'".$_POST["dateDemandeEntente"]."'";
               $query_insert = $query_insert." ,'".$_POST["datePrescription"]."'";
               $query_insert = $query_insert." ,'".$_POST["dateFacturation"]."'";
               $query_insert = $query_insert." ,'".$_POST["dateReglement"]."'";
               $query_insert = $query_insert." ,'".$_POST["attribution"]."'";
               if(isset($_POST["ticketModerateur"]))
              {
                $query_insert = $query_insert." ,'".$_POST["ticketModerateur"]."'";
              }
              else
              {
                $query_insert = $query_insert." ,''";
              }
              
              
              
              
              $query_insert = $query_insert." ,'".$_POST["prescripteurCode"]."')";
          
              
              
              
              $result = mysql_query($query_insert);
              if (!$result) 
              {
               //echo $query_insert;
                die('<div class="msg">Erreur: '. mysql_error().'</div>');
              }
              else
              {
                
                $idCommande = mysql_insert_id();
                
                $query_update = "UPDATE COMMANDE SET COMMANDE_NUM_FACTURE='".$today["mday"].$today["mon"].$today["year"].$_POST["typeCommande"].$idCommande."' WHERE COMMANDE_NUM =".mysql_insert_id();
                mysql_query($query_update);
                
                $query_update = "UPDATE CLIENT SET CLIENT_NUMERO_FORME='".$_POST["forme"]."' WHERE CLIENT_NUM =".$_GET["clientNum"];
                mysql_query($query_update);                
                
                
                if($_POST["validation"]== "Enregistrer")
                {
                  header("Location:../Consultation_Dossier_Commande/?commandeNum=".$idCommande."&clientNum=".$_GET["clientNum"]."&message=Ajout effectu%E9 avec succ%E9s");
                }
                
                
              }


            }
            ?>
      <div class="dossier-client">
        
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
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Nom et Pr&eacute;nom client: </div><div class='link-client'><strong><a href='../Commande_Client/?clientNum=".$_GET["clientNum"]."'>".$row["CLIENT_PRENOM"]." ".$row["CLIENT_NOM"]."</a></strong></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>N.SS:</div><div class=dossier-client-right>".$row["CLIENT_NSS"]."</div></div>";
                $formNum = $row["CLIENT_NUMERO_FORME"];
              }
              mysql_free_result($result);
            }    
             echo "<div class=dossier-client-ligne><div class=dossier-client-left>Type commande:</div><div class=dossier-client-right><select name='typeCommande' onchange='showByTypeProduit(this.options[this.selectedIndex].value)'>"; 
              echo "<option value=''>Choix...</option>";
              echo "<option value='RE'>R&eacute;paration</option>";
              echo "<option value='CH'>Chaussures</option>";  
              echo "<option value='SE'>Semelle</option>";            
              echo "</select></div></div>"; 
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date d'accord:</div><div class=dossier-client-right><input class='input-date-accord' maxLength='10' name='date' id='date' type='text' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('date',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg5' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Forme:</div><div class=dossier-client-right><input name='forme' type='text' value='".$formNum."' /></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Prescripteur:</div><div class=dossier-client-right><input name='prescripteur' type='text' value='' /></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code prescripteur:</div><div class=dossier-client-right><input name='prescripteurCode' type='text' value='' /></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date prescription:</div><div class=dossier-client-right><input class='input-date-accord' maxLength='10' type='text' name='datePrescription' id='datePrescription' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('datePrescription',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg6' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Orth&eacute;se:</div><div class=dossier-client-right><input  class='size' name='orthese' type='checkbox' /><input class='input-date' maxLength='10' type='text' name='dateOrthese' id='dateOrthese' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateOrthese',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg1' alt='Modifier la date' title='Modifier la date'/></a> </div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Patronage/Couper/Piquage:</div><div class=dossier-client-right><input  class='size' name='piquage'  type='checkbox' /><input class='input-date' maxLength='10' type='text' name='datePicage' id='datePicage' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('datePicage',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg2' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Montage:</div><div class=dossier-client-right><input  class='size' name='montage' type='checkbox' /><input class='input-date' type='text' maxLength='10' name='dateMontage' id='dateMontage' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateMontage',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg3' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Finition:</div><div class=dossier-client-right><input  class='size' name='finition' type='checkbox' /><input class='input-date' type='text' maxLength='10' name='dateFinition' id='dateFinition' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateFinition',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg4' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Liste des produits:</div><div class=dossier-client-right><input type='button' value='Voir' onclick='ShowProduit()'></div></div>"; 
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Exon&eacute;ration du ticket mod&eacute;rateur:</div><div class=dossier-client-right><input class='size' name='ticketModerateur' $checked   type='checkbox' /></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Position de la demande</div><div class=dossier-client-right><select name='attribution'>"; 
              echo "<option value='0'>Choix...</option>";
              echo "<option value='1'>Premi&eacute;re attribution</option>";
              echo "<option value='2'>Deuxi&eacute;me attribution</option>";
              echo "<option value='3'>Renouvelement</option>";
              echo "<option value='4'>Appareil provisoire</option>";
              echo "<option value='5'>R&eacute;paration</option>";
              echo "</select></div></div>"; 
              
              
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Statut de la commande</div><div class=dossier-client-right><select name='statutCommande'>"; 
              echo "<option value='0'Choix...</option>";
              echo "<option value='1'>Facture Cr&eacute;&eacute;e et non pay&eacute;e</option>";
              echo "<option value='2'>Facture Cr&eacute;&eacute;e et pay&eacute;e</option>";
              echo "<option value='3'>Commande annul&eacute;e</option>";
              echo "</select></div></div>";             
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date demande d'entente:</div><div class=dossier-client-right><input class='input-date-accord' maxLength='10' type='text' name='dateDemandeEntente' id='dateDemandeEntente' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateDemandeEntente',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg7' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date de facturation:</div><div class=dossier-client-right><input class='input-date-accord' maxLength='10' type='text' name='dateFacturation' id='dateFacturation' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateFacturation',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg8' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date de r&eacute;glement:</div><div class=dossier-client-right><input class='input-date-accord' maxLength='10' type='text' name='dateReglement' id='dateReglement' value='jj-mm-aaaa'/> <a href='javascript:'><img src='../Images/interface/calendar.gif' border='0' onclick=\"displayCalendar('dateReglement',this.offsetLeft,this.offsetTop, event)\"; id='calendarImg9' alt='Modifier la date' title='Modifier la date'/></a></div></div>";
              
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Commentaire pour facture:</div><div class=dossier-client-right><textarea name='commentaireFacture' rows='2'></textarea></div></div>";
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Commentaire:</div><div class=dossier-client-right><textarea name='commentaire' rows='5'></textarea></div></div>";           
         
          ?>
            </div>
            <div class="btn">
              <input type="hidden" value="" name="validation" id="validation" />
              <input type="submit" value="Enregistrer" onclick="document.getElementById('validation').value='Enregistrer';"></input>              
                
                
            </div>
        <div id="calendar"></div>
        <?php
        
        echo '<div id="produit" style="display:none">';
        $query = "SELECT * FROM PRODUIT ORDER BY PRODUIT_TYPE";
           $result = mysql_query("$query");
            if (!$result) 
            {
              die('<div class="msg">Erreur: ' . mysql_error().'</div>');
            }
            else
            {
              
              $type     = "";
              $typeOld  = "";
              while ($row = mysql_fetch_array($result)) 
              {
                $type = $row["PRODUIT_TYPE"];
                if($type != $typeOld)
                {
                    if($typeOld != "")
                    {
                        echo "<select class='size' onchange=AddProduit('000000',this.options[this.selectedIndex].value,'suppDesi".$typeOld."','suppPrix".$typeOld."')>";
                        echo "<option value='0'>0</option>";
                        echo "<option value='1'>1</option>";
                        echo "<option value='2'>2</option>";
                        echo "<option value='3'>3</option>";
                        echo "<option value='4'>4</option>";
                        echo "<option value='5'>5</option>";
                        echo "</select> ";
                        echo "Suppl&eacute;ment (D&eacute;signation/Prix) : <input type='text' id='suppDesi".$typeOld."'> <input class='prix' type='text' id='suppPrix".$typeOld."'> &euro;"; 
                        echo "</div>"; 
                    }
                    echo " <div class='hide' id='".$row["PRODUIT_TYPE"]."'>";
                }
                 echo "<select class='size' onchange=AddProduit('".$row["PRODUIT_CODE"]."',this.options[this.selectedIndex].value,'','')>";
                 echo "<option value='0'>0</option>";
                 echo "<option value='1'>1</option>";
                 echo "<option value='2'>2</option>";
                 echo "<option value='3'>3</option>";
                 echo "<option value='4'>4</option>";
                 echo "<option value='5'>5</option>";
                 echo "</select> ";
                 
                 echo $row["PRODUIT_DESIGNATION"] . " : " .$row["PRODUIT_PRIX"] . " &euro;<br><br>";                
                
                $typeOld = $type;
              }
              echo "<select class='size' onchange=AddProduit('000000',this.options[this.selectedIndex].value,'suppDesi".$typeOld."','suppPrix".$typeOld."')>";
                 echo "<option value='0'>0</option>";
                 echo "<option value='1'>1</option>";
                 echo "<option value='2'>2</option>";
                 echo "<option value='3'>3</option>";
                 echo "<option value='4'>4</option>";
                 echo "<option value='5'>5</option>";
                 echo "</select> ";
               echo "Suppl&eacute;ment (D&eacute;signation/Prix) : <input type='text' id='suppDesi".$type."'> <input class='prix' type='text' id='suppPrix".$type."'> &euro;"; 
              echo "</div>"; 
            }
        echo '<a class="femer" href="javascript:" onclick="HideProduit()">Fermer</a></div>';
        
        
        ?>
        <input type="hidden" name="listeCommandes" id="listeCommandes"></input>
       
          </form>

        </div>

        
      </div>
<?php require_once("../Footer/Footer.php");?>