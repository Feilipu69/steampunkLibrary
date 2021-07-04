<?php
if (isset($_GET['parameter'])) {
	?>
	<div class="container mb-3"><em class="text-danger">Attention les modifications supprimeront tous les commentaires associés.</em></div>
	<div class="container">
		<form method="post" action="<?= HOST; ?>/updatePost/<?= $_GET['parameter']; ?>">
			<label for="title">Titre</label>
			<input type="text" name="title" id="title" placeholder="<?= $mypost->getTitle(); ?>"/>
			<br>
			<label for="content">Contenu</label>
			<textarea name="content" id="content" placeholder="<?= strip_tags($mypost->getContent()); ?>"></textarea>
			<br>
			<input type="submit" name="send" value="Modifier" />
			<button onclick="window.location.href='<?= HOST; ?>/updatePost/<?= $_GET['parameter']; ?>';">Annuler</button>
		</form>
	</div>
	<?php
}
?>
