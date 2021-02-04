<!DOCTYPE html>
<html>
	<head>
		<title>Bibliothèque à vapeur</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<h1>Bibliothèque à vapeur</h1>
		<?php
		$isbn = ["2354083181", "235408322X", "2354083254", "2371021369", "2371021350"];
		?>
		<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
		<script>
			let isbn = <?= json_encode($isbn); ?>;
		</script>
		<script src="assets/js/getBooks.js"></script>
	</body>
</html>
