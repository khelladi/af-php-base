<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
if (isset($_SESSION['id1']) && isset($_GET['r']) && $_SESSION['id1']===$_GET['r']){
/*Ouvre le fichier et retourne un tableau contenant une ligne par élément*/
$lines = file('base.txt');
/*On parcourt le tableau $lines et on affiche le contenu de chaque ligne précédée de son numéro*/
foreach ($lines as $lineNumber => $lineContent)
{
if(!empty($_GET['d']) && !empty($_GET['a'])){
  $tab = preg_split("/;/",$lineContent);
	if(substr_count($tab[2],$_GET['d'])>0 && substr_count($tab[3],$_GET['a'])>0){
	//split pour recuêrer les infos
	
	//$v=$tab[1]+';'+$tab[2];
	echo "<button onClick=\"calcRoute('$tab[2]','$tab[3]');\">";
	echo 'Num ',$lineNumber,', depart : ',$tab[2],', arrivee : ',$tab[3],', nbr_place : ',$tab[4],', date : ',$tab[5], '</button>';
	echo '<a href =\'choose.php?r=',$_SESSION['id1'],'&ido=',$tab[0],'\' >Choisir cette offre </a><br>';
	}
}
else if (!empty($_GET['d'])) {
	$tab = preg_split("/;/",$lineContent);
	if(substr_count($tab[2],$_GET['d'])>0){
	//split pour recuêrer les infos
	
	//$v=$tab[1]+';'+$tab[2];
	echo "<button onClick=\"calcRoute('$tab[2]','$tab[3]');\">";
	echo 'Num ',$lineNumber,', depart : ',$tab[2],', arrivee : ',$tab[3],', nbr_place : ',$tab[4],', date : ',$tab[5], '</button>';
	echo '<a href =\'choose.php?r=',$_SESSION['id1'],'&ido=',$tab[0],'\' >Choisir cette offre </a><br>';
	}
	}
else if (!empty($_GET['a'])) {
	$tab = preg_split("/;/",$lineContent);
	if(substr_count($tab[3],$_GET['a'])>0){
	//split pour recuêrer les infos
	
	//$v=$tab[1]+';'+$tab[2];
	echo "<button onClick=\"calcRoute('$tab[2]','$tab[3]');\">";
	echo 'Num ',$lineNumber,', depart : ',$tab[2],', arrivee : ',$tab[3],', nbr_place : ',$tab[4],', date : ',$tab[5], '</button>';
	echo '<a href =\'choose.php?r=',$_SESSION['id1'],'&ido=',$tab[0],'\' >Choisir cette offre </a><br>';
	}
	}
else {
//split pour recuêrer les infos
	$tab = preg_split("/;/",$lineContent);
	//$v=$tab[1]+';'+$tab[2];
	echo "<button onClick=\"calcRoute('$tab[2]','$tab[3]');\">";
	echo 'Num ',$lineNumber,', depart : ',$tab[2],', arrivee : ',$tab[3],', nbr_place : ',$tab[4],', date : ',$tab[5], '</button>';
	echo '<a href =\'choose.php?r=',$_SESSION['id1'],'&ido=',$tab[0],'\' >Choisir cette offre </a><br>';
}

}

}
else {
echo 'you are not authorized to be here , please do log in';
header("Location: main.php");
}
?>
