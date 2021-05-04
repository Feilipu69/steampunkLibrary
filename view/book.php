<p class="container"><a href="<?= HOST; ?>/books">Retour</a></p>
<?php
if (isset($_GET['parameter'])) {
	?>
	<div id="isbn" class="container">
		<div class="d-flex">
			<div class="mr-5">
				<p id="title"></p>
				<p id="publisher"></p>
			</div>
			<div>
				<p id="author"></p>
				<p id="date"></p>
			</div>
		</div>
		<div id="image"></div>
		<p id="bookDescription"></p>
	</div>
	<script>let isbn = <?= $_GET['parameter'] ?></script>
	<script src="../assets/js/getOneBook.js"></script>
	<?php
}
?>
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>

