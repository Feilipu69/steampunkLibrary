<div class="d-flex flex-column flex-md-row">
	<div>
		<img src="<?= HOST; ?>/public/smallBalloon.png" alt="Image d'un dirigeable steampunk" class="img-fluid"/>
	</div>
	<div class="pt-5">
		<h3>Inscription</h3>
		<form method="post" action="<?= HOST; ?>/register">
			<div class="form-group">
			<label for="login">Pseudo : </label>
			<input type="text" name="login" required class="form-control" />
			</div>
			<div class="form-group">
			<label for="password">Mot de passe : </label>
			<input type="password" name="password" required class="form-control" />
			</div>
			<div class="form-group">
			<label for="mail">Courriel : </label>
			<input type="email" name="email" required class="form-control" />
			</div>
			<input type="submit" id="submit" name="register" value="Inscription" />
			<button id="cancel" onclick="window.location.href='<?= HOST; ?>/register';">Annuler</button>
		</form>
	</div>
</div>

<?php
if (isset($_SESSION['registerError'])) {
	?>
	<div><?= $_SESSION['registerError']; ?></div>
	<?php
}
?>

