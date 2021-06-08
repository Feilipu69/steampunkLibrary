<?php
if (isset($myPosts)) {
	foreach ($myPosts as $posts) {
		?>
		<div class="container border shadow p-5">
			<h3><?= strip_tags($posts->getTitle()); ?></h3>
			<p>Sujet : <?= strip_tags($posts->getPost()); ?></p>
			<p class="content"><?= strip_tags($posts->getcontent()); ?></p>
			<em>Publié le : <?= $posts->getDate(); ?> </em>
			<br>
			<div class="mt-3">
			<button onclick="window.location.href='<?= HOST; ?>/updatePost/<?=$posts->getId(); ?>';">Modifier</button> 
			<button onclick="window.location.href='<?= HOST; ?>/deletePost/<?= $posts->getId(); ?>';" class="text-danger">Supprimer</button> 
			</div>
		</div>
		<?php
	}
}
