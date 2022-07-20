<?php
session_start();
var_dump($_POST);
require_once("./pdo.php");
$success = isset($_SESSION["success"])? $_SESSION["success"]: false;
$error =isset($_SESSION["error"])? $_SESSION["error"]: false;
$name= isset($_SESSION["name"])? $_SESSION["name"]: "";
$password= isset($_POST["password"])? $_POST["password"]: '';
$salt='XyZzy12\*\_';
$stored_hash = '218140990315bb39d948a523d61549b4';
echo hash("md5","php123");

if(isset($_POST['login'])) {
    if(!empty($_POST["name"]) && !empty($_POST["pass"])){
      $name= htmlspecialchars($_POST['name']);
      $password= htmlspecialchars($_POST['password']);
      $md5 = hash('md5', $_POST['pass']);
      
  
      if($md5 === $stored_hash) {
        $_SESSION["success"] = "Utilisateur connecté";
        $_SESSION["username"] = $name;
        header("Location: ./app.php" );
     
      } else{
        $_SESSION["error"] = "Le mot de passe est incorrect";
        header("Location: login.php");
        return;
      }
    } else{
      $_SESSION["error"] = "veuillez remplir tous les champs";
      header("Location: login.php");
      return;
    } 
    
    
    if (isset($_POST["autos"]) && isset($_POST["autos_id"])) {
      $sql = "INSERT INTO autos (autos_id, make, model, year, mileage) VALUE (:autos_id	:make	:model :year :mileage)";
    
      echo ("<pre>" . $sql . "</pre>");
    
      $stmt = $pdo->prepare($sql);
    
      $stmt->execute([
        ":autos_id" => $_SESSION["autos_id"],
        ":make" => $_SESSION["make"],
        ":model" => $_SESSION["model"],
        ":year" => $_SESSION["year"],
        ":mileage" => $_SESSION["mileage"]
      ]);
    }
    }





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connection</title>
    <link rel="stylesheet" href="./main.css">
    <link rel="stylesheet" href="normalize.css">
</head>
<body>
<div class="Container">
    <h1> Se connecter </h1>

    <p style="color:red">
        <?php
        if(isset($error)) { 
        echo $error;
        unset($_SESSION["error"]);
        }  
        ?>

    <form method="POST" action="./login.php">
    <div>
    <label for="name"> Nom d'utilisateur </label>
    <input type="texte" name="name" id="name">
    </div>
    <div>
    <label for="pass"> mot de passe </label>
    <input type="password" name="pass" id="pass">
<br>
    <button type="submit" name="login"> se connecter </button>
    <a href="./index.php">Annuler
</body>
</html>

 