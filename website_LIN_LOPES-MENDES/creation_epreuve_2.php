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
  <link rel="stylesheet" href="bouton_retour.css">
  <title>Projet C2i : Insertion d'une épreuve</title>
</head>

<body>
  <div class="accueil">
    <h1>Insertion d'une épreuve</h1>
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

  $dateep = $_POST['dateep'];
  $heuredebut = $_POST['heuredebut'];
  $heurefin = $_POST['heurefin'];
  $salleep = $_POST['salleep'];
  $nombat = $_POST['nombat'];
  $nomsession = $_POST['nomsession'];
  $codemod = $_POST['codemod'];

  $maxi = $cnx->query("SELECT max(codeep) from epreuve");
  foreach ($maxi as $ligne);
  $val = $ligne['max']+1;

  $res = $cnx->exec("INSERT INTO epreuve values ('".$val."', '".$dateep."' , '".$heuredebut."' , '".$heurefin."', '".$salleep."', '".$nomsession."', '".$nombat."', '".$codemod."')");

  if ($res > 0) {
    echo "Création de l'épreuve réussie.<br>\n";
    echo "<input type='button' class='retour' value='Retour' onClick='history.back()'>";
  }

  else {
    echo "L'épreuve n'a pas pu être créée.<br>\n";
    echo "<input type='button' class='retour' value='Retour' onClick='history.back()'>";
  }

  $maxi = null;
  $res = null;
  $cnx = null;

  ?>


</body>
</html>