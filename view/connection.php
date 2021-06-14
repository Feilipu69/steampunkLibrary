<div class="container d-flex flex-column flex-md-row justify-content-center">
	<div class="pt-5">
		<h2>Connexion</h2>
		<form method="post" action="<?= HOST; ?>/connection">
			<div class="form-group">
				<label for="login">Pseudo :</label>
				<input type="text" name="login" id="login" required class="form-control" />
			</div>
			<div class="form-group">
				<label for="password">Mot de passe : </label>
				<input type="password" name="password" id="password" required class="form-control" />
			</div>
			<input type="submit" id="submit" name="connection" value="Connexion" />
			<button id="cancel" onclick="window.location.href='<?= HOST; ?>/connection';">Annuler</button>
		</form>
		<?php
		if (isset($_SESSION['error'])) {
			?>
			<div class="text-danger display-5"><?= $_SESSION['error']; ?></div>
			<?php
		}
		?>
	</div>
	<div>
		<img src="<?= HOST; ?>/public/smallBoat.png" alt="" class="img-fluid" />
	</div>
</div>


