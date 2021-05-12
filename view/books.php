<h3>Bibliothèque</h3>
<div class="container row justify-content-center mt-5">
<?php
foreach ($catalogue as $book) {
	?>
	<div id="cardDeck" class="card-deck col-md-4 text-center">
		<div id="card<?= $book->getIsbn(); ?>" class="card mb-3">
			<div id="cardHeader<?= $book->getIsbn(); ?>" class="card-header"></div>
			<div id="cardBody<?= $book->getIsbn(); ?>" class="card-body"></div>
		</div>
	</div>
	<?php
	$list[] = $book->getIsbn();
}
?>
</div>
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
<script>
	let host = "<?= HOST; ?>";
</script>

<script>
	let catalogue = <?= json_encode($list); ?>;
</script>
<script src="assets/js/getBooks.js"></script>
