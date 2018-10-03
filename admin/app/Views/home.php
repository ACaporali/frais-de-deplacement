<h1>Gestionnaire des villes et des distances</h1>
<h2>Liste des villes :</h2>
<a href="?action=createCity">Ajouter</a>
<table>
  <thead>
    <tr>
      <th>Nom</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($resultCities as $key => $value) {
      echo '<tr>
        <td>' . ucfirst($value->getName()) . '</td>
        <td><a href="?action=updateCity&id=' . $key . '">Modifier ✎</a> / <a href="?action=deleteCity&id=' . $key . '">Supprimer ❌</a></td>
      </tr>';
    } ?>
  </tbody>
</table>
<hr>
<h2>Liste des distences :</h2>
<a href="?action=createDistance">Ajouter</a>
<table>
  <thead>
    <tr>
      <th>Ville de depart</th>
      <th>Ville d'arrivée</th>
      <th>Distance (km)</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($resultDistances as $key => $value) {
      echo '<tr>
        <td>' . ucfirst($value->getCityStart()->getName()) . '</td>
        <td>' . ucfirst($value->getCityEnd()->getName()) . '</td>
        <td>' . ucfirst($value->getKm()) . '</td>
        <td><a href="?action=updateDistance&id=' . $key . '">Modifier ✎</a> / <a href="?action=deleteDistance&id=' . $key . '">Supprimer ❌</a></td>
      </tr>';
    } ?>
  </tbody>
</table>
