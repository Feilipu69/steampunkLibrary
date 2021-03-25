function agree(value){
	fetch(`${host}/addRemoveAgree/${value}/${page}`)
	.then(response => console.log(response))
}

function disagree(value){
	fetch(`${host}/addRemoveDisagree/${value}/${page}`)
	.then(response => console.log(response))
}

