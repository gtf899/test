<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Formulaire</title>
  <style>
    /* Ajoutez votre CSS ici */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    h1 {
      color: #333;
    }

    /* Style pour les boutons */
    button {
      padding: 10px 15px;
      background-color: #007bff;
      color: #fff;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    button:hover {
      background-color: #0056b3;
    }

    /* Style pour les champs de formulaire */
    input[type="text"],
    select {
      padding: 8px;
      border-radius: 3px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #28a745;
    }

    input[type="submit"]:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <!-- Votre contenu HTML ici -->
</body>
</html>

<?php

// Souvent on identifie cet objet par la variable $conn ou $db
require "config.php";

$recipesStatement = $db->prepare('SELECT * FROM users');

$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Formulaire</title>
</head>
<body>
  
      
  <h1>inscription</h1>
  <form method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br><br>
    
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required><br><br>

    <label for="mot_de_passe">mot de passe :</label>
    <input type="text" id="mot_de_passe" name="mot_de_passe" required><br><br>

    <label>Sélectionnez votre :</label>
    <select name="choix" id="choix">
      <option value="3 Newton">3-Newton</option>
      <option value="3 Kraf">3-Kraft</option>
    </select>

    <?php
     echo "<br>";
     echo "<br>";
     ?>

  

    <input type="submit" name="ajouter">
  </form>

  <div id="infosFormulaire"></div>


  <?php
      echo "<br>";
 
if (isset($_POST['bouton'])) {
    header('Location: connection.php');
    exit();
}
?>

<?php if (!isset($_POST['bouton'])): ?>
    <form method="post">
        <input type="submit" name="bouton" value="S'identifier">
    </form>
<?php endif; ?>


  <?php

  //foreach($recipes as $recipe){
  //  echo "<br>";
  //  echo $recipe['nom']." ".$recipe['prenom']." ".$recipe['mot_de_passe']." ".$recipe['classe'];
  //  echo "<a href='http://localhost/test/index.php?id=".$recipe['id']."'>
   //         <button>Supprimer</button>
  //        </a>";
  // }

  function ajouterUser($db){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $classe = $_POST['choix'];
  

    $req = "INSERT INTO `users`(`id`, `nom`, `prenom`, `mot_de_passe`, `classe`) VALUES (NULL,'$nom','$prenom','$mot_de_passe','$classe')";
    try
    {
        $result = $db->query($req);
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    header("Refresh:0.2");
  }

  function deleteUser($db,$id){
    $req = "DELETE FROM `users` WHERE id=".$id;
    try
    {
        $result = $db->query($req);
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
  }

  if(isset($_POST["ajouter"])){
        ajouterUser($db);
  }

 // if(isset($_GET['id'])){
  //  deleteUser($db,$_GET['id']);
  //}

  ?>

</body>
</html>
