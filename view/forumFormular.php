<?php
if (isset($_GET['parameter'])) {
	?>
	<div class="container mt-3">
		<form method="post" action="<?= HOST; ?>/addForumTheme/<?= $_GET['parameter']; ?>">
			<div class="form-group">
				<label for="title">Titre</label>
				<input type="text" name="title" id="title" />
			</div>
			<div class="form-goup">
				<label for="content">Contenu</label>
				<textarea name="content"></textarea>
			</div>
			<input type="submit" name="send" value="Envoyer" />
			<button onclick="window.location.href='<?= HOST; ?>/addForumTheme';">Annuler</button>
		</form>
	</div>
	<?php
}
?>
