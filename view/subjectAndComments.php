<h3>Ajouter un commentaire</h3>
<form method="post" action="<?= HOST; ?>/addOpinion/<?=$_GET['parameter']; ?>">
	<label for="login">Pseudo : </label>
	<input type="text" name="login" id="login" value="<?= $_SESSION['login']; ?>" />
	<br>
	<textarea name="comment"></textarea>
	<br>
	<input type="submit" name="send" value="Envoyer" />
</form>
<h3><?= $subjectData->getTitle(); ?></h3>
<em>Publié par <?= $subjectData->getLoginSubscriber(); ?> le <?= $subjectData->getDate(); ?></em>
<p><?= $subjectData->getContent(); ?></p>
<?php
if (isset($opinions)) {
	?>
	<h3>Commentaires</h3>
	<?php
	foreach ($opinions as $opinion) {
		?>
		<p><strong><?= $opinion->getLogin(); ?></strong> a écrit : </p>
		<p><?= $opinion->getComment(); ?></p>
		<?php
	}
}
?>
