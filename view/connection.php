<h3>Connexion</h3>
<form method="post" action="<?= HOST; ?>/connection">
	<label for="login">Login :</label>
	<input type="text" name="login" required />
	<br>
	<label for="password">Mot de passe : </label>
	<input type="password" name="password" required />
	<br>
	<input type="submit" name="connection" value="Connexion" />
	<button onclick="window.location.href='<?= HOST; ?>/connection';">Annuler</button>
</form>

<?php
if (isset($_SESSION['registerError'])) {
	?>
	<div><?= $_SESSION['registerError']; ?></div>
	<?php
}
?>
