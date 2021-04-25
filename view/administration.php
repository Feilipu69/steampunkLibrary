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
		<?php
		if ($subscribers->getRole() != 'admin') {
			?>
			<li>
				<?= $subscribers->getLogin();?> : <span id="memberRole<?= $subscribers->getId(); ?>"><?= $subscribers->getRole(); ?></span> <button id="role" onclick="role(<?= $subscribers->getId(); ?>)">Modifier le rôle</button>
			</li>
			<?php
		}
		?>
	</ul>
	<?php
}
?>
<script>
	let host = '<?= HOST; ?>';
</script>
<script src="<?= HOST; ?>/assets/js/administration.js"></script>
