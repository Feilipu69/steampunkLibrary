<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="<?= HOST; ?>/style/style.css" />
		<script src="https://cdn.tiny.cloud/1/wh9z1mfuolvg4lwiul6nr0x5ur1txczi3ksrn9vm58r2itps/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>La Bibliothèque à Vapeur</title>
	</head>
	<body>
		<div class="container">
			<header>
				<h1><a href="<?= HOST; ?>" class="text-decoration-none">La Bibliothèque à Vapeur</a></h1>
				<nav id="navbar" class="navbar navbar-expand-md navbar-light text-center">
					<button id="buttonBurger" class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarContent">
						<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
							</svg>
						</button>
						<div id="navbarContent" class="collapse navbar-collapse">
							<ul class="nav">
								<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>">Accueil</a></li>
								<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/books">Bibliothèque</a></li>
								<?php
								if (isset($_SESSION['login'])) {
									?>
									<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/newsletters">Newsletter</a></li>
									<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/forum">Forum</a></li>
									<?php
									if (isset($_SESSION['role'])) {
										?>
										<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/updateData">Gestion de vos données</a></li>
										<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/mySubjects">Mes sujets</a></li>
										<?php
									}
									if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'moderator')) {
										?>
										<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/administration">Administration</a></li>
										<?php
									}
									?>
									<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/disconnection">Déconnexion</a></li> 
									<?php
								}

								if (!isset($_SESSION['login'])) {
									?>
									<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/register">Inscription</a></li>
									<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/connection">Connexion</a></li>
									<?php
								}
								?>
							</ul>
						</div>
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
					<p>&copy; 2021 apprenti-développeur</p>
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
