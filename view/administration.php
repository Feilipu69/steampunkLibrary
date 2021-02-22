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

<h3>Newsletter</h3>
<form method="post" action="<?= HOST; ?>/addMessageDesLeviathans">
	<label for='title'>Titre du Message : </label>
	<input type="text" name="title" id="title" />
	<br>
	<textarea name="message"></textarea>
	<br>
	<input type="submit" name="send" value="Envoyer" />
</form>
