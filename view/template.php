<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>La Bibliothèque à Vapeur</title>
	</head>
	<body>
		<header>
			<h1><a href="<?= HOST; ?>">La Bibliothèque à Vapeur</a></h1>
			<nav>
				<ul>
					<li><a href="<?= HOST; ?>">Acceuil</a></li>
					<li><a href="<?= HOST; ?>/books">Bibliothèque</a></li>
					<!-- Si inscription/connexion 
					<li><a href="">Forum></a></li>
					<li><a href="">Newsletter</a></li>
					-->
					<li><a href="">Inscription</a></li>
					<li><a href="">Connexion</a></li>
				</ul>
			</nav>
		</header>
		<section>
			<?= $content; ?>
		</section>
		<footer>
		</footer>
	</body>
</html>
