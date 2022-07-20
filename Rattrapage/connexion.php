<?php
session_start();
require_once("./pdo.php");
$success = isset($_SESSION["success"])? $_SESSION["success"]: false;
$error =isset($_SESSION["error"])? $_SESSION["error"]: false;

$name= isset($_SESSION["name"])? $_SESSION["name"]: "";
$password= isset($_POST["password"])? $_POST["password"]: '';

$salt='XyZzy12\*\_';
$stored_hash = '0bb8d33dcfde0b15dd1e64a1923106a7f521468a44ca7893f9a0c3a2137fab7a';


if (isset($_POST["submit"])){
  if(!empty($_POST['name']) && !empty($_POST['password'])){
    $md5 = hash('sha256', $_POST['password']);

    if($md5 === $stored_hash) {
      $_SESSION["success"] = "Utilisateur connecté";
      $_SESSION["connexion"] = 'ulilisateur connecté';
      header("Location: ./app.php?name=" . urlencode($_POST["name"]));
      // $_SESSION["success"] = "Connecté.";
    }
    else {
      $_SESSION['error']= "votre mot de passe est incorrect";
      header("location: ./connection.php");
      return;
    } 
//    else {
//    $_SESSION['error']= "veuillez remplir tout les champs";
//    header("Location: connection.php");
//    return;
//   }
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
     <form method="POST" class="form">

      <?php 
      if (isset($_SESSION['error'] )) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
      }
      ?>
      
  <div class="form-row">
    <label for="name">Enter your user name: <br></label>
    <input type="text" name="name" id="name" >
  </div>
  <div class="form-row">
    <label for="password">Enter your mdp: <br></label>
    <input type="password" name="password" id="password">
  </div>
  <div class="btn btn-block">
    <input type="submit" name = "submit">
  </div>
   <div>
    <a href="./index.php">annuler</a>
  </div>
</form>
</body>
</html>