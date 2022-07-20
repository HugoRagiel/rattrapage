<?php
session_start();
$success = isset($_SESSION["success"])? $_SESSION["success"]: false;
$error =isset($_SESSION["error"])? $_SESSION["error"]: false;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>
  <div class="accueil">
    <h1>Bienvenue sur la base de données Automobiles
</h1>
    <?php

    
    
    // if(isset($_SESSION["success"])) {
    //   echo "<p style='color:green'>{$_SESSION["success"]}
    //   </p>";
    //   unset($_SESSION["success"]);
    //   $_SESSION["connexion"] = 'ulilisateur connecté';
    // }

    if(isset($_SESSION["success"])) {
      require("app.php");
      echo "<p style='color:green'>{$_SESSION["success"]}
      </p>";
      unset($_SESSION["success"]);
      $_SESSION["connexion"] = 'Enregistrement correctement ajouté';
    }
    ?>

    <a href="./login.php">Connectez-vous</a>  
    <p>Essayer d'<a href="./app.php">ajouter des données</a> sans se connecter.</p>
  </div>
</body>
</html>