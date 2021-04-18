<?php require_once("../Test_Authentification/Test_Authentification.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Etablissement Jean Labb&eacute; Orthop&eacute;die</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="Content-Language" content="fr" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="DC.Language" scheme="RFC3066" content="fr" />
     <link rel="stylesheet" type="text/css" href='http://www.frlconseil.com/Cabinet_Medical/Styles/demande4.css' />
    
</head>
<body>
    <div id="page">
        <?php require_once("../Connexion/Connexion.php");?>
        <h3>
            Podo Orth&eacute;siste</h3>
        <table class="entete">
            <tr>
                <td class="left">
                    <img src="../Images/interface/logo.GIF" />
                </td>
                <td class="right">
                    <div class="titre">
                        Etablissement Jean Labb&eacute; Orthop&eacute;die</div>
                    <div class="description">
                        Fabricant sur mesure, qualit&eacute;, confort et &eacute;l&eacute;gance Sp&eacute;cialiste des semelles orthop&eacute;diques,
                        chaussures orthop&eacute;diques chaussures th&eacute;rapeutiques anti-varus et anti-valgus
                    </div>
                </td>
            </tr>
        </table>
        <div id="date">           
           <?php
            $today = getdate();
            echo "Versailles le : ".$today["mday"]."/".$today["mon"]."/".$today["year"];
           ?>
        </div>
        
<div id=civilite>
Mme / Mr <? echo $_GET["clientNom"] ?>
</div>

<div id=para1>
Suite à la r&eacute;ception du bon d'appareillage N&deg;.... &eacute;manant du MINISTERE DES<br>
ANCIENS COMBATTANTS  et vous concernant,
</div>

<div id=para2>
Je vous prie de bien vouloir prendre rendre-vous avec mon &eacute;tablissement en vue de la prise de vos
mesure pour la confection de vos chaussures orthop&eacute;diques.
</div>


<div id=para3>
Veuillez croire, Mme / Mr <? echo $_GET["clientNom"] ?> en l'expression de mes respectueuses salutations.
</div>

<div id=signature>
Mme Ouiame Alaoui
</div>

<div class="bas-page">
2 Bis Rue Saint Honor&eacute; 78000 Versailles <br>
Tel/Fax : 01 39 50 18 53<br>
Mobile : 06 17 18 25 43<br>
Podo Orth&eacute;siste agr&eacute;&eacute; : n&deg;  78 CH 582 C et n&deg; 78 2 60582 8
</div>

</body>
</html>
