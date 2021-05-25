<h3 class="container">Administration</h3>
<div class="section mb-5">
	<img src="<?= HOST; ?>/public/steampunk-border-2.png" alt="bordure" class="border1 img-fluid" />
	<div class="mt-3 mb-5">
		<h3>Nouveau livre</h3>
		<form method="post" action="<?= HOST; ?>/addOneBook">
			<div class="form-group">
				<label for="isbn">Isbn</label>
				<input type="text" name="isbn" id="isbn" />
				<input type="submit" name="addOneBook" value="Envoyer" />
			</div>
		</form>
	</div>
	<img src="<?= HOST; ?>/public/steampunk-border-2.png" alt="bordure" class="border2 img-fluid" />
</div>
<h3>Gestion des membres</h3>
<div class="container d-md-flex justify-content-around">
	<div>
		<table class="table table-borderless table-responsive mt-4">
			<thead>
				<tr>
					<th>Login</th>
					<th>Rôle</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($allSubscribers as $subscribers) {
				if ($subscribers->getRole() != 'admin') {
					?>
					<tr>
						<td id="member<?= $subscribers->getId(); ?>"><?= $subscribers->getLogin(); ?></td>
						<td id="memberRole<?= $subscribers->getId(); ?>"><?= $subscribers->getRole(); ?></td>
						<td><button id="role" onclick="role(<?= $subscribers->getId(); ?>)">Changer</button></td>
						<td><button onclick="deleteMember(<?= $subscribers->getId(); ?>)">Supprimer</button></td>
					</tr>
					<?php
				}
			}
			?>
			</tbody>
		</table>
	</div>
	<div class="mr-5">
		<img src="<?= HOST; ?>/public/retro-bicycle.png" alt="vélo rétro" />
	</div>
</div>
<script>
	let host = '<?= HOST; ?>';
</script>
<script src="<?= HOST; ?>/assets/js/administration.js"></script>
