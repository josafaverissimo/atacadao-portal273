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

document.addEventListener("scroll", () => {
    document.documentElement.dataset.scroll = window.scrollY
})

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

function notRefresh() {
    const anchors = document.querySelectorAll("a")

    function getPageFromUrl(url) {
        return fetch(url)
            .then(response => response.text())
            .then(text => {
                const parser = new DOMParser()
                return parser.parseFromString(text, "text/html")
            })
    }

    anchors.forEach(anchor => {
        anchor.addEventListener("click", async event => {
            event.preventDefault()

            const url = anchor.closest("a").href
            const page = await getPageFromUrl(url)

            const pageDownloadedTitle = page.head.querySelector("title")
            document.head.querySelector("title").textContent = pageDownloadedTitle ? pageDownloadedTitle.textContent : ""
            document.head.append(...page.head.querySelectorAll("link"))
            document.body.querySelector("footer").append(page.body.querySelector("footer"))
            document.getElementById("app").innerHTML = page.getElementById("app").innerHTML

            notRefresh()
        })
    })
}

notRefresh()
