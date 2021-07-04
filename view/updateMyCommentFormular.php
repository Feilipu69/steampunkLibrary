<p class="container"><a href="<?= HOST; ?>/myPosts">&laquo; Retour</a></p>
<?php
if (isset($_GET['parameter'])) {
	?>
	<div class="container">
		<div><em class="text-danger">Attention les modifications supprimeront tous les votes associés.</em></div>
		<form method="post" action="<?= HOST; ?>/updateMyComment/<?= $_GET['parameter']; ?>">
			<label for="comment">Nouveau commentaire</label>
			<br>
			<textarea name="comment" id="comment"></textarea>
			<br>
			<input type="submit" name="send" value="Modifier" />
			<button onclick="window.location.href='<?= HOST; ?>/updateMyComment/<?= $_GET['parameter']; ?>';">Annuler</button>
		</form>
	</div>
	<?php
}
?>
