<?php
if (isset($_GET['parameter'])) {
	?>
	<h2><?= $_GET['parameter']; ?></h2>
	<h3><a href="<?= HOST; ?>/addForumTheme/<?= $_GET['parameter']; ?>">Nouveau sujet</a></h3>
	<?php
}
if (isset($getSubject)) {
	foreach ($getSubject as $subject) {
		?>
		<h4><a href="<?= HOST ; ?>/subjectAndComments/<?= $subject->getId(); ?>"><?= strip_tags($subject->getTitle()); ?></a></h4>
		<em>publié le : <?= $subject->getDate(); ?> par <?= strip_tags($subject->getLoginSubscriber()); ?></em>
		<?php
	}
}
?>
