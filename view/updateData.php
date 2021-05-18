<div class="container d-flex flex-column flex-md-row justify-content-center">
	<div class="pt-5">
		<h3>Modification de vos données</h3>
		<form method="post" action="<?= HOST; ?>/updateData">
			<div class="form-group">
				<label>Pseudo : </label>
				<input type="text" name="login" required class="form-control" />
			</div>
			<div class="form-group">
				<label>Mot de passe : </label>
				<input type="password" name="password" required class="form-control" />
			</div>
			<div class="form-group">
				<label>Courriel : </label>
				<input type="email" name="email" required class="form-control" />
			</div>
			<input type="submit" name="send" value="Modifier" />
			<button onclick="window.location.href='<?= HOST; ?>/updateData';">Annuler</button>
			<button onclick="window.location.href='<?= HOST; ?>/deleteSubscriber';">Suppression</button>
		</form>
	</div>
	<div>
		<img src="<?= HOST; ?>/public/time.png" alt="vélo rétro" class="img-fluid" />
	</div>
</div>
<?php
if (isset($_SESSION['registerError'])) {
	?>
	<div><?= $_SESSION['registerError']; ?></div>
	<?php
}
?>

