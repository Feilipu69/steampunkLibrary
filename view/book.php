<?php
if (isset($opinion)) {
	foreach($opinion as $opinions){
		?>
		<p><?= $opinions->getComment(); ?></p>
		<?php
	}
}
?>
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
<script>let isbn = <?= $_GET['isbn'] ?></script>
<script src="assets/js/getABook.js"></script>

