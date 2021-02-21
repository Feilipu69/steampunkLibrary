<?php
foreach ($messagesDesLeviathans as $messages) {
	?>
	<p> le <?= $messages->getDate(); ?> a été reçu ce message : </p>
	<p><?= $messages->getTitle(); ?></p>
	<p><?= $messages->getMessage(); ?></p>
	<?php
}
