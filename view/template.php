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
					<li><a href="<?= HOST; ?>">Accueil</a></li>
					<li><a href="<?= HOST; ?>/books">Bibliothèque</a></li>
					<!-- Si inscription/connexion/si session[login] 
					<li><a href="compte">compte</a></li>
					<li><a href="">Forum><a></li>
					<li><a href="">Newsletter</a></li>
					-->
					<!-- si connection retirer ces deux liens -->
					<li><a href="<?= HOST; ?>/register">Inscription</a></li>
					<li><a href="">Connexion</a></li>
					<!-- si connecté 
					<li><a href="deconnexion">Déconnexion</a></li> 
					-->
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
