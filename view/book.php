<a href="<?= HOST; ?>/books">Retour</a>
<?php
if (isset($_GET['parameter'])) {
	?>
	<script>let isbn = <?= $_GET['parameter'] ?></script>
	<script src="../assets/js/getABook.js"></script>
	<?php
}
?>
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>

