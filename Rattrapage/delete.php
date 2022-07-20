<?php
session_start();
require_once("./pdo.php");
$success = isset($_SESSION["success"])? $_SESSION["success"]: false;
$error =isset($_SESSION["error"])? $_SESSION["error"]: false;

$sql = $pdo->query("SELECT * FROM autos WHERE autos_id = '". $_GET["autos_id"] ."'");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);
$auto = ($data["make"]);

  if(isset($_POST["delete"])){
     $sql = $pdo->query("DELETE FROM autos WHERE autos_id = '" . $_GET["autos_id"] ."'");

  $_SESSION["success"] = "Enregistrement correctement supprimée";
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
    <p>Confirmer la suppresion de : <?=$auto;?></p>
        <form method="POST">
      <button type="submit" name="delete">Supprimer</button>
      <a href="app.php">Annuler </a>
    </form>
  </div>
    </body>