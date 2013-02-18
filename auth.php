<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<html>
<body>
<p>
<?php
$user = $_POST['u'];
$pwd = $_POST['p'];
echo $user;
echo '<br>';
echo $pwd;
echo '<br>';

$lines = file('users.txt');
$trouve = false;
foreach ($lines as $lineNumber => $lineContent)
{
  //split pour recuêrer les infos
	$tab = preg_split("/;/",$lineContent);
	$g= (int)$tab[3];
	echo $g;
	echo '<br>';
	if($tab[1]===$user) {
	echo $tab[1];
	echo '<br>';
	echo md5($pwd.$g);
	echo '<br>';
	echo $tab[2];
	echo '<br>';
	if(md5($pwd.$g)===$tab[2]) {
		$trouve = true;
		//$_SESSION['id1'] = openssl_random_pseudo_bytes(999);
		$_SESSION['id1'] = md5(mt_rand());
		$_SESSION['iduser']=$tab[0];
		
		echo 'connected';
	}
	}
	
}

if(!$trouve) {echo 'not connected'; header("Location: main.php");     }
else header("Location: main.php?r=".$_SESSION['id1']);     
 
  
?>
</p>
</body>
</html>
