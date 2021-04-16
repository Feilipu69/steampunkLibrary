<h3>Administration</h3>
<h3>Nouveau livre</h3>
<form method="post" action="<?= HOST; ?>/addABook">
	<label for="isbn">Isbn</label>
	<input type="text" name="isbn" />
	<input type="submit" name="addABook" value="Envoyer" />
</form>
<?php
foreach ($allSubscribers as $subscribers) {
	?>
	<ul>
		<li><?= strip_tags($subscribers->getLogin()); ?> <?= $subscribers->getRole(); ?> 
		<?php
		if ($subscribers->getRole() != "admin") {
			if ($subscribers->getRole() === 'membre') {
				?>
				<a href="<?= HOST; ?>/moderator/<?= $subscribers->getId(); ?>">Moderateur</a>
				<?php
			}
			else {
				?>
				<a href="<?= HOST; ?>/member/<?= $subscribers->getId(); ?>">Membre</a>
				<?php
			}
			?>
			<a href="<?= HOST; ?>/deleteMember/<?= $subscribers->getId(); ?>">Supprimer le membre</a></li>
			<?php
		}
		?>
	</ul>
	<?php
}
?>
