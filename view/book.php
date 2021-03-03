<?php
if (isset($opinion)) {
	foreach($opinion as $opinions){
		?>
		<p><?= strip_tags($opinions->getComment()); ?></p>
		<?php
	}
}
?>
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
<?php
if (isset($_GET['parameter'])) {
	?>
	<script>let isbn = <?= $_GET['parameter'] ?></script>
	<script src="../assets/js/getABook.js"></script>
	<?php
}
?>

