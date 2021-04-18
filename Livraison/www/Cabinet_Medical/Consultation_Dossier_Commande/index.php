<?php require("../Lib/zip.lib.php");?>
<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>

<div id="contenu">
    <?php require_once("../Menu_Gauche/Menu.php");?>
    <div id="bloc">
        <h2>Consultation commande</h2>
        <form method="post" >
            <?php
            
            
            if(isset($_POST["validation"]) && $_POST["validation"]== "ok" )
            {
                $handleMedecin  = fopen("../Export/medecin.txt", "w");
                $handleOrgsecu  = fopen("../Export/orgsecu.txt", "w");
                $handleTransent = fopen("../Export/transent.txt","w");
                $handleLigtele  = fopen("../Export/ligtele.txt", "w");
                $handleOrgmutu  = fopen("../Export/orgmutu.txt", "w");
                
                 $query = "SELECT * FROM ORGANISME INNER JOIN CLIENT ON ORGANISME_NUM = CLIENT_ORGANISME  WHERE CLIENT_NUM = ". $_GET["clientNum"] ." AND ORGANISME_NUM =".$_POST["oranismeClient"];
                 
                   $result = mysql_query($query);
                    if (!$result) 
                    {
                      die('<div class="msg">Erreur: ' . mysql_error().'</div>');
                    }
                    else
                    {
                      while ($row = mysql_fetch_array($result)) 
                      {
                                            
                        fwrite($handleOrgsecu,$row["ORGANISME_NUM"]);
                        fwrite($handleOrgsecu,"\t");                        
                        fwrite($handleOrgsecu,'"' . $row["ORGANISME_CODE"] . '"');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'"'  . $row["ORGANISME_LIBELLE"] . '"');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'"'  . $row["ORGANISME_ADRESSE"] . '"');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'""');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'"'  . $row["ORGANISME_CODE_POSTAL"] . '"');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'"'  . $row["ORGANISME_VILLE"] . '"');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'"'  . $row["ORGANISME_TEL"] . '"');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'""');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'""');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'"'  . $row["ORGANISME_COMMENTAIRE"] . '"');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'""');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'""');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'""');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'""');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'"'  . $row["CLIENT_NSS"] . '"');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'""');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'""');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'""');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'"'  . $row["ORGANISME_EMAIL"] . '"');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'"'  . $row["ORGANISME_FAX"] . '"');
                        fwrite($handleOrgsecu,"\t");
                        fwrite($handleOrgsecu,'""');                        
                        
                        
                        
                        fwrite($handleOrgmutu,$row["ORGANISME_NUM"]);
                        fwrite($handleOrgmutu,"\t");                        
                        fwrite($handleOrgmutu,'"' . $row["ORGANISME_CODE"] . '"');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'"'  . $row["ORGANISME_LIBELLE"] . '"');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'"'  . $row["ORGANISME_ADRESSE"] . '"');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'""');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'"'  . $row["ORGANISME_CODE_POSTAL"] . '"');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'"'  . $row["ORGANISME_VILLE"] . '"');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'"'  . $row["ORGANISME_TEL"] . '"');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'"Taux de remboursement general (si vide, charge auto. a 100%)"');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'"'  . $row["ORGANISME_COMMENTAIRE"] . '"');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'""');
                        fwrite($handleOrgmutu,"\t");                        
                        fwrite($handleOrgmutu,'""');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'""');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'""');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'"Code Echeance de paiement de organisme"');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'"Code Mode de reglement de organisme"');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'"'  . $row["ORGANISME_EMAIL"] . '"');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'"'  . $row["ORGANISME_FAX"] . '"');
                        fwrite($handleOrgmutu,"\t");
                        fwrite($handleOrgmutu,'""');
                        fwrite($handleOrgmutu,'"Nprefectoral (obligatoire pour teletransmission avec norme B2-R)"');
                        fwrite($handleOrgmutu,"\t");
                        
                        
                      }
                      mysql_free_result($result);
                    }
                
                   
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
                 fwrite($handleMedecin,'"'.$row["COMMANDE_PRESCRIPTEUR"].'"');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'"'.$row["COMMANDE_PRESCRIPTEUR_CODE"].'"');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                                  
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t"); 
                 
                 fwrite($handleMedecin,'""');   
                 fwrite($handleMedecin,"\t");         
                 
                 
                 
                 
                 
                 
                  fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                 fwrite($handleLigtele,'""');   
                 fwrite($handleLigtele,"\t"); 
                 
                    
                
                 fwrite($handleTransent,'"'.$row["COMMANDE_NUM_FACTURE"].'"');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'"'.$row["COMMANDE_PRESCRIPTEUR"].'"');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'"'.$row["CLIENT_NSS"].'"');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'"1"');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 
                 fwrite($handleTransent,'""');   
                 fwrite($handleTransent,"\t"); 
                 }
               }
                
                
                fclose($handleMedecin);
                fclose($handleOrgsecu);
                fclose($handleTransent);
                fclose($handleLigtele);
                fclose($handleOrgmutu);
                
                /*$handleMedecin  = fopen("../Export/medecin.txt", "r");
                $handleOrgsecu  = fopen("../Export/orgsecu.txt", "r");
                $handleTransent = fopen("../Export/transent.txt","r");
                $handleLigtele  = fopen("../Export/ligtele.txt", "r");
                $handleOrgmutu  = fopen("../Export/orgmutu.txt", "r");
                
                $contenuMedecin = fread($handleMedecin, filesize("../Export/medecin.txt"));
               $contenuOrgsecu = fread($handleOrgsecu, filesize("../Export/orgsecu.txt"));
               $contenuTransent = fread($handleTransent, filesize("../Export/transent.txt"));
               $contenuLigtele = fread($handleLigtele, filesize("../Export/ligtele.txt"));
               $contenuOrgmutu = fread($handleOrgmutu, filesize("../Export/orgmutu.txt")); 
                
                fclose($handleMedecin);
                fclose($handleOrgsecu);
                fclose($handleTransent);
                fclose($handleLigtele);
                fclose($handleOrgmutu);
               
               
                
                
                
                
                
                
                $zip = new zipfile();
                $zip->addfile($contenuMedecin, "medecin.txt");
                $zip->addfile($contenuOrgsecu, "orgsecu.txt");
                $zip->addfile($contenuTransent, "transent.txt");
                $zip->addfile($contenuLigtele, "ligtele.txt");
                $zip->addfile($contenuOrgmutu, "orgmutu.txt");
                $zip->finish();
                
                $archive = $zip->file();
                header('Content-Type: application/x-zip') ; //on détermine les en-tête
                header('Content-Disposition: inline; filename=archive.zip') ;*/

                
               
                echo "<fieldset class='div-fichiers'><legend>Les fichiers suivants ont bien &eacute;t&eacute; g&eacute;n&eacute;r&eacute;</legend>";
                echo "<br /><div class='link-client'><a href='../Export/Orgsecu.php'>orgsecu.txt</a></div>";
                echo "<div class='link-client'><a href='../Export/Orgmutu.php'>orgmutu.txt</a></div>";
                echo "<div class='link-client'><a href='../Export/Medecin.php'>medecin.txt</a></div>";
                echo "<div class='link-client'><a href='../Export/Transent.php'>transent.txt</a></div>";
                echo "<div class='link-client'><a href='../Export/Ligtele.php'>ligtele.txt</a></div><br />";
                echo "</fieldset>";
                
            }
            
            
            
            
            if(isset($_GET["message"]))
            {
               echo "<div class='msg'>".$_GET["message"]."</div>";

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
                 echo "<div class=dossier-client-ligne><div class=dossier-client-left>Type commande: </div><div class='link-client'>";
                 $typeRE = strpos($row["COMMANDE_NUM_FACTURE"], "RE");
                 $typeCH = strpos($row["COMMANDE_NUM_FACTURE"], "CH");
                 $typeSE = strpos($row["COMMANDE_NUM_FACTURE"], "SE");
                 if($typeRE > 0)
                 {
                    echo "R&eacute;paration";
                 }
                 else if($typeCH > 0)
                 {
                    echo "Chaussures";
                 }
                 else if($typeSE > 0)
                 {
                    echo "Semelle";
                 }
                 else
                 {
                    echo "Type inconnu";
                 }
                 echo "</div></div>";
                 echo "<div class=dossier-client-ligne><div class=dossier-client-left>Num.commande:</div><div class=dossier-client-right>".$row["COMMANDE_NUM_FACTURE"]."</div></div>";
                
                
                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Classe:</div><div class=dossier-client-right>".$row["CLIENT_CLASSE"]."</div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date d'accord:</div><div class=dossier-client-right><input disabled  name='date' type='text' value='".$row["COMMANDE_DATE_ACCORD"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Forme:</div><div class=dossier-client-right><input disabled  name='forme' type='text' value='".$row["CLIENT_NUMERO_FORME"]."' /></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Prescripteur:</div><div class=dossier-client-right><input disabled name='prescripteur' type='text' value='".$row["COMMANDE_PRESCRIPTEUR"]."' /></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Code prescripteur:</div><div class=dossier-client-right><input disabled name='prescripteurCode' type='text' value='".$row["COMMANDE_PRESCRIPTEUR_CODE"]."' /></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date prescription:</div><div class=dossier-client-right><input disabled  name='date' type='text' value='".$row["COMMANDE_DATE_PRESCRIPTION"]."'/></div></div>";
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
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Orth&eacute;se:</div><div class=dossier-client-right><input disabled  class='size' name='orthese' $checked0   type='checkbox' /> ".$row["COMMANDE_DATE_ORTHESE"]."</div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Patronage/Couper/Piquage:</div><div class=dossier-client-right><input disabled  class='size' name='piquage' $checked1  type='checkbox' /> ".$row["COMMANDE_DATE_PICAGE"]."</div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Montage:</div><div class=dossier-client-right><input disabled  class='size' name='montage' $checked2  type='checkbox' /> ".$row["COMMANDE_DATE_MONTAGE"]."</div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Finition:</div><div class=dossier-client-right><input disabled  class='size' name='finition' $checked3 type='checkbox' /> ".$row["COMMANDE_DATE_FINITION"]."</div></div>";
                
                
                
                $selected1 = "";
                $selected2 = "";
                $selected3 = "";
                $selected0 = "";           
                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Liste et Prix Total TTC: </div><div class='liste-produit'>";
                $refProduits = explode ("-",$row["COMMANDE_PRODUITS"]);
                $produitDesignation = "";
                $prix = 0;
                $i = 1;
                foreach($refProduits as $valeur)
                { 
                     if(strlen($valeur)>0)
                     {
                         $valsCalculateur = explode(".", $valeur);
                         
                         $nb = $valsCalculateur[0];
                         $produit = $valsCalculateur[1];
                         
                         if($produit!="" && $produit!="000000")
                         {
                             $queryProduit = "SELECT * FROM  PRODUIT  WHERE PRODUIT_CODE = '".$produit."'";
                             $resultProduit = mysql_query($queryProduit);
                             
                             while ($rowProduit = mysql_fetch_array($resultProduit)) 
                             {
                                $prix += ($nb * $rowProduit["PRODUIT_PRIX"]);
                                $produitDesignation = $produitDesignation .$i. "-" . $rowProduit["PRODUIT_DESIGNATION"]. ": ". $nb . " X " .$rowProduit["PRODUIT_PRIX"] ." &euro;<br>";
                                $i++;
                             }
                         }
                         else if ($produit == "000000" )
                         {
                            $designationSupp = $valsCalculateur[2];
                            $prixSupp = $valsCalculateur[3];
                            $prix += ($nb * $prixSupp);
                            $produitDesignation = $produitDesignation .$i. "-" . $designationSupp. ": ". $nb . " X " .$prixSupp ." &euro;<br>";
                            $i++;
                         }
                     }
                     
                }
                
                $query_update = "UPDATE COMMANDE SET COMMANDE_PRIX = ".$prix ." WHERE COMMANDE_NUM ='". $_GET["commandeNum"] ."'";
                mysql_query($query_update);
                
                echo $produitDesignation .$prix . " &euro;</div></div>";
                
                
                 if($row["COMMANDE_TICKET_MODERATEUR"]=="on")
                {
                    $checked = "checked";
                }
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Exon&eacute;ration du ticket mod&eacute;rateur:</div><div class=dossier-client-right><input disabled  class='size' name='ticketModerateur' $checked   type='checkbox' /></div></div>";                
                
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
              
              
              echo "<div class=dossier-client-ligne><div class=dossier-client-left>Position de la demande</div><div class=dossier-client-right><select disabled name='attribution'>"; 
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
                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date demande d'entente:</div><div class=dossier-client-right><input disabled  name='date' type='text' value='".$row["COMMANDE_DEMANDE_DETENTE"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date de facturation:</div><div class=dossier-client-right><input disabled  name='date' type='text' value='".$row["COMMANDE_FACTURATION"]."'/></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Date de r&eacute;glement:</div><div class=dossier-client-right><input disabled  name='date' type='text' value='".$row["COMMANDE_REGLEMENT"]."'/></div></div>";
                
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Statut de la commande</div><div class=dossier-client-right><select disabled name='statutCommande'>"; 
                echo "<option value='0' $selected0 >Choix...</option>";
                echo "<option value='1' $selected1 >Facture Cr&eacute;&eacute;e et non pay&eacute;e</option>";
                echo "<option value='2' $selected2 >Facture Cr&eacute;&eacute;e et pay&eacute;e</option>";
                echo "<option value='3' $selected3 >Commande annul&eacute;e</option>";
                echo "</select></div></div>";
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Commentaire pour facture:</div><div class=dossier-client-right><textarea disabled name='commentaireFacture' rows='2'>".$row["COMMANDE_COMMENATIRE_FACTURE"]."</textarea></div></div>";           
                echo "<div class=dossier-client-ligne><div class=dossier-client-left>Commentaire:</div><div class=dossier-client-right><textarea disabled name='commentaire' rows='5'>".$row["COMMANDE_COMMENATIRE"]."</textarea></div></div>";           
                
                echo '<input type="hidden" value="'.$row["CLIENT_ORGANISME"].'" name="oranismeClient" />';
                 
              
              }
              mysql_free_result($result);
            }    
         
             echo '</div>';
             echo '<div class="btn">';
              echo '<input type="hidden" value="ok" name="validation" />';
               
              
            echo '<input type="button" value="Modifier" onclick="window.location.href=\'../Dossier_Commande/?commandeNum=',$_GET["commandeNum"],'&clientNum=', $_GET["clientNum"] ,'\'"></input>';             
            echo '<input id="facture" type="button" value="Facture interne" onclick="window.open(\'../Facture1/?commandeNum='.$_GET["commandeNum"].'&clientNum='.$_GET["clientNum"].'\')"></input>';         
            echo '<input id="feuille" type="button" value="Feuille de soins" onclick="window.open(\'../Facture_Cerfa/?commandeNum='.$_GET["commandeNum"].'&clientNum='.$_GET["clientNum"].'\')"></input>'; 
            echo '<input id="entente" type="button" value="Demande d\'entente" onclick="window.open(\'../Entente_Cerfa/?commandeNum='.$_GET["commandeNum"].'&clientNum='.$_GET["clientNum"].'\')"></input>';
            echo '<input id="entente" type="submit" value="G&eacute;n&eacute;rer les fichiers"></input>';    
            
            echo '</div>';
           ?>
                <div id="calendar"></div>
        </form>

    </div>


</div>
<?php require_once("../Footer/Footer.php");?>