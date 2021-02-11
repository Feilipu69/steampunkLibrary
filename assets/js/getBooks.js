async function livres() {
  for (isbn of catalogue) {
    let div = document.createElement("div");
    div.setAttribute("id", isbn);
    let titleElement = document.createElement("p");
    let linkElement = document.createElement("a");
    let img = document.createElement("img");
    await fetch("https://www.googleapis.com/books/v1/volumes?q=" + isbn)
      .then((response) => response.json())
      .then((data) => {
        titleElement.textContent = data.items[0].volumeInfo.title;
        linkElement.href = `${host}/book/${isbn}`;
        img.src = data.items[0].volumeInfo.imageLinks.thumbnail;
        img.alt = "couverture " + data.items[0].volumeInfo.title;
        document.body.appendChild(div);
        div.appendChild(titleElement);
        div.appendChild(linkElement);
        linkElement.appendChild(img);
      })
      .catch((error) => console.log("Erreur " + error));
  }
}

livres();
