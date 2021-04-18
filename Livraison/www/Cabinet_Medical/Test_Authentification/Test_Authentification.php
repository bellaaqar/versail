 <?php
      
      session_start();
      if(!isset($_SESSION['connexionUtilisateur'])) 
      {
        header("Location: ../Authentification/");
      }
     
?>