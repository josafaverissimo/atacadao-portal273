const baseUrl = "https://atacadao-portal273"

String.prototype.removeAccents = function() {
    return this.toString()
        .replace(/[àáâã]/g, "a")
        .replace(/[éê]/g, "e")
        .replace(/í/g, "i")
        .replace(/[óôõ]/g, "o")
        .replace(/ú/g, "u")
        .replace(/ç/g, "c")
        .replace(/[ÀÁÂÃ]/g, "A")
        .replace(/[ÉÊ]/g, "E")
        .replace(/Í/g, "I")
        .replace(/[ÓÔÕ]/g, "O")
        .replace(/ÚÜ/g, "U")
        .replace(/Ç/g, "C")
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

function storeScroll() {
    document.documentElement.dataset.scroll = window.scrollY

}

document.addEventListener("scroll", storeScroll)

storeScroll();
