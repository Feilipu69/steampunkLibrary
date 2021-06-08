<?php
if (isset($_GET['parameter'])) {
	?>
	<div class="container mb-5">
		<h2><?= $_GET['parameter']; ?></h2>
		<p><a href="<?= HOST; ?>/forum">Retour</a></p>
		<button onclick="displayForm()" class="displayForm">Ajouter un sujet</button>

		<form method="post" action="<?= HOST; ?>/addForumPost/<?= $_GET['parameter']; ?>" id="displayForm" style="display:none" class="mt-4">
			<div class="form-group">
				<label for="title">Titre</label>
				<input type="text" name="title" id="title" />
			</div>
			<div class="form-goup">
				<label for="content">Contenu</label>
				<textarea name="content"></textarea>
			</div>
			<input type="submit" name="send" value="Envoyer" />
			<button onclick="window.location.href='<?= HOST; ?>/addForumPost';">Annuler</button>
		</form>
	</div>
	<script>
		let host = "<?= HOST; ?>";
		let theme = "<?= $_GET['parameter']; ?>";
	</script>
	<?php
}
?>
<?php
if (isset($getPost)) {
	foreach ($getPost as $post) {
		?>
		<div class="border rounded shadow mb-5">
			<div class="engrenages">
			</div>
			<div class="mt-3 ml-4">
				<div>
					<img src="<?= HOST; ?>/public/index-finger.png" alt="index" />
					<h3 class="d-inline"><a href="<?= HOST ; ?>/postAndComments/<?= $post->getId(); ?>/1"> <?= strip_tags($post->getTitle()); ?></a></h3>
				</div>
				<em>publié le : <?= $post->getDate(); ?> par <?= strip_tags($post->getLoginSubscriber()); ?></em>
				<div class="content mb-4"><?= strip_tags($post->getContent()); ?></div>
				<?php
				if (isset($_SESSION['role']) && ($_SESSION['role'] != 'member')) {
					?>
					<button onclick="deletePost(<?= $post->getId(); ?>)" class="mb-3">Supprimer le sujet</button>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
	?>
	<script>let id = <?= $post->getId(); ?>;</script>
	<?php
}
?>


<script src="<?= HOST; ?>/assets/js/administration.js"></script>
<script src="<?= HOST; ?>/assets/js/displayForm.js"></script>
