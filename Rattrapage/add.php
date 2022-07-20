<?php
session_start();
require_once("./pdo.php");
$success = isset($_SESSION["success"])? $_SESSION["success"]: false;
$error =isset($_SESSION["error"])? $_SESSION["error"]: false;

 if(isset($_SESSION["error"])) {
    echo "<p style='color:red'>{$_SESSION["error"]}</p>";
    unset($_SESSION["error"]);
  }

  if(isset($_POST["add"])){
    //if(!empty($_POST["autos"])){
     $sql = $pdo->query("INSERT INTO autos(make, model, year, mileage) VALUES('". $_POST["make"] ."', '".  $_POST["model"] ."', '".  $_POST["year"] ."', '".  $_POST["mileage"] ."')");
     //$sql->execute();

  $_SESSION["success"] = "Enregistrement correctement ajouté";
   header("Location: app.php");
  return;

    }
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
    <div class="container">
    <h1>Ajouter une automobile pour <?=$_SESSION["username"];?></h1>
    <?php
    if(isset($_SESSION["success"])) {
        echo "<p style='color:green'>{$_SESSION["success"]}</p>";
        unset($_SESSION["success"]);
      }

      if(isset($_SESSION["error"])){
        echo "<p style='color:blue'>{$_SESSION["error"]}</p>";
        
      }
?>
        <form method="POST">
      <div>
        <label for="make">Marque :</label>
        <input type="text" name="make" id="make" required="required">
      </div>
      <div>
        <label for="model">Modèle :</label>
        <input type="text" name="model" id="model" required="required">
      </div>
      <div>
        <label for="year">Année :</label>
        <input type="text" name="year" id="year" required="required">
      </div>
      <div>
        <label for="mileage">Kilométrage :</label>
        <input type="text" name="mileage" id="mileage" required="required">
      </div>
      <button type="submit" name="add">Ajouter</button>

      <a href="app.php">Annuler </a>
    </form>
  </div>
    </body>