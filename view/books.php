<h3 class="container">Bibliothèque</h3>
<div class="container row justify-content-center mt-5">
	<?php
	foreach ($books as $book) {
		?>
		<div class="card-deck col-lg-4 text-center">
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
<nav class="container-fluid pb-3">
	<ul class="pagination justify-content-center">
		<li class="page-item <?= ($currentPage == 1) ? "disabled" : ""; ?>"><a class="page-link" href="<?= HOST; ?>/books?page=<?= $currentPage - 1; ?>">Précédente</a></li>
		<?php
		for ($page = 1; $page <= $allPages; $page++) {
			?>
			<li class="page-item <?php ($currentPage == $page) ? "active" : ""; ?>"><a class="page-link" href="<?= HOST; ?>/books?page=<?= $page; ?>"><?= $page; ?></a></li>
			<?php
		}
		?>
		<li class="page-item <?= ($currentPage == $allPages) ? "disabled" : ""; ?>"><a class="page-link" href="<?= HOST; ?>/books?page=<?= $currentPage + 1; ?>">Suivante</a></li>
	</ul>
</nav>
<script src="https://www.google.com/books/jsapi.js"></script>
<script>
	let host = "<?= HOST; ?>";
	let catalogue = <?= json_encode($list); ?>;
</script>
<script src="assets/js/getBooks.js"></script>
