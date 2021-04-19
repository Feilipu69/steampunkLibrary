function getRole(subscriberId){
	fetch(`${host}/getRole/${subscriberId}`)
		.then(response => response.json())
		.then(data => {
			if (document.getElementById(`member${subscriberId}`) != null && data.role === 'moderator') {
				document.getElementById(`member${subscriberId}`).textContent = 'member';
			} else if (document.getElementById(`moderator${subscriberId}`) != null && data.role === 'member') {
				document.getElementById(`moderator${subscriberId}`).textContent = 'moderator';
			}
		})
		.catch(error => console.log(error));
}

for(subscriberId of subscribersId){
	getRole(subscriberId);
}

function moderator(id){
	fetch(`${host}/moderator/${id}`)
		.then(response => {
			getRole(id);
		})
		.catch(error => console.log(error));
}

function member(id){
	fetch(`${host}/member/${id}`)
		.then(response => {
			getRole(id);
		})
		.catch(error => console.log(error));
}
