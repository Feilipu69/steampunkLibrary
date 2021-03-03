<?php
if (isset($_GET['parameter']) && isset($_SESSION['login'])) {
	?>
	<h3>Ajouter un commentaire</h3>
	<form method="post" action="<?= HOST; ?>/subjectAndComments/<?=$_GET['parameter']; ?>">
		<label for="login">Pseudo : </label>
		<input type="text" name="login" id="login" value="<?= $_SESSION['login']; ?>" />
		<br>
		<textarea name="comment"></textarea>
		<br>
		<input type="submit" name="send" value="Envoyer" />
		<button onclick="window.location.href='<?= HOST; ?>/subjectAndComments/<?= $_GET['parameter']; ?>';">Annuler</button>
	</form>
	<?php
}
?>
<h3><?= strip_tags($subjectData->getTitle()); ?></h3>
<em>Publié par <?= strip_tags($subjectData->getLoginSubscriber()); ?> le <?= $subjectData->getDate(); ?></em>
<p><?= strip_tags($subjectData->getContent()); ?></p>
<?php
if (isset($opinions)) {
	?>
	<h3>Commentaires</h3>
	<?php
	foreach ($opinions as $opinion) {
		?>
		<p><strong><?= strip_tags($opinion->getLogin()); ?></strong> a écrit : </p>
		<p><?= strip_tags($opinion->getComment()); ?></p>
		<?php
	}
}
?>
