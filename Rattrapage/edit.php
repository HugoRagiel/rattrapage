<?php
session_start();
require_once("./pdo.php");

$sql = $pdo->query("SELECT * FROM autos WHERE autos_id = '". $_GET["autos_id"] ."'");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);


  if(isset($_POST["edit"])){

     $sql = $pdo->query("UPDATE autos SET make = '".$_POST["make"]."', model = '".$_POST["model"]."', year = '".$_POST["year"]."', mileage = '".$_POST["mileage"]."' WHERE autos_id = '".$_GET["autos_id"]."'");

  $_SESSION["success"] = "Enregistrement correctement modifié";
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
    <h1>Modifier une automobile</h1>
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
        <input type="text" name="make" id="make" value="<?=$data["make"];?>">
      </div>
      <div>
        <label for="model">Modèle :</label>
        <input type="text" name="model" id="model" value="<?=$data["model"];?>">
      </div>
      <div>
        <label for="year">Année :</label>
        <input type="text" name="year" id="year"  value="<?=$data["year"];?>">
      </div>
      <div>
        <label for="mileage">Kilométrage :</label>
        <input type="text" name="mileage" id="mileage" value="<?=$data["mileage"];?>">
      </div>
      <button type="submit" name="edit">Sauvegarder</button>

      <a href="app.php">Annuler </a>
    </form>
  </div>
    </body>