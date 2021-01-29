function getUserCookie() {
    return document.cookie
        .split(";")
        .map(cookie => cookie.trim())
        .filter(isUserCookie)[0]
        .split("=")[1];
}

function isUserCookie(element) {
    return element.split("=")[0] === "userId";
}

const button = document.querySelector('#join-button');
const club = parseInt(button.value);
const userId = getUserCookie();
const memberContainer = document.querySelector('.member-container');

button.addEventListener("click", function (event) {
    const data = {club: club, userId: userId};
    fetch("/join", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data),
    }).then(function (response) {
        return response.json();
    }).then(function (members) {
       memberContainer.innerHTML = "";
       loadMembers(members);
    });

});

function loadMembers(members) {
    members.forEach(member => {
        console.log(member);
        createMember(member);
    })
}

function createMember(member) {
    const template = document.querySelector("#member-template");
    const clone = template.content.cloneNode(true);

    const a = clone.querySelector("a");
    a.href = `/profile/${member.id_users}`;

    //const image = clone.querySelector("img");
    //image.src = `/public/uploads/${club.image}`;

    const nameSurname = clone.querySelector("#name-surname");

    nameSurname.innerHTML = member.name + " " + member.surname;

    memberContainer.appendChild(clone);
}