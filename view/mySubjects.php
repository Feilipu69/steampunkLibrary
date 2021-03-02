<?php
if (isset($mySubjects)) {
	foreach ($mySubjects as $subjects) {
		?>
		<h3><?= $subjects->getTitle(); ?></h3>
		<p><?= $subjects->getcontent(); ?></p>
		<em>Publié le : <?= $subjects->getDate(); ?> </em>
		<?php
	}
}
