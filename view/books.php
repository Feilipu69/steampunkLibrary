<?php
$isbn = ["2354083181", "235408322X", "2354083254", "2371021369", "2371021350", "2371021342"];
?>
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
<script>
	let isbn = <?= json_encode($isbn); ?>;
</script>
<script src="assets/js/getBooks.js"></script>
