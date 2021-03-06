<div class="d-flex flex-column flex-md-row">
	<div>
		<img src="<?= HOST; ?>/public/smallBalloon.png" alt="" class="img-fluid"/>
	</div>
	<div class="pt-5">
		<h2>Inscription</h2>
		<form method="post" action="<?= HOST; ?>/register">
			<div class="form-group">
				<label for="login">Pseudo : </label>
				<br>
				<div class="info">! Tient compte des majuscules.</div>
				<input type="text" name="login" id="login" required class="form-control" />
				<?php
				if (isset($_SESSION['registerError'])) {
					?>
					<div class="text-danger display-5"><?= $_SESSION['registerError']; ?></div>
					<?php
				}
				?>
			</div>
			<div class="form-group">
				<label for="password">Mot de passe : </label>
				<input type="password" name="password" id="password" required class="form-control" />
			</div>
			<div class="form-group">
				<label for="email">Courriel : </label>
				<input type="email" name="email" id="email" required class="form-control" />
			</div>
			<input type="submit" id="submit" name="register" value="Inscription" />
			<button id="cancel" onclick="window.location.href='<?= HOST; ?>/register';">Annuler</button>
		</form>

	</div>
</div>



