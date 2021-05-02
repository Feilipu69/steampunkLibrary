<p><a href="<?= HOST; ?>/books">Retour</a></p>
<?php
if (isset($_GET['parameter'])) {
	?>
	<script>let isbn = <?= $_GET['parameter'] ?></script>
	<script src="../assets/js/getOneBook.js"></script>
	<?php
}
?>
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>

