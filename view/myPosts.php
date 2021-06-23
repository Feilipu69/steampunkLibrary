<div class="mySubjects container">
	<?php
	if (isset($myPosts)) {
		?>
		<h2>Mes Sujets</h2>
		<?php
		foreach ($myPosts as $posts) {
			?>
			<article class="container border shadow p-5">
				<h2><?= strip_tags($posts->getTitle()); ?></h2>
				<p>Sujet : <?= strip_tags($posts->getPost()); ?></p>
				<p class="content"><?= strip_tags($posts->getcontent()); ?></p>
				<em>Publié le : <?= $posts->getDate(); ?> </em>
				<br>
				<div class="mt-3">
					<button onclick="window.location.href='<?= HOST; ?>/updatePost/<?=$posts->getId(); ?>';">Modifier</button> 
					<button onclick="window.location.href='<?= HOST; ?>/deletePost/<?= $posts->getId(); ?>';" class="text-danger">Supprimer</button> 
				</div>
			</article>
			<?php
		}
	}

	if (isset($myOpinions)) {
		?>
		<div>
			<h2 class="mt-5">Mes commentaires</h2>
			<?php
			foreach ($myOpinions as $opinion) {
				?>
				<article class="container border shadow p-4 mt-3">
					<p>Sujet : <span class="titleOfTopic"><?= $opinion->getTitle(); ?></span></p>
					<p>Le <?= $opinion->getDateOfComment(); ?>, vous avez écrit :</p>
					<p class="comment"><?= strip_tags($opinion->getComment()); ?></p>
					<button onclick="window.location.href='<?= HOST; ?>/updateMyOpinion/<?= $opinion->getId(); ?>';">Modifier</button> 
					<button onclick="window.location.href='<?= HOST; ?>/deleteMyOpinion/<?= $opinion->getId(); ?>';" class="text-danger">Supprimer</button> 
				</article>
				<?php
			}
			?>
		</div>
		<?php
	}
	?>
</div>
