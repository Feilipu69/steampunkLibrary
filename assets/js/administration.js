function role(subscriberId) {
  fetch(`${host}/getRole/${subscriberId}`)
    .then((response) => response.json())
    .then((data) => {
      if (data.role === "member") {
        moderator(`${subscriberId}`);
      } else {
        member(`${subscriberId}`);
      }
    })
    .catch((error) => console.log(`Erreur : ${error}`));
}

function moderator(subscriberId) {
  fetch(`${host}/moderator/${subscriberId}`)
    .then((response) => {
      document.getElementById(`memberRole${subscriberId}`).textContent =
        "moderator";
    })
    .catch((error) => console.log(`Erreur : ${error}`));
}

function member(subscriberId) {
  fetch(`${host}/member/${subscriberId}`)
    .then((response) => {
      document.getElementById(`memberRole${subscriberId}`).textContent =
        "member";
    })
    .catch((error) => console.log(`Erreur : ${error}`));
}

function deleteMember(subscriberId) {
  fetch(`${host}/deleteMember/${subscriberId}`)
    .then((response) => {
      document.getElementById(`member${subscriberId}`).style.display = "none";
    })
    .catch((error) => console.log(`Erreur : ${error}`));
}

function deletePost(id) {
  fetch(`${host}/deletePost/${id}`, {
    method: "DELETE",
  })
    .then(() => {
      window.location.reload();
    })
    .catch((error) => console.log(`Erreur : ${error}`));
}
