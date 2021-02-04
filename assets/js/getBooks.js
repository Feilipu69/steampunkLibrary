let isbn = ["2354083181", "235408322X", "2354083254", "2371021369", "2371021350"];

async function livres(){
	for (book of isbn) {
		let div = document.createElement("div");
		div.setAttribute("id", book);
		let img = document.createElement("img");
		await fetch("https://www.googleapis.com/books/v1/volumes?q=" + book)
			.then((response) => response.json())
			.then((data) => {
				div.textContent = data.items[0].volumeInfo.title;
				img.src = data.items[0].volumeInfo.imageLinks.thumbnail;
				img.alt = "couverture " + data.items[0].volumeInfo.title;
				document.body.appendChild(div);
				document.body.appendChild(img);
			})
			.catch((error) => console.log("Erreur " + error));
	}
}

livres();

