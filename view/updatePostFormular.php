<?php
if (isset($_GET['parameter'])) {
	?>
	<div class="container">
		<form method="post" action="<?= HOST; ?>/updatePost/<?= $_GET['parameter']; ?>">
			<label for="title">Titre</label>
			<input type="text" name="title" id="title" />
			<br>
			<label for="content">Contenu</label>
			<textarea name="content"></textarea>
			<br>
			<input type="submit" name="send" value="Modifier" />
			<button onclick="window.location.href='<?= HOST; ?>/updatePost/<?= $_GET['parameter']; ?>';">Annuler</button>
		</form>
	</div>
	<?php
}
?>
