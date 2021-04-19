<h3>Administration</h3>
<h3>Nouveau livre</h3>
<form method="post" action="<?= HOST; ?>/addABook">
	<label for="isbn">Isbn</label>
	<input type="text" name="isbn" />
	<input type="submit" name="addABook" value="Envoyer" />
</form>
<?php
foreach ($allSubscribers as $subscribers) {
	$subscribersId[] = $subscribers->getId();
	?>
	<ul>
		<li><?= strip_tags($subscribers->getLogin()); ?> <?= $subscribers->getRole(); ?> 
		<?php
		if ($subscribers->getRole() != "admin") {
			if ($subscribers->getRole() === 'member') {
				?>
				<button onclick="moderator(<?= $subscribers->getId(); ?>)"><span id="moderator<?= $subscribers->getId(); ?>"></span></button>
				<?php
			}
			else {
				?>
				<button onclick="member(<?= $subscribers->getId(); ?>)"><span id="member<?= $subscribers->getId(); ?>"></span></button>
				<?php
			}
			?>
			<a href="<?= HOST; ?>/deleteMember/<?= $subscribers->getId(); ?>">Supprimer le membre</a>
			<?php
		}
		?>
	</li>
</ul>
	<?php
}
?>
<script>
	let host = "<?= HOST; ?>";
	let subscribersId = <?= json_encode($subscribersId); ?>;
</script>
<script src="<?= HOST; ?>/assets/js/getRole.js"></script>
