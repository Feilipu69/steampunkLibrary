<?php
if (isset($_GET['parameter'])) {
	?>
	<h2><?= $_GET['parameter']; ?></h2>
	<a href="<?= HOST; ?>/forum">Retour</a>
	<h3><a href="<?= HOST; ?>/addForumTheme/<?= $_GET['parameter']; ?>">Nouveau sujet</a></h3>
	<?php
}
if (isset($getSubject)) {
	foreach ($getSubject as $subject) {
		?>
		<div class="d-flex justify-content-between">
			<img src="<?= HOST; ?>/public/gear.png" alt="rouage" />
			<img src="<?= HOST; ?>/public/gear.png" alt="rouage" />
		</div>
		<div class="border-top border-bottom border-warning mb-3 pt-3 pb-3">
			<div class="ml-md-5">
				<div>
					<img src="<?= HOST; ?>/public/index-finger.png" alt="index" />
					<h3 class="d-inline"><a href="<?= HOST ; ?>/subjectAndComments/<?= $subject->getId(); ?>/1"> <?= strip_tags($subject->getTitle()); ?></a></h3>
				</div>
				<em>publié le : <?= $subject->getDate(); ?> par <?= strip_tags($subject->getLoginSubscriber()); ?></em>
				<?php
				if (isset($_SESSION['role']) && ($_SESSION['role'] != 'member')) {
					?>
					<a href="<?= HOST; ?>/deleteSubject/<?= $subject->getId(); ?>">Supprimer le sujet</a>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>
