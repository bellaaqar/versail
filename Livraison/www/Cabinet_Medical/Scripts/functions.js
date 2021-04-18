var select = 0;
var temp;

// colore la ligne en transparent
function transp(ligne)
{
    if (ligne.style.background!='red') ligne.style.background='transparent';
}

// colore la ligne en lavande
function lavend(ligne)
{
    if (ligne.style.background!='red') ligne.style.background='lavender';
}

// colore la ligne en transparent si elle est rouge
// remet en transparent la ligne selectionnée precedement et colore celle si en rouge si differente
// indique qu'une ligne est selectionnée en mettant le parametre select a 1
function selec(ligne)
{
    if (!select)
    { 
        select = 1;
        ligne.style.background="#BD8CBF";
        temp = ligne;
    }
    else
    {
        if (ligne.style.background=="#BD8CBF")
        { 
            select = 0;
            ligne.style.background='transparent';
        }
        else
        { 
            temp.style.background='transparent';
            ligne.style.background="#BD8CBF";
            temp=ligne;
        }
    }

}

function show(id,positionLeft)
{
    document.getElementById(id).style.display="block";
    document.getElementById(id).style.left=positionLeft + "px";
    
}
function showUl(id)
{
document.getElementById(id).style.display="block";
}
function hide(id)
{
    document.getElementById(id).style.display="none";
}



function openDemande(urlDemande)
{
        if(urlDemande != '')
        {
            window.open(urlDemande);
        }
}

function ShowProduit()
{
    document.getElementById("produit").style.display = "";
}

function HideProduit()
{
    document.getElementById("produit").style.display = "none";
}

function AddProduit(refProduit,nb,idSuppDesi,idSuppPrix)
{
    
    
  
    var listeCommandes = document.getElementById("listeCommandes");
    
    if(nb != "0")
    {    
        if(listeCommandes.value == "")
        {
            
            //produit en base
           if(refProduit != "000000")
           {
                listeCommandes.value = nb + "." + refProduit;           
           }
           //supplement
           else
           {
                var designation = "";
                var prix        = "";
                if(idSuppDesi !="" )
                {
                    designation = document.getElementById(idSuppDesi).value;
                    if(idSuppPrix !="")
                    {
                        
                        prix        = document.getElementById(idSuppPrix).value;
                        listeCommandes.value = nb + "." + refProduit  + ".";
                        listeCommandes.value += designation + "." + prix;
                    }
                }
           }
          
            
        }
        else
        {
            var positionRefProduit = listeCommandes.value.indexOf(refProduit,0);
            if(positionRefProduit == -1)
            {
                   //ajouter normalement
                   
                    //produit en base
                   if(refProduit != "000000")
                   {
                        listeCommandes.value += "-" + nb + "." + refProduit;           
                   }
                   //supplement
                   else
                   {
                        var designation = "";
                        var prix        = "";
                        if(idSuppDesi !="" )
                        {
                            designation = document.getElementById(idSuppDesi).value;
                            if(idSuppPrix !="")
                            {
                                prix        = document.getElementById(idSuppPrix).value;
                                listeCommandes.value += "-" + nb + "." + refProduit + ".";
                                listeCommandes.value += designation + "." + prix;
                            }
                        }
                   }
            }
            else
            {
                //remplacer le nombre choisi du produit
                var reg = new RegExp("(-)+", "g");
                var tableau = listeCommandes.value.split(reg);
                for (var i=0; i<tableau.length; i++) 
                {
                    var pos = tableau[i].indexOf(refProduit,0);
                    if(pos > 0)
                    {
                        var expression = "("+tableau[i]+")"
                        var reg=new RegExp(expression, "g");
                        
                        if(refProduit != "000000")
                        {
                            listeCommandes.value = listeCommandes.value.replace(reg,nb + "." + refProduit);     
                        }
                        //supplement
                         else
                         {
                                var designation = "";
                                var prix        = "";
                                if(idSuppDesi !="" )
                                {
                                    designation = document.getElementById(idSuppDesi).value;
                                    if(idSuppPrix !="")
                                    {
                                        prix        = document.getElementById(idSuppPrix).value;
                                        listeCommandes.value = listeCommandes.value.replace(reg,nb + "." + refProduit+ "." + designation + "." + prix);
                                        
                                    }
                                }
                         }

                    }
                }
            }
        }
        
    }
    else
    {
        //retirer le produit choisi
        var reg = new RegExp("(-)+", "g");
        var tableau = listeCommandes.value.split(reg);
        for (var i=0; i<tableau.length; i++) 
        {
            var pos = tableau[i].indexOf(refProduit,0);
            if(pos > 0)
            {
                var expression = "("+tableau[i]+")"
                var reg=new RegExp(expression, "g");
                listeCommandes.value = listeCommandes.value.replace(reg,"");

            }
        }
    }
}

function  showByTypeProduit(id) 
{
    if(id == "RE")
    {
        document.getElementById("RE").className = "";
        document.getElementById("SE").className = "hide";
        document.getElementById("CH").className = "hide";
    }
    else if(id == "CH")
    {
        document.getElementById("RE").className = "hide";
        document.getElementById("SE").className = "hide";
        document.getElementById("CH").className = "";
    }
     else if(id == "SE")
    {
        document.getElementById("RE").className = "hide";
        document.getElementById("SE").className = "";
        document.getElementById("CH").className = "hide";
    }
    document.getElementById("listeCommandes").value = "";
    
}