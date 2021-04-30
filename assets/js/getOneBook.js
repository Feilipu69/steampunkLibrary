let div = document.createElement("div");
div.setAttribute("id", isbn);
div.setAttribute("class", "container");
let titleElement = document.createElement("p");
let img = document.createElement("img");
let authorElement = document.createElement("p");
let publisherElement = document.createElement("p");
let publishedDateElement = document.createElement("p");
let descriptionElement = document.createElement("p");
descriptionElement.setAttribute("id", "description");
fetch("https://www.googleapis.com/books/v1/volumes?q=" + isbn)
	.then((response) => response.json())
	.then((data) => {
		titleElement.textContent = data.items[0].volumeInfo.title;
		authorElement.textContent = data.items[0].volumeInfo.authors;
		publisherElement.textcontent = data.items[0].volumeInfo.publisher;
		publishedDateElement.textContent = data.items[0].volumeInfo.publishedDate;
		img.src = data.items[0].volumeInfo.imageLinks.thumbnail;
		img.alt = "couverture " + data.items[0].volumeInfo.title;
		descriptionElement.textContent = data.items[0].volumeInfo.description;
		descriptionElement.style.fontFamily = "ubunut";
		descriptionElement.style.fontSize = "20px";
		document.body.appendChild(div);
		div.appendChild(titleElement);
		div.appendChild(authorElement);
		div.appendChild(publisherElement);
		div.appendChild(publishedDateElement);
		div.appendChild(img);
		div.appendChild(descriptionElement);
	})
	.catch((error) => console.log("Erreur " + error));

