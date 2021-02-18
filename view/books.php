<?php
foreach ($catalogue as $book) {
	$list[] = $book->getIsbn();
}
?>
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
<script>
	let host = "<?= HOST; ?>";
</script>

<script>
	let catalogue = <?= json_encode($list); ?>;
</script>
<script src="assets/js/getBooks.js"></script>
