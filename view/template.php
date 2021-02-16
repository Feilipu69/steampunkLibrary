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
					<?php
					if (isset($_SESSION['login'])) {
						?>
						<li><a href="<?= HOST; ?>/forum">Forum<a></li>
						<li><a href="<?= HOST; ?>/account">Compte</a></li>
						<?php
						if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
							?>
							<li><a href="<?= HOST; ?>/Administration">Administration</a></li>
							<?php
						}
						?>
						<li><a href="<?= HOST; ?>/disconnection">Déconnexion</a></li> 
						<?php
					}

					if (!isset($_SESSION['login'])) {
						?>
						<li><a href="<?= HOST; ?>/register">Inscription</a></li>
						<li><a href="<?= HOST; ?>/connection">Connexion</a></li>
						<?php
					}
					?>
				</ul>
			</nav>
		</header>
		<section>
			<?php
			if (isset($_SESSION['login'])) {
				?>
				<p>Bienvenue <?= $_SESSION['login']; ?>
				<?php
			}
			?>
			<?= $content; ?>
		</section>
		<footer>
		</footer>
	</body>
</html>
