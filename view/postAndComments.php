<div class="container">
	<div class="marble border border-muted rounded shadow p-3 mb-3">
		<h3><?= strip_tags($postData->getTitle()); ?></h3>
		<em>Publié par <?= strip_tags($postData->getLoginSubscriber()); ?> le <?= $postData->getDate(); ?></em>
		<p class="content"><?= strip_tags($postData->getContent()); ?></p>
	</div>
</div>

<?php
if (isset($_GET['parameter']) && isset($_GET['page']) && isset($_SESSION['login'])) {
	?>
	<div class="container">
		<button onclick="displayForm()" class="displayForm">Ajouter un commentaire</button>
		<form method="post" action="<?= HOST; ?>/postAndComments/<?= $_GET['parameter']; ?>/<?= $_GET['page']; ?>" id="displayForm" style="display:none" class="mt-4">
			<div class="form-goup">
				<label for="login">Pseudo : </label>
				<input type="text" name="login" id="login" value="<?= $_SESSION['login']; ?>" />
			</div>
			<div class="form-group">
				<textarea name="comment"></textarea>
			</div>
			<input type="submit" name="send" id="send" value="Envoyer" />
			<button onclick="window.location.href="<?= HOST; ?>/postAndComments/<?= $_GET['parameter']; ?>/<?= $_GET['page']; ?>";">Annuler</button>
		</form>
	</div>
	<?php
}
if (isset($opinions)) {
	?>
	<div class="container mt-5">
		<h3>Commentaires</h3>
		<?php
		foreach ($opinions as $opinion) {
			?>
			<div class="card mb-3">
				<div class="card-header">
					<p><strong><?= strip_tags($opinion->getLogin()); ?></strong> a écrit : </p>
				</div>
				<div class="card-body">
					<div class="content mb-3"><?= strip_tags($opinion->getComment()); ?></div>
					<?php
					if (isset($_SESSION['role']) && $_SESSION['role'] != 'member') {
						?>
						<a href="<?= HOST; ?>/deleteOpinion/<?= $_GET['parameter']; ?>/<?= $_GET['page']; ?>/<?= $opinion->getId(); ?>">Supprimer le commentaire</a>
						<?php
					}
					?>
				</div>
				<div class="footer pl-3 pb-3">
					<button onclick="addRemoveAgree(<?= $opinion->getId(); ?>, 'agree')"><img src="<?= HOST; ?>/public/thumbUp.svg" alt="pouce pointant vers le haut" /></button> : <span id="agreeOpinions<?= $opinion->getId(); ?>"></span>
					<button onclick="addRemoveDisagree(<?= $opinion->getId(); ?>, 'disagree')"><img src="<?= HOST; ?>/public/thumbDown.svg" alt="pouce pointant vers le bas" /></button> : <span id="disagreeOpinions<?= $opinion->getId(); ?>"></span>
				</div>
			</div>
			<?php
		}
		?>
		<nav class="container-fluid pb-3">
			<ul class="pagination justify-content-center">
				<li class="page-item <?= ($currentPage == 1) ? "disabled" : ""; ?>"><a class="page-link" href="<?= HOST; ?>/subjectAndComments/<?= $_GET['parameter']; ?>/<?= $currentPage - 1; ?>">&laquo;</a></li>
				<?php
				for ($page = 1; $page <= $allPages; $page++) {
					?>
					<li class="page-item <?php ($currentPage == $page) ? "active" : ""; ?>"><a class="page-link" href="<?= HOST; ?>/subjectAndComments/<?= $_GET['parameter']; ?>/<?= $page; ?>"><?= $page; ?></a></li>
					<?php
				}
				?>
				<li class="page-item <?= ($currentPage == $allPages) ? "disabled" : ""; ?>"><a class="page-link" href="<?= HOST; ?>/subjectAndComments/<?= $_GET['parameter']; ?>/<?= $currentPage + 1; ?>">&raquo;</a></li>
			</ul>
		</nav>
	</div>
	<?php
}
?>
<script>
	let host = "<?= HOST; ?>";
	let parameter = <?= $_GET['parameter']; ?>;
	let page = <?= $_GET['page']; ?>;
	let opinionsId = <?= $opinionsId; ?>;
</script>
<script src="<?= HOST; ?>/assets/js/administration.js"></script>
<script src="<?= HOST; ?>/assets/js/displayForm.js"></script>
<script src="<?= HOST; ?>/assets/js/votes.js"></script>
