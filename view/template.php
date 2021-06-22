<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="<?= HOST; ?>/style/style.css" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
		<script src="https://cdn.tiny.cloud/1/wh9z1mfuolvg4lwiul6nr0x5ur1txczi3ksrn9vm58r2itps/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<<<<<<< HEAD
		<meta name="description" content="SteampunkLibrary est un blog de littérature steampunk avec un forum pour échanger des idées de livres et pour discuter des livres présentés">
=======
		<meta name="description" content="Blog de litterature steampunk avec un forum pour échanger des idées de livres ou pour commenter les livres présentés">
>>>>>>> tests
		<title>La Bibliothèque à Vapeur</title>
	</head>
	<body>
		<div class="container rounded">
			<header class="pb-3 mb-3">
				<div class="text-center mt-5"><img src="<?= HOST; ?>/public/gear-animated.gif" alt="" class="d-none d-lg-inline img-fluid" /><h1 class="d-inline"><a href="<?= HOST; ?>" class="text-decoration-none">La Bibliothèque à Vapeur</a></h1><img src="<?= HOST; ?>/public/gear-animated.gif" alt="" id="gear" class="d-none d-lg-inline img-fluid" /></div>
				<nav id="navbar" class="navbar navbar-expand-md navbar-light border-top border-bottom border-warning">
					<button id="buttonBurger" class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarContent">
						<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
							</svg>
							Menu
						</button>
						<div id="navbarContent" class="collapse navbar-collapse justify-content-center">
							<ul class="nav">
								<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>">Accueil</a></li>
								<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/books?page=1">Bibliothèque</a></li>
								<?php
								if (isset($_SESSION['login'])) {
									?>
									<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/newsletters">Bulletin</a></li>
									<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/forum">Forum</a></li>
									<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/updateData">Gestion de vos données</a></li>
									<li class="nav-item"><a class="nav-link" href="<?= HOST; ?>/myPosts">Mes sujets</a></li>
									<?php
									if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' || $_SESSION['role'] === 'moderator') {
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
			<main class="container rounded pt-3 pb-3">
				<?php
				if (isset($_SESSION['login'])) {
					?>
					<div class="bienvenue container mt-3 mb-3">Bienvenue <?= $_SESSION['login']; ?></div>
					<?php
				}
				?>
				<?= $content; ?>
			</main>
			<footer class="mt-3">
				<div class="container rounded d-lg-flex justify-content-between">
					<div>
						Liens :
						<ul>
							<li><a href="https://fr.wikipedia.org/wiki/Steampunk" target="_blank">Steampunk Wikipedia</a></li> 
							<li><a href="https://www.french-steampunk.fr" target="_blank">french-steampunk</a></li>
							<li><a href="https://www.steampunkstore.fr" target="_blank">steampunkstore</a></li>
						</ul>
					</div>
					<div>
						<div class="author">&copy; 2021 Apprenti-développeur</div>
					</div>
				</div>
			</footer>
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
