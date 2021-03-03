<h3>Modification de vos données</h3>
<form method="post" action="<?= HOST; ?>/updateData">
	<label for="login">Pseudo : </label>
	<input type="text" name="login" required />
	<br>
	<label for="password">Mot de passe : </label>
	<input type="password" name="password" required />
	<br>
	<label for="mail">Courriel : </label>
	<input type="email" name="email" required />
	<br>
	<input type="submit" name="account" value="Modifications" />
	<button onclick="window.location.href='<?= HOST; ?>/updateData';">Annuler</button>
	<button onclick="window.location.href='<?= HOST; ?>/deleteSubscriber';">Suppression</button>
</form>

<?php
if (isset($_SESSION['registerError'])) {
	?>
	<div><?= $_SESSION['registerError']; ?></div>
	<?php
}
?>

