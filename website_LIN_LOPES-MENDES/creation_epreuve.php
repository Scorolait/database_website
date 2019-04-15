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
  <link rel="stylesheet" href="creation_epreuve.css">
  <title>Projet C2i : Création d'une épreuve</title>
</head>

<body>
  <div class="accueil">
    <h1>Création d'une épreuve</h1>
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
  <form method="POST" action="creation_epreuve_2.php">

    <fieldset>

      <legend>Informations de l'épreuve :</legend>
      <br>
      <label for="date">Entrez la date de l'épreuve :</label>
      <input type="date" id="date" name="dateep" placeholder="AAAA-MM-JJ" required>

      <br>
      <label for="heuredebut">Entrez l'heure du début de l'épreuve :</label>
      <input type="time" id="heuredebut" name="heuredebut" placeholder="HH:MM:SS" required>

      <br>
      <label for="heurefin">Entrez l'heure de la fin de l'épreuve :</label>
      <input type="time" id="heurefin" name="heurefin" placeholder="HH:MM:SS" required>

      <br>
      <label for="salle">Entrez la salle de l'épreuve :</label>
      <input type="text" id="salle" name="salleep" placeholder="A001" required>



      <br>
      <?php

      include("connexion.inc.php");

      /* la liste des bâtiments */
      $res = $cnx->query("SELECT nombat FROM batiment");

      if ($res == false) {
        echo "<p class='error'>Erreur ! L'exécution de la requête a échoué, vérifiez le code.</p><br/>\n";
      }

      else {
        
        echo "<label for='nombat'>Sélectionnez le bâtiment :</label>";
        echo "<select id='nombat' name='nombat' required>";
        echo "<option value='' selected='selected'>-- bâtiment --</option>";

        foreach ($res as $ligne) {
          echo "<option value='$ligne[nombat]'>$ligne[nombat]</option>";
        }
        
        echo "</select>";

      }


      echo "<br>\n";
      /* la liste des sessions */
      $res = $cnx->query("SELECT nomsession from session_exam");

      if ($res == false) {
        echo "<p class='error'>Erreur ! L'exécution de la requête a échoué, vérifiez le code.</p><br/>\n";
      }

      else {

        echo "<label for='session'>Sélectionnez la session :</label>";
        echo "<select id='session' name='nomsession' required>";
        echo "<option value='' selected='selected'>-- session --</option>";

        foreach ($res as $ligne) {
          echo "<option value='$ligne[nomsession]'>$ligne[nomsession]</option>";
        }

        echo "</select>";

      }


      echo "<br>\n";
      /* la liste des modules */
      $res = $cnx->query("SELECT codemod, libelle from module");

      if ($res == false) {
        echo "<p class='error'>Erreur ! L'exécution de la requête a échoué, vérifiez le code.</p><br/>\n";
      }

      else {

        echo "<label for='mod'>Sélectionnez la matière à passer :</label>";
        echo "<select id='mod' name='codemod' required>";
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