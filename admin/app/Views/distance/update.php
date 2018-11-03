<h1>Edition de la distance '<?php echo $distance->getCityStart()->getName() . ' - ' . $distance->getCityEnd()->getName()?>' :</h1>
<a href="./">← Retour accueil</a>
<form method="POST" action="index.php?action=updateDistance&id=<?php echo $distance->getId() ?>">
  <label for="start">Ville de départ : </label>
  <select name="start">
    <?php foreach ($resCities as $key => $city) {
      if ($key == $distance->getCityStart()->getId()) {
        echo '<option value="' . $key . '" selected>' . $city->getName() . '</option>';
      } else {
        echo '<option value="' . $key . '">' . $city->getName() . '</option>';
      }
    } ?>
  </select>
  <br>
  <label for="end">Ville d'arrivée : </label>
  <select name="end">
    <?php foreach ($resCities as $key => $city) {
      if ($key == $distance->getCityEnd()->getId()) {
        echo '<option value="' . $key . '" selected>' . $city->getName() . '</option>';
      } else {
        echo '<option value="' . $key . '">' . $city->getName() . '</option>';
      }
    } ?>
  </select>
  <br>
  <label for="km">Distance (km) : </label><input type="text" name="km" placeholder="km" value="<?php echo $distance->getKm() ?>">
  <input type="submit" value="Modifier">
</form>
