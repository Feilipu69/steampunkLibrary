<?php
if (isset($_GET['parameter']) && isset($_GET['page']) && isset($_SESSION['login'])) {
	?>
	<div>
	<button onclick="comment()">Ajouter un commentaire</button>
	<form method="post" action="<?= HOST; ?>/subjectAndComments/<?=$_GET['parameter']; ?>" id="comment" style="display:none">
		<label for="login">Pseudo : </label>
		<input type="text" name="login" id="login" value="<?= $_SESSION['login']; ?>" />
		<br>
		<textarea name="comment"></textarea>
		<br>
		<input type="submit" name="send" id="send" value="Envoyer" />
		<button onclick="window.location.href='<?= HOST; ?>/subjectAndComments/<?= $_GET['parameter']; ?>';">Annuler</button>
	</form>
	</div>
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
		<div>
			<p><strong><?= strip_tags($opinion->getLogin()); ?></strong> a écrit : </p>
			<p><?= strip_tags($opinion->getComment()); ?></p>
			<?php
			if (isset($_SESSION['role']) && $_SESSION['role'] != 'membre') {
				?>
				<a href="<?= HOST; ?>/deleteOpinion/<?= $_GET['parameter']; ?>/<?= $opinion->getId(); ?>">Supprimer le commentaire</a>
				<br>
				<?php
			}
			?>

			<button onclick="addRemoveAgree(<?= $opinion->getId(); ?>, 'agree')"><img src="<?= HOST; ?>/public/thumbUp.svg" /></button> : <span id="agreeOpinions<?= $opinion->getId(); ?>"></span>
			<button onclick="addRemoveDisagree(<?= $opinion->getId(); ?>, 'disagree')"><img src="<?= HOST; ?>/public/thumbDown.svg" /></button> : <span id="disagreeOpinions<?= $opinion->getId(); ?>"></span>

		</div>
		<?php
	}
	?>
	<div class="container-fluid">
		<ul class="pagination">
			<li class="page-item <?= ($currentPage == 1) ? "disabled" : ""; ?>"><a class="page-link" href="<?= HOST; ?>/subjectAndComments/<?= $_GET['parameter']; ?>/<?= $currentPage - 1; ?>">Précédente</a></li>
			<?php
			for ($page = 1; $page <= $allPages; $page++) {
				?>
				<li class="page-item <?php ($currentPage == $page) ? "active" : ""; ?>"><a class="page-link" href="<?= HOST; ?>/subjectAndComments/<?= $_GET['parameter']; ?>/<?= $page; ?>"><?= $page; ?></a></li>
				<?php
			}
			?>
			<li class="page-item <?= ($currentPage == $allPages) ? "disabled" : ""; ?>"><a class="page-link" href="<?= HOST; ?>/subjectAndComments/<?= $_GET['parameter']; ?>/<?= $currentPage + 1; ?>">Suivante</a></li>
		</ul>
	</div>
	<?php
}
?>
<script>
	let host = "<?= HOST; ?>";
	let page = <?= $_GET['page']; ?>;
	let opinionsId = <?= $opinionsId; ?>;
</script>
<script src="<?= HOST; ?>/assets/js/comment.js"></script>
<script src="<?= HOST; ?>/assets/js/votes.js"></script>
