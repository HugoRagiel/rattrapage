# Application CRUD automobile

## spécifiactions générales

Voici quelques spécifications pour ce projet :

- Toutes les données doivent être proprement échappés en utilisant la fonction PHP htmlentities(). Vous n'avez pasbesoind'échapper le texte généré par votre programme

- Vous devez suivre le pattern POST-Redirect-GET pour toutes les requ$etes POST. Il faut utiliser la fonction `header("Location: ...)` et `return;`

- N'utilisez pas la validation de données de HTML5 (ex: type=number) pour les champs dans ce projet car on veut vérifier que vous pouvez valider proprement les données côté serveur. Et en général, même si vous validé lesdonnées c^oté client, vous devez quand même valider les données côté serveur dnas le cas où l'utilsiateur n'utilise pas un nvaigateur avec HTML5

## Démo

https://dwwm-crud-autos.herokuapp.com/

## Créer la BDD

```
CREATE DATABASE automobile_db;
use automobile_db;
```

## Créer la table autos

```
CREATE TABLE autos (
autos_id INTEGER NOT NULL KEY AUTO_INCREMENT,
make VARCHAR(255),
model VARCHAR(255),
year INTEGER,
mileage INTEGER
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

## Protéger les pages add.php et edit.php

Pour empêcher la base de données d'être modifiée sans que l'utilisateur ne soit connecté, il faut d'abord vérifier la session dans add.php et edit.php pour voir si le nom de l'utilisateur est défini et s'il ne l'est pas, les pages arrêtent immédiatement leurs exécution en utilisant la fonction PHP die() :

```
die("ACCESS DENIED");
```

Pour tester, naviguer sur la page add.php sans se connecter - cela devrait échouer avec le message "ACCÈS REFUSÉ".

## Connexion

Si l'utilisateur n'est pas connecté, il luisera présenté un message de bienvenue et un lien vers login.php pour se connecter - il ne devra pas voir le tableau de données.

L'écran de connexion doit avoir des vérifications d'erreur dans les données des champs. Si le nom et le mot de passe sont vides, vous devez afficher le message :

```
Le nom d'utilsiateur et le mot de passe sont requis
```

Si le mot de passe est non-vide et incorrect, vous devez afficher le message :

```
Le mot de passe est incorrect
```

## Liste des automibles de la base de données

Une fois l'utlisateur connecté, vous devez le rediriger vers index.php où il verra une liste des automobiles dans la BDD dans un tableau.

S'il n'y a pas de lignes dans la table, n'afficher pas le tableau mais simplement afficher "Pas de ligne trouvées".

Si le lien de déconnexion est pressé l'utilisateur est envoyé vers la page logout.php qui nettoie les variables de session et le redirige vers la page index.php.

## Ajouter un enregistrement

Lorsque l'utilisateur clique sur ajouter un nouvel enregistrement, il lui sera présenté un écran qui lui permet d'ajouter une nouvelle automobile. Chauqe automobile aura les champs suivants :

- mark
- model
- year - doit être un nombre - utiliser is_numeric()
- mileage - doit être un nombre - utiliser is_numeric()

Lors du traitement des requêtes POST, les données doivent être validées. Tous les champs sont requis, s'il manque des champs (ex: vide), afficher le message :

```
Tous les champs sont requis
```

Si l'utilsiateur entre un champs non-numérique, afficher le message :

```
L'année doit être un nombre
```

Si il y a des erreurs dans un champs, n'ajouter pas l'enregistrement à la BDD. Rediregier l'utliser vers add.php et afficher le message flash d'erreur.

```
 if ( ... au moins un champs vide ... ) {
        $_SESSION['error'] = "Tous les champs sont requis";
        header("Location: add.php");
        return;
    }

...

    if ( isset($_SESSION['error']) ) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
```

Si les données sont valides et l'ajout réussi, rediriger vers index.php avec un message flash :

```
Enregistrement ajouté
```

## Édition des enregistrements et validation d'erreurs

Losque vous éditez un enregistrement, les données doivent être affichés et proprement échappés. Toutes les donnéesdoivent être validés comme dans add.php. Assurez-vous d'inclure le paramètre "id" dans la redirection sur edit.php lorsqu'une erreur est détectée :

```
 if ( ... a field is missing ... ) {
        $_SESSION['error'] = "All fields are required";
        header("Location: edit.php?autos_id=".$_REQUEST['id']);
        return;
    }
```

Si les données sont valideset l'édition réussie, rediriger vers index.php avec un message flash :

```
Enregistrement édité
```

## Suppression des enregistrements

Lorsque l'utilisateur sélectionne le lien "Supprimer" dans la liste des automobiles vousdevez lui afficher un formulaire avec les options "Supprimer" et "annuler"

Si le bouton "Supprimer" est pressé, l'enregistrement est supprimé et l'utilisateur est redirigé vers index.php avec un message de succès :

```
Enregistrement supprimé
```
