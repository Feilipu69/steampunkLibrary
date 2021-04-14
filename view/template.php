<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://cdn.tiny.cloud/1/wh9z1mfuolvg4lwiul6nr0x5ur1txczi3ksrn9vm58r2itps/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>La Bibliothèque à Vapeur</title>
	</head>
	<body>
		<div class="container">
			<header>
				<h1><a href="<?= HOST; ?>">La Bibliothèque à Vapeur</a></h1>
				<nav>
					<ul>
						<li><a href="<?= HOST; ?>">Accueil</a></li>
						<li><a href="<?= HOST; ?>/books">Bibliothèque</a></li>
						<?php
						if (isset($_SESSION['login'])) {
							?>
							<li><a href="<?= HOST; ?>/newsletters">Newsletter</a></li>
							<li><a href="<?= HOST; ?>/forum">Forum</a></li>
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
		</div>
		<div class="container">
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
		</div>
		<div class="container">
			<footer>
			</footer>
		</div>
		<script>
			tinymce.init({
				selector:'textarea',
				plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
				toolbar_mode: 'floating'
			});
		</script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>
