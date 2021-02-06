async function livres(){
	for (book of isbn) {
		let div = document.createElement("div");
		div.setAttribute("id", book);
		let para = document.createElement("p");
		let img = document.createElement("img");
		await fetch("https://www.googleapis.com/books/v1/volumes?q=" + book)
			.then((response) => response.json())
			.then((data) => {
				para.textContent = data.items[0].volumeInfo.title;
				img.src = data.items[0].volumeInfo.imageLinks.thumbnail;
				img.alt = "couverture " + data.items[0].volumeInfo.title;
				document.body.appendChild(div);
				div.appendChild(para);
				div.appendChild(img);
			})
			.catch((error) => console.log("Erreur " + error));
	}
}

livres();

