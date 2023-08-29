String.prototype.removeAccents = function() {
    return this.toString()
        .toLowerCase()
        .replace(/[áâã]/g, "a")
        .replace(/[éê]/g, "e")
        .replace(/í/g, "i")
        .replace(/[óôõ]/g, "o")
        .replace(/ú/g, "u")
}

function getCookie(name) {
    const cookies = document.cookie.split(";")
    const cookie = cookies.filter(cookie => {
        const cookieName = cookie.split("=")[0].trim()

        return cookieName === name
    })[0]

    if(cookie) {
        return decodeURIComponent(cookie.split("=")[1])
    }

    return null
}