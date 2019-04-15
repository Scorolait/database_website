<!-- note pour AILTON : ne pas oublier d'espacer le code pour le rendre plus lisible. -->
<!-- TUTO ESPACER UN CODE : 
  -mettre un espace après une virgule (ex : 'je marche, je cours' ET NON 'je marche,je cours')
  -mettre un espace à gauche et à droite d'un = (ex : '$ex = machin' ET NON '$ex=machin')
  -mettre un retour à la ligne quand il est nécessaire
-->


<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" href="projet.css">
  <link rel="stylesheet" href="menu.css">
  <link rel="stylesheet" href="liste_candidat.css">
  <title>Projet C2i : Liste des candidats</title>
</head>

<body>

	<div class="accueil">
   <h1>Liste des candidats</h1>
 </div>

  <!-- menu déroulant -->
  <div id="menu">
    <ul>

      <li class="menu-titre"><a href="projet.php">Accueil</a></li>

      <li class="menu-titre"><a href="#">Candidat</a>

        <ul class="sous-menu">
          <li><a href="inscription.html">Inscription du candidat</a></li>
          <li><a href="inscription_epreuve.php">Inscription à une épreuve</a></li>
          <li><a href="liste_candidats.php">Liste des candidats</a></li>
          <li><a href="liste_note.php">Notes des candidats</a></li>
        </ul>
      </li>

      <li class="menu-titre"><a href="#">Épreuve</a>

        <ul class="sous-menu">
          <li><a href="notation.php">Noter un candidat</a></li>
          <li><a href="liste_epreuve.php">Liste des épreuves</a></li>
          <li><a href="candidat_epreuve.php">Liste des candidats d'une épreuve</a></li>
          <li><a href="creation_epreuve.php">Création d'une épreuve</a></li>
        </ul>
      </li>

      <li class="menu-apropos"><a href="contact.html">Contactez-nous</a></li>
      <li class="menu-apropos"><a href="a_propos.html">À propos</a></li>

    </ul>
  </div>


<br>
<?php

include("connexion.inc.php");

$res = $cnx->query("SELECT idetud, nom, prenom, adremail, anneeetud, formation FROM candidat");

if ($res == false) {
  echo "<p class='error'>Erreur ! L'exécution de la requête a échoué, vérifiez le code.</p><br/>\n";
}

else {
  echo "<table>";
  echo "
    <tr>
      <th>Numéro</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Mail</th>
      <th>Formation</th>
      <th>Année d'étude</th>
    </tr>";

  foreach ($res as $ligne) {
    echo "
      <tr>
        <td>$ligne[idetud]</td>
        <td id='nom'>$ligne[nom]</td>
        <td>$ligne[prenom]</td>
        <td>$ligne[adremail]</td>
        <td>$ligne[formation]</td>
        <td>$ligne[anneeetud]</td>
      </tr>";
  }

  echo "</table>";
}

$res = null;
$cnx = null;

?>

</body>
</html>