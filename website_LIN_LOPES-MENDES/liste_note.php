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
  <link rel="stylesheet" href="note_candidat.css">
  <title>Projet C2i : Liste des notes</title>
</head>

<body>

  <div class="accueil">
    <h1>Liste des notes</h1>
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

  $res = $cnx->query("SELECT convoq.idetud, nom, prenom, libelle, note FROM convoquer convoq, candidat cand, epreuve e, module mod 
    WHERE (convoq.idetud = cand.idetud) AND (e.codemod = mod.codemod AND convoq.codeep = e.codeep) AND note IS NOT NULL order by convoq.idetud");

  if ($res == false) {
    echo "<p class='error'>Erreur ! L'exécution de la requête a échoué, vérifiez le code.</p><br/>\n";
  }

  else {

    $variable_temp = 0;

    echo "<table>";
    echo "
      <tr>
        <th>Numéro</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Épreuve</th>
        <th>Note</th>
      </tr>";

    foreach ($res as $ligne) {
      if ($variable_temp != $ligne[idetud]) {
        echo "
          <tr>
            <td style='width: 5%'>$ligne[idetud]</td>
            <td id='nom' style='width: 40%'>$ligne[nom]</td>
            <td style='width: 30%'>$ligne[prenom]</td>
            <td style='width: 15%'>$ligne[libelle]</td>
            <td style='width: 10%'>$ligne[note]</td> 
          </tr>";

        $variable_temp = $ligne[idetud];

      }


      else {
        echo"
          <tr>
            <td style='width: 5%'></td>
            <td id='nom' style='width: 40%'>$ligne[nom]</td>
            <td style='width: 30%'>$ligne[prenom]</td>
            <td style='width: 15%'>$ligne[libelle]</td>
            <td style='width: 10%'>$ligne[note]</td> 
          </tr>";
      }
    }

    echo "</table>";
  }

  $res = null;
  $cnx = null;

  ?>

</body>
</html>