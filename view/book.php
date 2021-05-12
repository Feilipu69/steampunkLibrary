<p class="container"><a href="<?= HOST; ?>/books">Bibliothèque</a></p>
<?php
if (isset($_GET['parameter'])) {
	?>
	<div id="isbn" class="container d-md-flex justify-content-around">
		<div class="mr-md-5 mt-md-3">
			<div id="image"></div>
			<p id="publisher"></p>
			<p id="date"></p>
		</div>
		<div>
			<div class="ml-md-5 mt-md-3">
				<p id="title"></p>
				<p id="author"></p>
				<p class="mt-2 p-3 border rounded shadow" id="bookDescription"></p>
			</div>
		</div>
	</div>
	<script>let isbn = <?= $_GET['parameter'] ?></script>
	<script src="../assets/js/getOneBook.js"></script>
	<?php
}
?>
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>

