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