<h3>Administration</h3>
<a href="<?= HOST; ?>/addABook">Nouveau livre</a>
<?php
foreach ($allSubscribers as $subscribers) {
	?>
	<ul>
		<li><?= $subscribers->getLogin(); ?> <?= $subscribers->getRole(); ?> 
		<?php
		if ($subscribers->getRole() != "admin") {
			if ($subscribers->getRole() === 'membre') {
				?>
				<a href="<?= HOST; ?>/moderator/<?= $subscribers->getId(); ?>">Moderateur</a></li>
				<?php
			}
			else {
				?>
				<a href="<?= HOST; ?>/member/<?= $subscribers->getId(); ?>">Membre</a></li>
				<?php
			}
			?>
			<a href="<?= HOST; ?>/deleteMember/<?= $subscribers->getId(); ?>">Supprimer le membre</a>
			<?php
		}
		?>
	</ul>
	<?php
}
?>
