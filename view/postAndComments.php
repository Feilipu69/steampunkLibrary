<article class="container">
	<div class="marble border border-muted rounded shadow p-3 mb-3">
		<h2><?= strip_tags($postData->getTitle()); ?></h2>
		<em>Publié par <?= strip_tags($postData->getLogin()); ?> le <?= $postData->getDate(); ?></em>
		<p class="content"><?= strip_tags($postData->getContent()); ?></p>
	</div>
</article>

<?php
if (isset($_GET['parameter']) && isset($_GET['page']) && isset($_SESSION['login'])) {
	?>
	<div class="container">
		<button onclick="displayForm()" class="displayForm mt-3">Ajouter un commentaire</button>
		<form method="post" action="<?= HOST; ?>/addAComment/<?= $_GET['parameter']; ?>/<?= $_GET['page']; ?>" id="displayForm" style="display:none" class="mt-4">
			<div class="form-goup">
				<label for="login">Pseudo : </label>
				<input type="text" name="login" id="login" value="<?= $_SESSION['login']; ?>" />
			</div>
			<div class="form-group">
				<label for="comment">Commentaire</label>
				<textarea name="comment" id="comment"></textarea>
			</div>
			<input type="submit" name="send" value="Envoyer" />
			<button onclick="window.location.href='<?= HOST; ?>/addAComment/<?= $_GET["parameter"]; ?>/<?= $_GET["page"]; ?>';">Annuler</button>
		</form>
	</div>
	<?php
}
if (isset($_GET['parameter']) && isset($comments)) {
	?>
	<section class="container mt-5">
		<h3>Commentaires</h3>
		<?php
		foreach ($comments as $comment) {
			?>
			<div class="card mb-3">
				<div class="card-header">
					<p><strong><?= strip_tags($comment->getLogin()); ?></strong> a écrit : </p>
				</div>
				<div class="card-body">
					<div class="content mb-3"><?= strip_tags($comment->getComment()); ?></div>
					<?php
					if (isset($_SESSION['role']) && $_SESSION['role'] != 'member') {
						?>
						<a href="<?= HOST; ?>/deleteComment/<?= $_GET['parameter']; ?>/<?= $_GET['page']; ?>/<?= $comment->getId(); ?>">Supprimer le commentaire</a>
						<?php
					}
					?>
				</div>
				<div class="footer pl-3 pb-3">
					<button onclick="addRemoveAgree(<?= $comment->getId(); ?>, 'agree')"><img src="<?= HOST; ?>/public/thumbUp.svg" alt="pouce pointant vers le haut" class="img-fluid" /></button> : <span id="agreeComments<?= $comment->getId(); ?>"></span>
					<button onclick="addRemoveDisagree(<?= $comment->getId(); ?>, 'disagree')"><img src="<?= HOST; ?>/public/thumbDown.svg" alt="pouce pointant vers le bas" class="img-fluid" /></button> : <span id="disagreeComments<?= $comment->getId(); ?>"></span>
				</div>
			</div>
			<?php
		}
		?>
		<nav class="container-fluid pb-3">
			<ul class="pagination justify-content-center">
				<li class="page-item <?= ($currentPage == 1) ? "disabled" : ""; ?>"><a class="page-link" href="<?= HOST; ?>/postAndComments/<?= $_GET['parameter']; ?>/<?= $currentPage - 1; ?>">&laquo;</a></li>
				<?php
				for ($page = 1; $page <= $allPages; $page++) {
					?>
					<li class="page-item <?php ($currentPage == $page) ? "active" : ""; ?>"><a class="page-link" href="<?= HOST; ?>/postAndComments/<?= $_GET['parameter']; ?>/<?= $page; ?>"><?= $page; ?></a></li>
					<?php
				}
				?>
				<li class="page-item <?= ($currentPage == $allPages) ? "disabled" : ""; ?>"><a class="page-link" href="<?= HOST; ?>/postAndComments/<?= $_GET['parameter']; ?>/<?= $currentPage + 1; ?>">&raquo;</a></li>
			</ul>
		</nav>
	</section>
	<?php
}
?>
<script>
	let host = "<?= HOST; ?>";
	let parameter = <?= $_GET['parameter']; ?>;
	let page = <?= $_GET['page']; ?>;
	let commentsId = <?= $commentsId; ?>;
</script>
<script src="<?= HOST; ?>/assets/js/administration.js"></script>
<script src="<?= HOST; ?>/assets/js/displayForm.js"></script>
<script src="<?= HOST; ?>/assets/js/votes.js"></script>
