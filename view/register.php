<form method="post" action="<?= HOST; ?>/register">
	<label for="login">Pseudo : </label>
	<input type="text" name="login" required />
	<br>
	<label for="password">Mot de passe : </label>
	<input type="password" name="password" required />
	<br>
	<label for="mail">Courriel : </label>
	<input type="email" name="email" />
	<br>
	<input type="submit" name="register" value="Inscription" />
	<button onclick="window.location.href='<?= HOST; ?>/register';">Annuler</button>
</form>

<?php
if (isset($_SESSION['registerError'])) {
	?>
	<div><?= $_SESSION['registerError']; ?></div>
	<?php
}
?>

