<?php
if (isset($mySubjects)) {
	foreach ($mySubjects as $subjects) {
		?>
		<div class="container border shadow p-5">
			<h3><?= strip_tags($subjects->getTitle()); ?></h3>
			<p>Sujet : <?= strip_tags($subjects->getSubject()); ?></p>
			<p class="content"><?= strip_tags($subjects->getcontent()); ?></p>
			<em>Publié le : <?= $subjects->getDate(); ?> </em>
			<br>
			<button onclick="window.location.href='<?= HOST; ?>/updateSubject/<?=$subjects->getId(); ?>';">Modifier</button> 
			<button onclick="window.location.href='<?= HOST; ?>/deleteSubject/<?= $subjects->getId(); ?>';">Supprimer</button> 
		</div>
		<?php
	}
}
