<?php
$catalogue = ["9782354083182", "9782354083229", "9782354083250", "9782371021365", "9782371021358", "9782371021341"];
?>
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
<script>
	let catalogue = <?= json_encode($catalogue); ?>;
</script>
<script src="assets/js/getBooks.js"></script>
