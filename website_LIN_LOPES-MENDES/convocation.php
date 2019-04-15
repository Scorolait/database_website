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
	<title>Projet C2i : Convocation</title>
</head>

<body>
	<div class="accueil">
		<h1>Convocation</h1>
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

	$idetud = $_POST['idetud'];
	$codemod = $_POST['codemod'];
	$a = 0;

	$verif = $cnx->query("SELECT codeep from epreuve where codemod = '".$codemod."'");
	foreach ($verif as $ligne) {

		$verif2 = $cnx->query("SELECT count(idetud) from convoquer where codeep = '".$ligne['codeep']."'");
		foreach ($verif2 as $ligne2);
		$val = $ligne2['count'];

		if ($val < 30) {
			$res = $cnx->exec("INSERT INTO convoquer values ('".$idetud."', '".$ligne['codeep']."', NULL, NULL, NULL)");

			if ($res > 0) {
				echo "Vous êtes bien inscrit à l'épreuve $ligne[codeep].<br>\n";
				echo "<input type='button' class='retour' value='Retour' onClick='history.back()'>";
				$a = 1;
				break;
			}

			else {
				echo "Une erreur est survenue lors de l'inscription à cette épreuve.<br>\n";
				echo "<input type='button' class='retour' value='Retour' onClick='history.back()'>";
				$a = 1;
				break;
			}
		}
	}

	if ($a == 0) {
		echo "Aucune épreuve disponible, veuillez créer une épreuve.<br>\n";
		echo "<input type='button' class='retour' value='Retour' onClick='history.back()'>";
	}

	$verif = null;
	$verif2 = null;
	$res = null;
	$cnx = null;

	?>

</body>
</html>