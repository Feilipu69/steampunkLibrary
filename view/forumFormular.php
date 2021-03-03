<?php
if (isset($_GET['parameter'])) {
	?>
	<form method="post" action="<?= HOST; ?>/addForumTheme/<?= $_GET['parameter']; ?>">
		<label for="title">Titre</label>
		<input type="text" name="title" id="title" />
		<br>
		<label for="content">Contenu</label>
		<textarea name="content"></textarea>
		<br>
		<input type="submit" name="send" value="Envoyer" />
		<button onclick="window.location.href='<?= HOST; ?>/addForumTheme';">Annuler</button>
	</form>
	<?php
}
?>
