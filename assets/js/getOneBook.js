function book(isbn){
	fetch("https://www.googleapis.com/books/v1/volumes?q=" + isbn)
		.then(response => response.json())
		.then(data => {
			document.getElementById('title').textContent = data.items[0].volumeInfo.title;
			document.getElementById('author').textContent = data.items[0].volumeInfo.authors;
			document.getElementById('publisher').textContent = data.items[0].volumeInfo.publisher;
			document.getElementById('date').textContent = data.items[0].volumeInfo.publishedDate;
			document.getElementById('image').innerHTML = "<img src=" + data.items[0].volumeInfo.imageLinks.thumbnail + " alt= 'Couverture livre '" + data.items[0].volumeInfo.title + " />";
			document.getElementById('bookDescription').textContent = data.items[0].volumeInfo.description;
		})
		.catch(error => console.log("Erreur " + error));
}

book(isbn);
