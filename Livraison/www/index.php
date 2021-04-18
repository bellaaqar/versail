<?php

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">';
 echo ' <head>';
  echo '  <title>Etablissement Jean Labb&eacute; Orthop&eacute;die</title>';
  echo '  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />';
  echo '  <meta http-equiv="Content-Language" content="fr" />';
  echo '  <meta http-equiv="Content-Script-Type" content="text/javascript" />';
  echo '  <meta http-equiv="Content-Style-Type" content="text/css" />';
  echo '  <meta name="DC.Language" scheme="RFC3066" content="fr" />';
 
echo '  <script language="JavaScript" src="./Cabinet_Medical/Scripts/functionsPublic.js"></script>';
  echo '  <link rel="stylesheet" href="./Cabinet_Medical/Styles/style_public.css" type="text/css" media="screen" title="Normal" />';
 echo ' </head>';
 echo ' <body>';
  echo '<form method="post">';
  
   if(isset($_POST["validation"]) && $_POST["validation"] == "ok")
   {
         $headers ='Content-Type: text/html; charset="iso-8859-1"'."\n";
         $headers .='Content-Transfer-Encoding: 8bit'; 
         
         $message = "<html><body>Nom : ".$_POST["nom"]."<br/>";
         $message .= "T&eacute;l&eacute;phone : ".$_POST["tel"]."<br/>";
         $message .= "E-mail : ".$_POST["email"]."<br/>";
         $message .= "Commentaire : ".$_POST["commentaire"]."</body></html>";
         //mail('jean.labbe.podo@gmail.com',  'Contact site',  $message,$headers); 
         //mail('radouanelamnaour@hotmail.com',  'Contact site',  $message,$headers); 
         mail('k.oumari@gmail.com',  'Contact site',  $message,$headers); 
         echo '<script type="text/javascript">alert("Votre message est transmis");</script>';
   }
  
 echo '   <div id="page">';
  echo '    <div id="header">';
  echo '    <div class="intranet"> <a href="./Cabinet_Medical/Authentification/" > <img border="0" title="Acc&eacute;s intranet" src="./Cabinet_Medical/Images/interface/cadenat.gif"/></a></div>';
    echo '    <div class="logo"> <a href="javascript:" onclick=showImage("","hide","hide","hide","acceuil")><span class="titre2">Podo-Orth&eacute;siste</span> </a></div>';
   
  
 
   echo '    <span class="titre2"></span>';
   echo '     <span class="titre1">Ets Jean Labb&eacute;<span class="sous-titre">Fabricant sur mesure depuis 1950</span> </span>';
   
 
   echo '   </div>';
    


echo "<div id=\"contenu\">";

echo '<div id="menu_gauche">';
//echo '<marquee id="FlashInfoScroll" loop="infinite" behavior="scroll">Qualit&eacute; - Confort - Elegance </marquee>';
echo '</div>';

 echo "<div id=\"bloc\">";?>

<div id="module" class="">
    <div id="acceuil" class="acceuil">
        <table class="table-class">
            <tr>
                <td class="table-text">
                    Chaussures orthop&eacute;diques
                </td>
                <td></td>
                <td >
                    <img src="./Cabinet_Medical/Images/interface/ch.jpeg"></img></td>


            </tr>
            <tr>
               
                <td>
                    <img src="./Cabinet_Medical/Images/interface/se.jpeg"></img>
                </td>
                <td></td>
                <td class="table-text">Semelles orthop&eacute;diques</td>
                

            </tr>
            <tr>
                <td class="table-text">
                    Chaussures de luxe
                </td>
                <td></td>
                <td >
                    <img  width="136" height="89" src="./Cabinet_Medical/Images/interface/Chaussures _deluxe.jpg"></img></td>


            </tr>
        </table>
    </div>
    <div id="centrale" class="hide">
        Fabricant sur mesure depuis 1950
        Qualit&eacute;,confort et &eacute;l&eacute;gance
        Chaussures-semelles orthop&eacute;diques
    </div>
    <div id="grosContact" class="hide">
        <div class="titre-contact">
            Nous contacter...
        </div>
        <div class="formulaire-contact">
            <table id="tableForm">
                <tr>
                    <td>Nom</td>
                    <td> : </td>
                    <td>
                        <input name="nom" type="text" ></input>
                    </td>
                </tr>
                <tr>
                    <td>T&eacute;l&eacute;phone</td>
                    <td> : </td>
                    <td>
                        <input name="tel" type="text" ></input>
                    </td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td> : </td>
                    <td>
                        <input name="email" type="text" ></input>
                    </td>
                </tr>
                <tr>
                    <td>Commentaire</td>
                    <td> : </td>
                    <td>
                        <textarea name='commentaire' rows='5'></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="submit" value="Envoyer" ></input>
                    </td>
                </tr>
            </table>
            
        </div>
    </div>
    <div id="chaussures" class="hide">
        <img src="./Cabinet_Medical/Images/interface/chaussures/images.jpeg"></img>        
        <img src="./Cabinet_Medical/Images/interface/chaussures/images2.jpeg"></img>
        <img src="./Cabinet_Medical/Images/interface/chaussures/images3.jpeg"></img>
        <img src="./Cabinet_Medical/Images/interface/chaussures/images4.jpeg"></img>
        <img src="./Cabinet_Medical/Images/interface/chaussures/images5.jpeg"></img>
        <img src="./Cabinet_Medical/Images/interface/chaussures/images6.jpeg"></img>
        <img src="./Cabinet_Medical/Images/interface/chaussures/images7.jpeg"></img>
    </div>

    
   
</div>



<div id="menu">
    <a href="javascript:" onclick="showImage('','hide','hide','hide','acceuil')">Accueil</a>
    <a href="javascript:" onclick="showImage('','hide','hide','imageCatalogue','hide')">Catalogue</a>
    <a href="javascript:" onclick="showImage('imageBoutique','hide','hide','hide','hide')">La boutique</a>
    <a href="javascript:" onclick="showImage('','imagePropos','hide','hide','hide')">A propos</a>
    <a href="javascript:" onclick="showImage('imageAcces','hide','hide','hide','hide')">Plan d'acc&egrave;s</a>
    <a href="javascript:" onclick="showImage('','hide','formulaireContact','hide','hide')">Contact</a>

</div>


<input type="hidden" name="validation" value="ok" ></input>


<?php
   







    echo "
</div>";

     
      echo "</div>";
echo'<div id="footer">';
 echo "<div id=contact>
        ";




echo 'Jean LABBE ';
echo 'PODO-ORTHESISTE ';
echo '2 bis, rue Saint-Honor&eacute; ';

echo '78000 VERSAILLES ';
echo 'Tel.:01.39.50.18.53/';
echo '06.17.18.25.43.';

echo "</div>";
echo'</div>';
echo'</div>';
echo'</form>';
echo '</body>';
echo '</html>';

?>