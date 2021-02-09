<?php
$isbn = $_GET['isbn']; 
?>
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
<script>let isbn = <?= $isbn ?></script>
<script src="assets/js/getABook.js"></script>
