async function livres() {
	for (isbn of catalogue) {
		await fetch(
			"https://www.googleapis.com/books/v1/volumes?q=isbn:" +
			isbn +
			"&key=AIzaSyC1hAZvGpAI8cZHMhvlLHW-Kj7mOD7wjKc"
		)
			.then((response) => response.json())
			.then((data) => {
				document.getElementById("cardHeader" + isbn).textContent =
					data.items[0].volumeInfo.title;
				document.getElementById("cardBody" + isbn).innerHTML =
					"<a href=" +
					`${host}/book/${isbn}` +
					"><img src=" +
					data.items[0].volumeInfo.imageLinks.thumbnail +
					" alt = 'couverture '" +
					data.items[0].volumeInfo.title +
					" /></a>";
			})
			.catch((error) => console.log(`Erreur : ${error}`));
	}
}

livres();
