function allVotes(votes){
	let allAgree = 0;
	let allDisagree = 0;
	fetch(`${host}/getAllVotes/${votes}`)
		.then(response => response.json())
		.then(data => {
			for(votesAgree of data){
				if (data[0].agree != 0) {
					allAgree = allAgree + (votesAgree.agree.length);
				}
			}
			document.getElementById(`agreeOpinions${votes}`).textContent = allAgree;

			for(votesDisagree of data){
				if (data[0].disagree != 0) {
					allDisagree = allDisagree + (votesDisagree.disagree.length);
				}
			}
			document.getElementById(`disagreeOpinions${votes}`).textContent = allDisagree;
		})
}

for(opinionId of opinionsId){
	allVotes(opinionId);
}

function addRemoveAgree(opinionId){
	fetch(`${host}/addRemoveAgree/${opinionId}/${page}`)
		.then(response => {
			for(opinionId of opinionsId){
				allVotes(opinionId);
			}
		})
}

function addRemoveDisagree(opinionId){
	fetch(`${host}/addRemoveDisagree/${opinionId}/${page}`)
		.then(response => {
			for(opinionId of opinionsId){
				allVotes(opinionId);
			}
		})
}
