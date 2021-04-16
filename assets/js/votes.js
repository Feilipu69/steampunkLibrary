// Affichage de la page
function getAllVotes(opinionId){
	fetch(`${host}/getAllVotes/${opinionId}`)
		.then(response => response.json())
		.then(data => {
			let agreeOpinions = 0;
			let disagreeOpinions = 0;
			for(vote of data){
				if (vote.agree != 0) {
					agreeOpinions = agreeOpinions + 1;
				} 
				if (vote.disagree != 0) {
					disagreeOpinions = disagreeOpinions + 1;
				} 
			}
			document.getElementById(`agreeOpinions${opinionId}`).textContent = agreeOpinions;
			document.getElementById(`disagreeOpinions${opinionId}`).textContent = disagreeOpinions;
		})
		.catch(error => console.log(`Erreur : ${error}`));
}

if (opinionsId != null) {
	for(id of opinionsId){
		getAllVotes(id);
	}
}

// Modification des votes par l'utilisateur
function addRemoveAgree(opinionId){
	fetch(`${host}/addRemoveAgree/${opinionId}/agree`)
		.then(response => {
			getAllVotes(`${opinionId}`);
		})
		.catch(error => console.log(`Erreur : ${error}`));
}

function addRemoveDisagree(opinionId){
	fetch(`${host}/addRemoveDisagree/${opinionId}/disagree`)
		.then(response => {
			getAllVotes(`${opinionId}`);
		})
		.catch(error => console.log(`Erreur : ${error}`));
}
