const search = document.querySelector('input[placeholder="Search"]');
const clubsContainer = document.querySelector('.clubs-container');

search.addEventListener("keyup", function(event) {
   if(event.key === "Enter") {
       event.preventDefault();

       const data = {search: this.value};
       fetch("/search", {
           method: "POST",
           headers: {
               'Content-Type': 'application/json'
           },
           body: JSON.stringify(data),
       }).then(function (response) {
           return response.json();
       }).then(function (clubs){
           clubsContainer.innerHTML = "";
           loadClubs(clubs)
       });
   }
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

    const div = clone.querySelector("div");
    div.id = club.id;

    const image = clone.querySelector("img");
    image.src = `/public/uploads/${club.image}`;

    const title = clone.querySelector("h3");
    title.innerHTML = club.name;

    const description = clone.querySelector("p");
    description.innerHTML = club.description;

    clubsContainer.appendChild(clone);
}