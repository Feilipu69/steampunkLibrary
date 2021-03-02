<form method="post" action="<?= HOST; ?>/addForumTheme">
	<label for="subject">Sujet du forum</label>
	<input type="text" name="subject" id="subject" />
	<br>
	<label for="title">Titre</label>
	<input type="text" name="title" id="title" />
	<br>
	<label for="content">Contenu</label>
	<textarea name="content"></textarea>
	<br>
	<input type="submit" name="send" value="Envoyer" />
</form>
