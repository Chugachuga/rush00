<HTML>
	<HEAD>
		<TITLE>Fruits et Legumes</TITLE>
		<link rel="stylesheet" type="text/css" href="test.css">
	</HEAD>
	<BODY style="background-color:#FBF7CB">
	<div id="imag">
		<img src="https://www.qapa.fr/news/wp-content/uploads/fruits-et-l%C3%A9gumes.jpg" alt="Fruits et legumes">
		</div><br />
	<div class="box"><br />
			<h3>   Se connecter</h3>
		<form action="index.php" method="post">
			<p>Votre Login : <input type="text" name="login" /></p>
			<p>Votre Mot de Passe : <input type="password" name="passwd" /></p>
			<p>Pass Admin : <input type="passwd" name="superpass" /></p>
			<p><input type="submit" value="OK"></p>
		</form>
	</div>
	<div class="box">
		<h3>S'inscrire</h3><br />
		<form action="create.php" method="post">
			<p>Nom de Compte : <input type="text" name="account" /></p>
			<p>Mot de Passe : <input type="password" name="password" /></p>
			<p><input type="submit" value="OK"></p>
		</form>
	</div>
	<div align="center"><div class="boxfl">
	<a href="panier.php?action=ajout&amp;l=Banane&amp;q=1&amp;p=0.50">
		<img src='https://www.auchandirect.fr/backend/media/products_images/0N_57999.jpg' alt="Banane" name="Banane" title="Banane"></a>
		<span>: 0.50E</span>
	<a href="panier.php?action=ajout&amp;l=Pomme&amp;q=1&amp;p=0.60">
		<img src="https://www.auchandirect.fr/backend/media/products_images/0N_120487.jpg" alt="Pomme" name="Pomme" title="Pomme"></a>
		<span>: 0.60E</span>
	<a href="panier.php?action=ajout&amp;l=Poire&amp;q=1&amp;p=0.50">
		<img src='http://drive-producteurs.fr/wp-content/uploads/2015/09/poire-william.jpg' name="Poire" alt="Poire" title="Poire"></a>
		<span>: 0.50E</span>
	<a href="panier.php?action=ajout&amp;l=Carotte&amp;q=1&amp;p=0.40">
		<img src='http://static.wixstatic.com/media/906027_65a41e61849040e19caaa9c569f7166b.jpg_256' name="Carotte" alt="Carotte" title="Carotte"></a>
		<span>: 0.40E</span>
	<a href="panier.php?action=ajout&amp;l=Poivron&amp;q=1&amp;p=1.50">
		<img src='https://www.auchandirect.fr/backend/media/products_images/0N_205395.jpg' name="Poivron" alt="Poivron" title="Poivron"></a>
		<span>: 1.50E</span>
	<a href="panier.php?action=ajout&amp;l=Tomate&amp;q=1&amp;p=0.30">
		<img src='https://www.auchandirect.fr/backend/media/products_images/0N_57387.jpg' name="Tomate" alt="Tomate" title="Tomate"></a>
		<span>: 0.30E</span>
	</div></div>
	<div id="border"><div id="pol"><h2 align="center">Produits</h2></div></div>
		</BODY>
</HTML>
