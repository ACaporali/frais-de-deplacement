<h1>Edition de la ville : <?php echo $city->getName() ?></h1>
<a href="./">← Retour accueil</a>
<form method="POST" action="index.php?action=updateCity&id=<?php echo $city->getId() ?>">
  <label for="name">Nom : </label><input type="text" name="newName" value="<?php echo $city->getName() ?>">
  <input type="submit" value="Modifier">
</form>
