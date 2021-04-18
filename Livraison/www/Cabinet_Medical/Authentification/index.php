<?php require_once("../Header/Header.php");?>
<?php require_once("../Connexion/Connexion.php");?>

<div id="barre">
</div>
    <form method="post">
<div id="AUTH">
  <?php
  
   if(isset($_POST["submit"]) )
   {
      $page = false;
      $query = "SELECT * FROM UTILISATEUR WHERE UTILISATEUR_LOGIN= '".$_POST["login"]."' AND UTILISATEUR_PWD='".$_POST["pwd"]."'";
      $result = mysql_query("$query");
      while ($row = mysql_fetch_array($result)) 
      {        
        $page = true;        
      } 
      mysql_free_result($result);      
      if($page)
      {
        session_start() ;
        $_SESSION['connexionUtilisateur'] = "ok";
        $_SESSION['Utilisateur'] = $_POST["login"];
        header("Location: ../Accueil/");
      }
      else
      {
        echo "<div class='msg'>Erreur d'authentification</div>";
      }
      
  }
  else if(isset($_GET["out"]) && $_GET["out"]=="1")
  {
    session_start() ;
    session_destroy();
  }
  ?>
<div class="titre-authentification">
Authentification requise
</div>
  <div>
    <table class="table-authentification">
      <tr>
        <td>Login</td>
        <td>
          <input name="login" type="text"></input>
        </td>
      </tr>
      <tr>
        <td>Mot de passe</td>
        <td>
          <input name="pwd" type="password"></input>
        </td> 
      </tr>
    </table>
    <div class="btn">
      <input type="submit" name="submit" value="Valider"></input>
    </div>
  </div>

</div>
</form>

<?php require_once("../Footer/Footer.php");?>