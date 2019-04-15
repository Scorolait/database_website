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
  <link rel="stylesheet" href="inscription_epreuve.css">
  <title>Projet C2i : Inscription à une épreuve</title>
</head>

<body>
  <div class="accueil">
    <h1>Inscription à une épreuve</h1>
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
  <form method="POST" action="convocation.php">

    <fieldset>
      <?php

      include("connexion.inc.php");

      /* la liste des candidats */
      $res = $cnx->query("SELECT idetud, nom FROM candidat");

      if ($res == false) {
        echo "<p class='error'>Erreur ! L'exécution de la requête a échoué, vérifiez le code.</p><br/>\n";
      }

      else {

        echo "<label for='idetud'>Sélectionnez le candidat :</label>";
        echo "<select id='idetud' name='idetud' required>";
        echo "<option value='' selected='selected'>-- candidat --</option>";

        foreach ($res as $ligne) {
          echo "<option value='$ligne[idetud]'>$ligne[idetud] - $ligne[nom]</option>";
        }

        echo "</select>";
      }


      echo "<br>\n";
      /* la liste des épreuves */
      $res = $cnx->query("SELECT libelle, codemod FROM module");

      if ($res == false) {
        echo "<p class='error'>Erreur ! L'exécution de la requête a échoué, vérifiez le code.</p><br/>\n";
      }

      else {

        echo "<label for='libelle'>Sélectionnez le module :</label>";
        echo "<select id='libelle' name='codemod' required>";
        echo "<option value='' selected='selected'>-- module --</option>";

        foreach ($res as $ligne) {
          echo "<option value='$ligne[codemod]'>$ligne[libelle]</option>";
        }

        echo "</select>";
      }

      $res = null;
      $cnx = null;

      ?>

    </fieldset>

    <br>
    <input type="submit" value="Valider">
    <input type="reset" value="Réinitialiser">

  </form>


</body>
</html>