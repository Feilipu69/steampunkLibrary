<p class="container"><a href="<?= HOST; ?>/myPosts">Retour</a></p>
<?php
if (isset($_GET['parameter'])) {
	?>
	<div class="container">
		<form method="post" action="<?= HOST; ?>/updateMyOpinion/<?= $_GET['parameter']; ?>">
			<label for="comment">Nouveau commentaire</label>
			<br>
			<textarea name="comment" id="comment"></textarea>
			<br>
			<input type="submit" name="send" value="Modifier" />
			<button onclick="window.location.href='<?= HOST; ?>/updateMyOpinion/<?= $_GET['parameter']; ?>';">Annuler</button>
		</form>
	</div>
	<?php
}
?>
