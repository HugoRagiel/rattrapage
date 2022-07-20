<?php
session_start();
require_once("./pdo.php");

$success = isset($_SESSION["success"])? $_SESSION["success"]: false;
$error =isset($_SESSION["error"])? $_SESSION["error"]: false;


if(!isset($_SESSION["username"]))
{
die("ACCES REFUSE");
}

if(isset($_POST["cancel"])){
    header("Location: ./index.php");
    return;
}

if (isset($_POST['add']) == ""){
  $error= "Veuillez ajouter un model";
  }
  else{
    $success = "tâche enregistré";
  }
            
          if(isset($_SESSION["success"])) {
            echo "<p style='color:green'>{$_SESSION["success"]}</p>";
            unset($_SESSION["success"]);
          }

          $sql = $pdo->query("SELECT * FROM autos");
           $sql->execute();
           $data = $sql->fetchAll(PDO::FETCH_ASSOC);
          if (sizeof($data) > 0)
          {
            echo "Marque Modèle Année Kilométrage Action <br>";
             for($i = 0; $i < sizeof($data); $i++) {
                  echo $data[$i]['make'].' -- '.$data[$i]['model'].' -- '.$data[$i]['year'].' -- '.$data[$i]['mileage']. '<a href="edit.php?autos_id='.$data[$i]['autos_id'].'">Editer</a> <a href="delete.php?autos_id='.$data[$i]['autos_id'].'">Supprimer</a> <br>';  
              }
          }
          else
          {
              echo 'Il n\'y a pas de résultat....';
          }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>

    <div class="container">
    <?php
    
    if(isset($_SESSION["success"])) {
            echo "<p style='color:green'>{$_SESSION["success"]}</p>";
            unset($_SESSION["success"]);
          }

    if(isset($_POST["deconnexion"])) {
      session_destroy();
      header("Location: index.php");
    }
?>
    <a href="add.php">Ajouter Une Nouvelle Entrée</a>
    </div>
    <form method="POST" action="./">
        <button type="submit", name="deconnexion">Se déconnecter</button>
    </form>
         </div>
        </div>
</head>
<body>
</body>
</html>