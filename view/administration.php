<div class="container">
	<h3>Administration</h3>
	<div class="steampunk-border"><img src="<?= HOST; ?>/public/steampunk-border-2.png" alt="bordure" class="steampunk-border-2 d-none d-lg-block mb-5" /></div>
	<div class="steampunk-border"><img src="<?= HOST; ?>/public/medium-steampunk-border-2.png" alt="bordure" class="steampunk-border-2 d-none d-md-block d-lg-none mb-5" /></div>
	<div class="steampunk-border"><img src="<?= HOST; ?>/public/small-steampunk-border-2.png" alt="Petite bordure" class="small-steampunk-border-2 d-md-none d-lg-none" /></div>
	<div class="d-flex-colum">
		<div>
			<h3>Nouveau livre</h3>
			<form method="post" action="<?= HOST; ?>/addOneBook">
				<div class="form-group">
					<label for="isbn">Isbn</label>
					<input type="text" name="isbn" />
					<input type="submit" name="addOneBook" value="Envoyer" />
				</div>
			</form>
		</div>
		<div class="steampunk-border"><img src="<?= HOST; ?>/public/steampunk-border-2.png" alt="bordure" class="steampunk-border-2 d-none d-lg-block mt-5" /></div>
		<div class="steampunk-border"><img src="<?= HOST; ?>/public/medium-steampunk-border-2.png" alt="bordure" class="steampunk-border-2 d-none d-md-block d-lg-none" /></div>
		<div class="steampunk-border"><img src="<?= HOST; ?>/public/small-steampunk-border-2.png" alt="Petite bordure" class="small-steampunk-border-2 d-md-none d-lg-none" /></div>
		<div>
			<h3>Gestion des membres</h3>
			<div class="container d-md-flex justify-content-between">
				<div>
					<?php
					foreach ($allSubscribers as $subscribers) {
						?>
						<ul id="administration">
							<?php
							if ($subscribers->getRole() != 'admin') {
								?>
								<li id="member<?= $subscribers->getId(); ?>">
									<?= $subscribers->getLogin();?> : <span id="memberRole<?= $subscribers->getId(); ?>"><?= $subscribers->getRole(); ?></span> <button id="role" onclick="role(<?= $subscribers->getId(); ?>)">Modifier le rôle</button> <button onclick="deleteMember(<?= $subscribers->getId(); ?>)">Supprimer</button> 
								</li>
								<?php
							}
							?>
						</ul>
						<?php
					}
					?>
				</div>
				<div class="mr-5">
					<img src="<?= HOST; ?>/public/retro-bicycle.png" alt="vélo rétro" />
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	let host = '<?= HOST; ?>';
</script>
<script src="<?= HOST; ?>/assets/js/administration.js"></script>
