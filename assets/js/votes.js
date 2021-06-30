// Display the page
// Affichage de la page
function getAllVotes(commentId) {
	fetch(`${host}/getAllVotes/${commentId}`)
		.then(response => response.json())
		.then(data => {
			let agreeComments = 0;
			let disagreeComments = 0;
			for (vote of data) {
				if (vote.agree != 0) { // si il y a l'id du membre dans le champ agree
					agreeComments = agreeComments + 1;
				}
				if (vote.disagree != 0) { // si il y a l'id du membre dans le champ disagree
					disagreeComments = disagreeComments + 1;
				}
			}
			document.getElementById(`agreeComments${commentId}`).textContent = agreeComments;
			document.getElementById(`disagreeComments${commentId}`).textContent = disagreeComments;
		})
		.catch(error => console.log(`Erreur : ${error}`));
}

if (commentsId != null) {
	for (id of commentsId) {
		getAllVotes(id);
	}
}

// Update votes by the member
// Modification des votes par l'utilisateur
function addRemoveAgree(commentId) {
	fetch(`${host}/addRemoveAgree/${commentId}/agree`)
		.then((response) => {
			getAllVotes(`${commentId}`);
		})
		.catch(error => console.log(`Erreur : ${error}`));
}

function addRemoveDisagree(commentId) {
	fetch(`${host}/addRemoveDisagree/${commentId}/disagree`)
		.then(response => {
			getAllVotes(`${commentId}`);
		})
		.catch(error => console.log(`Erreur : ${error}`));
}
