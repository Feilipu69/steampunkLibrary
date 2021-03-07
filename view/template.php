<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
						<li><a href="<?= HOST; ?>/newsletters">Newsletter<a></li>
						<li><a href="<?= HOST; ?>/forum">Forum<a></li>
						<?php
						if (isset($_SESSION['role'])) {
							?>
							<li><a href="<?= HOST; ?>/updateData">Gestion de vos données</a></li>
							<li><a href="<?= HOST; ?>/mySubjects">Mes sujets</a></li>
							<?php
						}
						if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'moderateur')) {
							?>
							<li><a href="<?= HOST; ?>/administration">Administration</a></li>
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
		<script>
			tinymce.init({
				selector:'textarea',
				plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
				toolbar_mode: 'floating'
			});
		</script>
	</body>
</html>
