<h1>Creation d'une nouvelle distance</h1>
<a href="./">← Retour accueil</a>
<form method="POST" action="index.php?action=createDistance">
  <label for="start">Ville de départ : </label>
  <select name="start">
    <?php foreach ($resCities as $key => $city) {
      echo '<option value="' . $key . '">' . $city->getName() . '</option>';
    } ?>
  </select>
  <br>
  <label for="end">Ville d'arrivée : </label>
  <select name="end">
    <?php foreach ($resCities as $key => $city) {
      echo '<option value="' . $key . '">' . $city->getName() . '</option>';
    } ?>
  </select>
  <br>
  <label for="km">Distance (km) : </label><input type="text" name="km" placeholder="km">
  <input type="submit" value="Ajouter">
</form>
