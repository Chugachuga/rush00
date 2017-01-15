<?PHP

if ($_POST[account] == "" || $_POST[password] == "")
	echo "ERROR\n";
else
	if (file_exists("./private/user.csv"))
	{
		$tab = unserialize(file_get_contents("./private/user.csv"));
		foreach($tab as $elem)
		{
			if($elem[0] == $_POST[account])
			{
				?><span><h2>Nom de compte invalide car non disponible</h2></span>Pour revenir a l'Accueil, <a href="test.php">cliquez ici</a>.<?PHP
			$s = 1;
				break;
			}
		}
		if ($s != 1)
		{
			$tab[] = array($_POST[account], hash("whirlpool", $_POST[password]));
			if (file_put_contents("./private/user.csv", serialize($tab)))
			{
			?><span><h2>Votre compte a bien été créer, vous êtes desormais invité(e) a vous connecter</h2></span>
				</span>Pour continuer, <a href="test.php">cliquez ici</a>.<?php
			}
		else
			{
				echo "ERROR\n";
			}
		}
	}
	else
	{
		if (file_put_contents("./private/user.csv", serialize(array(array($_POST[account], hash("whirlpool", $_POST[password]))))))
		{
			?><span><h2>Votre compte a bien été créer, vous êtes desormais invité(e) a vous connecter</h2></span>
				</span>Pour continuer, <a href="test.php">cliquez ici</a>.<?php
		}
		else
			echo "ERROR\n";
	}
?>
