async function livres() {
	for(parameter of catalogue){
		await fetch("https://www.googleapis.com/books/v1/volumes?q=" + parameter)
			.then((response) => response.json())
			.then(data => {
				document.getElementById("cardHeader" + parameter).textContent = data.items[0].volumeInfo.title;
				document.getElementById("cardBody" + parameter).innerHTML = "<a href=" + `${host}/book/${parameter}` + "><img src=" + data.items[0].volumeInfo.imageLinks.thumbnail + " alt = 'couverture '" + data.items[0].volumeInfo.title + " /></a>";
			})
	}
}

livres();
