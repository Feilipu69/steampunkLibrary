function role(subscriberId){
	fetch(`${host}/getRole/${subscriberId}`)
	.then(response => response.json())
		.then(data => {
			if (data.role === 'member') {
				moderator(`${subscriberId}`)
			} else {
				member(`${subscriberId}`)
			}
		})
}

function moderator(subscriberId){
	fetch(`${host}/moderator/${subscriberId}`)
		.then(response => {
			document.getElementById(`memberRole${subscriberId}`).textContent = 'moderator';
		})
}

function member(subscriberId){
	fetch(`${host}/member/${subscriberId}`)
		.then(response => {
			document.getElementById(`memberRole${subscriberId}`).textContent = 'member';
		})
}
