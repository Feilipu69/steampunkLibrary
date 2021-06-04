<div class="container d-flex flex-column flex-md-row justify-content-around">
	<div class="pt-5 pb-3">
		<h3>Modification de vos données</h3>
		<form method="post" action="<?= HOST; ?>/updateData">
			<div class="form-group">
				<label for="login">Pseudo : </label>
				<input type="text" name="login" id="login" required class="form-control" />
			</div>
			<div class="form-group">
				<label for="password">Mot de passe : </label>
				<input type="password" name="password" id="password" required class="form-control" />
			</div>
			<div class="form-group">
				<label for="email">Courriel : </label>
				<input type="email" name="email" id="email" required class="form-control" />
			</div>
			<input type="submit" name="send" value="Modifier" />
			<button onclick="window.location.href='<?= HOST; ?>/updateData';">Annuler</button>
			<br>
			<div class="text-danger mt-3">Suppression de votre compte : <button onclick="window.location.href='<?= HOST; ?>/deleteSubscriber';">Supprimer</button></div>
		</form>
		<?php
		if (isset($_SESSION['registerError'])) {
			?>
			<div class="text-danger display-4"><?= $_SESSION['registerError']; ?></div>
			<?php
		}
		?>
	</div>
	<div class="pt-5">
		<img src="<?= HOST; ?>/public/time.png" alt="vélo rétro" class="img-fluid" />
	</div>
</div>


