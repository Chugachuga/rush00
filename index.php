<?php 
function auth($login, $passwd)
{
    $tab = unserialize(file_get_contents("private/user.csv"));
    foreach ($tab as $key => $value) 
    {
         if ($tab[$key][0] === $login && $tab[$key][1] === $passwd)
			 return TRUE;
	}
    return FALSE;
}

if (!empty($_POST['login']) && (!empty($_POST['passwd'])))
{
	$log = $_POST['login'];
	$pwd = hash('whirlpool', $_POST['passwd']);
	$user[] = array("login" => $log,
					"passwd" => $pwd);
	if (file_exists('private/user.csv') && auth($log, $pwd) === TRUE)
	{
		$_SESSION['panier']['user'] = $_POST['login'];
	?><span><h2>Vous êtes maintenant connecté(e)<br /><?php echo $_SESSION['panier']['user']."\n";?></h2></span>Pour continuer, <a href="testlog.php?<?php echo htmlspecialchars(SID); ?>">cliquez ici</a>.<?php
	}
	else
	{
		?><span><h3>Nom de Compte ou Mot de Passe Invalide</h3></span>Pour revenir a l'Accueil, <a href="test.php">cliquez ici</a>.<?php
	}
}
else
{
	include ('test.php');
}
?>
