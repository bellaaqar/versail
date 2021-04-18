<?php
echo '<div id="menu_gauche">';
echo '<div style=display:inline>';
echo '<a  href="javascript:" onmouseover=show("M1",this.offsetLeft) onmouseout=hide("M1")>Gestion clients</a>';
echo '<ul id="M1" style="display:none" onmouseover=showUl("M1") onmouseout=hide("M1")>';
echo '<li>';
echo '<a href="../Consultation_Client/">Consultation</a>';
echo '</li>';
echo '<li>';
echo '<a href="../Ajout_Client/">Ajout client</a>';
echo '</li>';
echo '<li>';
echo '<a href="../Recherche_Client/">Recherche client</a>';
echo '</li>';
echo '<li>';
echo '<a href="../Recherche_Commande/">Recherche Commande</a>';
echo '</li>';
echo '</ul>';
echo "</div>";
echo '|';
echo '<div style=display:inline>';
echo '<a href="javascript:" onmouseover=show("M2",this.offsetLeft) onmouseout=hide("M2")>Gestion organismes</a>';
echo '<ul id="M2" style="display:none" onmouseover=showUl("M2") onmouseout=hide("M2")>';
echo '<li>';
echo '<a href="../Consultation_Organisme/">Consultation</a>';
echo '</li>';
echo '<li>';
echo '<a href="../Ajout_Organisme/">Ajout organisme</a>';
echo '</li>';
echo '</ul>';
echo "</div>";
echo '|';
echo '<div style=display:inline>';
echo '<a href="javascript:" onmouseover=show("M4",this.offsetLeft) onmouseout=hide("M4")>Gestion statistiques</a>';
echo '<ul id="M4" style="display:none" onmouseover=showUl("M4") onmouseout=hide("M4")>';
echo '<li>';
echo '<a href="../Statistiques/">Statistiques g&eacute;n&eacute;rales</a>';
echo '</li>';
echo '<li>';
echo "<a href='../Statistiques_entente/'>Statistiques demandes d'ententes</a>";
echo '</li>';
echo '<li>';
echo "<a href='../Statistiques_accord/'>Statistiques accords re&ccedil;us</a>";
echo '</li>';
echo '<li>';
echo "<a href='../Statistiques_facturee/'>Statistiques commandes factur&eacute;es</a>";
echo '</li>';
echo '<li>';
echo "<a href='../Statistiques_reglee/'>Statistiques commandes r&eacute;gl&eacute;es</a>";
echo '</li>';
//echo '<li>';
//echo '<a href="../Statistiques_Commande/">Statistiques sur les commandes</a>';
//echo '</li>';
echo '</ul>';
echo "</div>";




 if( $_SESSION['Utilisateur'] == "Admin")
 {
echo '|';
echo '<div style=display:inline>';
echo '<a href="javascript:" onmouseover=show("M3",this.offsetLeft) onmouseout=hide("M3")>Gestion application</a>';
echo '<ul id="M3" style="display:none" onmouseover=showUl("M3") onmouseout=hide("M3")>';
echo '<li>';
echo '<a href="../Ajout_Utilisateur/">Cr&eacute;er utilisateur</a>';
echo '</li>';        
echo '</ul>';
echo "</div>";
}
echo '</div>';
?>


