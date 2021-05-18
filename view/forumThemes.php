<?php
if (isset($_GET['parameter'])) {
	?>
	<div class="container">
		<h2><?= $_GET['parameter']; ?></h2>
		<a href="<?= HOST; ?>/forum">Retour</a>
		<h3><a href="<?= HOST; ?>/addForumTheme/<?= $_GET['parameter']; ?>">Nouveau sujet</a></h3>
	</div>
	<?php
}
if (isset($getSubject)) {
	foreach ($getSubject as $subject) {
		?>
		<div class="d-flex justify-content-between">
			<img src="<?= HOST; ?>/public/smallGear.png" alt="rouage" />
			<img src="<?= HOST; ?>/public/smallGear.png" alt="rouage" />
		</div>
		<div class="border-top border-bottom border-warning pt-3">
			<div class="ml-md-5">
				<div>
					<img src="<?= HOST; ?>/public/index-finger.png" alt="index" />
					<h3 class="d-inline"><a href="<?= HOST ; ?>/subjectAndComments/<?= $subject->getId(); ?>/1"> <?= strip_tags($subject->getTitle()); ?></a></h3>
				</div>
				<em>publié le : <?= $subject->getDate(); ?> par <?= strip_tags($subject->getLoginSubscriber()); ?></em>
				<p class="content"><?= strip_tags($subject->getContent()); ?></p>
				<?php
				if (isset($_SESSION['role']) && ($_SESSION['role'] != 'member')) {
					?>
					<p><a id="deleteSubject" href="<?= HOST; ?>/deleteSubject/<?= $subject->getId(); ?>">Supprimer le sujet</a></p>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>
