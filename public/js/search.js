const search = document.querySelector('input[placeholder="Search"]');
const searchButton = document.querySelector('#search-button');
const clubsContainer = document.querySelector('.clubs-grid');

function handleSearch(data) {
    fetch("/search", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data),
    }).then(function (response) {
        return response.json();
    }).then(function (clubs) {
        clubsContainer.innerHTML = "";
        loadClubs(clubs)
    });
}

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        const data = {search: this.value};
        return handleSearch(data)
    }
});

searchButton.addEventListener('click', function (event) {
    const data = {search: search.value};
    return handleSearch(data);
});

function loadClubs(clubs) {
    clubs.forEach(club => {
        console.log(club);
        createClub(club);
    })
}

function createClub(club) {
    const template = document.querySelector("#club-template");
    const clone = template.content.cloneNode(true);

    const a = clone.querySelector("a");
    a.id = club.id_clubs;
    a.href = `/club/${club.id_clubs}`;

    const image = clone.querySelector("img");
    image.src = `/public/uploads/${club.image}`;

    const title = clone.querySelector("h3");
    title.innerHTML = club.name;

    clubsContainer.appendChild(clone);
}