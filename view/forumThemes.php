<h2><?= $_GET['parameter']; ?></h2>
<h3><a href="<?= HOST; ?>/forumFormular">Nouveau sujet</a></h3>
<?php
if (isset($getSubject)) {
	foreach ($getSubject as $subject) {
		?>
		<h4><a href="<?= HOST ; ?>/subjectAndComments/<?= $subject->getId(); ?>"><?= $subject->getTitle(); ?></a></h4>
		<em>publié le : <?= $subject->getDate(); ?> par <?= $subject->getLoginSubscriber(); ?></em>
		<?php
	}
}
?>
