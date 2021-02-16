<?php
foreach ($catalogue as $book) {
	$truc[] = $book->getIsbn();
}
?>
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
<script>
	let host = "<?= HOST; ?>";
</script>

<script>
	let catalogue = <?= json_encode($truc); ?>;
</script>
<script src="assets/js/getBooks.js"></script>
