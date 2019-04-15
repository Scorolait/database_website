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
  <title>Projet C2i : Inscription</title>
</head>

<body>

	<div class="accueil">
   <h1>Inscription d'un candidat</h1>
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

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['adremail'];
$annee_etud = $_POST['anneeetud'];
$formation = $_POST['formation'];
$annee_univ = $_POST['annee_univ'];
$siret = $_POST['siret'];

if ($siret == "oui_siret") {
  $nosiret = $_POST['nosiret'];
  $employeur = $_POST['employeur'];
  $adresse = $_POST['adresse'];
  $telephone = $_POST['telephone'];

  $siret_existant = 0;

  $res = $cnx->query("SELECT nosiret from employeur");

  foreach($res as $ligne) {
    if ($nosiret == $ligne['nosiret']) {
      $siret_existant = 1;
      echo "Le numéro de Siret $nosiret existe déjà, réessayez l'inscription.<br>\n";
      echo "<input type='button' class='retour' value='Retour' onClick='history.back()'>";
      break;
    }
  }

  if ($siret_existant == 0) {
    $res = $cnx->exec("INSERT INTO employeur values ('".$nosiret."', '".$employeur."' , '".$adresse."' , '".$telephone."')");

    if ($res > 0) {

      if ($formation != "aucun") {
        $insertion = $cnx->exec("INSERT INTO candidat(nom, prenom, adremail, anneeetud, formation, nosiret, annee_univ) VALUES 
          ('".$nom."', '".$prenom."', '".$mail."', '".$annee_etud."', '".$formation."', '".$nosiret."', '".$annee_univ."')");
      }

      else {
        $insertion = $cnx->exec("INSERT INTO candidat(nom, prenom, adremail, anneeetud, formation, nosiret, annee_univ) VALUES 
          ('".$nom."', '".$prenom."', '".$mail."', '".$annee_etud."', NULL, '".$nosiret."', '".$annee_univ."')");
      }

      if ($insertion > 0) {
        echo "Inscription du candidat réussie.<br>\n";
        echo "<input type='button' class='retour' value='Retour' onClick='history.back()'>";
      }
      else {
        echo "Le candidat n'a pas pu être inscrit.<br>\n";
        echo "<input type='button' class='retour' value='Retour' onClick='history.back()'>";
      }
    }

    else {
      echo "Les informations concernant l'employeur sont invalides.<br>\n";
      echo "<input type='button' class='retour' value='Retour' onClick='history.back()'>";
    }
  }
}

else {
  
  if ($formation != "aucun") {
    $insertion = $cnx->exec("INSERT INTO candidat(nom, prenom, adremail, anneeetud, formation, nosiret, annee_univ) VALUES 
      ('".$nom."', '".$prenom."', '".$mail."', '".$annee_etud."', '".$formation."', NULL, '".$annee_univ."')");
  }

  else {
    $insertion = $cnx->exec("INSERT INTO candidat(nom, prenom, adremail, anneeetud, formation, nosiret, annee_univ) VALUES 
      ('".$nom."', '".$prenom."', '".$mail."', '".$annee_etud."', NULL, NULL, '".$annee_univ."')");
  }

  if ($insertion > 0) {
    echo "Inscription du candidat réussie.<br>\n";
    echo "<input type='button' class='retour' value='Retour' onClick='history.back()'>";
  }

  else {
    echo "Le candidat n'a pas pu être inscrit.<br>\n";
    echo "<input type='button' class='retour' value='Retour' onClick='history.back()'>";
  }
  
}

$insertion = null;
$res = null;
$cnx = null;

?>

</body>
</html>