<?PHP

function	creationPanier()
{
	if (!isset($_SESSION['panier']))
	{
		$_SESSION['panier']=array();
		$_SESSION['panier']['libelleProduit'] = array();
		$_SESSION['panier']['qteProduit'] = array();
		$_SESSION['panier']['prixProduit'] = array();
		$_SESSION['panier']['user'] = NULL;
		$_SESSION['panier']['verrou'] = FALSE;
	}
	return TRUE;
}

function	ajouterArticle($libelleProduit,$qteProduit,$prixProduit)
{
	if (creationPanier() && !isVerrouille())
	{
		//Si le produit existe déjà on ajoute seulement la quantité
		$positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);

		if ($positionProduit !== false)
		{
			$_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
		}
		else
		{
			//Sinon on ajoute le produit
			array_push( $_SESSION['panier']['libelleProduit'],$libelleProduit);
			array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
			array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
		}
	}
	else
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function	modifierQTeArticle($libelleProduit,$qteProduit)
{
	//Si le panier éxiste
	if (creationPanier() && !isVerrouille())
	{
		//Si la quantité est positive on modifie sinon on supprime l'article
		if ($qteProduit > 0)
		{
			//Recharche du produit dans le panier
			$positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);
			if ($positionProduit !== false)
			{
				$_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
			}
		}
		else
			supprimerArticle($libelleProduit);
	}
	else
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function	MontantGlobal()
{
	$total=0;
	for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
	{
		$total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
	}
	return $total;
}

function	isVerrouille()
{
	if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
		return true;
	else
		return false;
}

function	supprimePanier()
{
	unset($_SESSION['panier']);
}

function supprimerArticle($libelleProduit){
	//Si le panier existe
	if (creationPanier() && !isVerrouille())
	{
		//Nous allons passer par un panier temporaire
		$tmp=array();
		$tmp['libelleProduit'] = array();
		$tmp['qteProduit'] = array();
		$tmp['prixProduit'] = array();
		$tmp['verrou'] = $_SESSION['panier']['verrou'];

		for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
		{
			if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit)
			{
				array_push( $tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
				array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
				array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
			}
		}
		//On remplace le panier en session par notre panier temporaire à jour
		$_SESSION['panier'] =  $tmp;
		//On efface notre panier temporaire
		unset($tmp);
	}
	else
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}
?>
<?php

include ('header.php');
$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
	if(!in_array($action,array('ajout', 'suppression', 'refresh')))
		$erreur=true;

	//récuperation des variables en POST ou GET
	$l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
	$p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
	$q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

	//Suppression des espaces verticaux
	$l = preg_replace('#\v#', '',$l);
	//On verifie que $p soit un float
	$p = floatval($p);

	//On traite $q qui peut etre un entier simple ou un tableau d'entier

	if (is_array($q)){
		$QteArticle = array();
		$i=0;
		foreach ($q as $contenu){
			$QteArticle[$i++] = intval($contenu);
		}
	}
	else
		$q = intval($q);

}

if (!$erreur){
	switch($action){
		Case "ajout":
			ajouterArticle($l,$q,$p);
		break;
		Case "suppression":
			supprimerArticle($l);
		break;

		Case "refresh" :
			for ($i = 0 ; $i < count($QteArticle) ; $i++)
			{
				modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
			}
		break;

		Default:
			break;
	}
}
?>
<form method="post" action="panier.php">
	<table style="width: 400px">
	<tr>
		<td colspan="4">Votre panier</td>
	</tr>
	<tr>
		<td>Libellé</td>
		<td>Quantité</td>
		<td>Prix Unitaire</td>
		<td>Action</td>
	</tr>
<?php
if (creationPanier())
{
	$nbArticles=count($_SESSION['panier']['libelleProduit']);
	if ($nbArticles <= 0)
		echo "<tr><td>Votre panier est vide </ td></tr>";
	else
	{
		for ($i=0 ;$i < $nbArticles ; $i++)
		{
			echo "<tr>";
			echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
			echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
			echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
			echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">XX</a></td>";
			echo "</tr>";
		}

		echo "<tr><td colspan=\"2\"> </td>";
		echo "<td colspan=\"2\">";
		echo "Total : ".MontantGlobal();
		echo "</td></tr>";

		echo "<tr><td colspan=\"4\">";
		echo "<input type=\"submit\" value=\"Rafraichir\"/>";
		echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

		echo "</td></tr>";
	}
}?>
</table>
</form>
</BODY>
</HTML><?php
if (!$_SESSION['panier']['user'])
{
	echo $_SESSION['panier']['user'];
	include ('test.php');
}
else
{
	echo $_SESSION['panier']['user'];
	echo "SESSION USER EXISTE";
	include ('testlog.php');
}

?>
