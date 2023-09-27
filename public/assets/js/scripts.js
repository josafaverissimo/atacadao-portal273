const baseUrl = "https://atacadao-portal273"

const myIntervals = []

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

function createNodeFromHtml(html) {
    const genericElementWrapper = document.createElement("div")

    genericElementWrapper.innerHTML = html

    return genericElementWrapper.firstElementChild
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

    function appendLinksIfNotExists(links) {
        links.forEach(link => {
            let linkExist = false

            document.head.querySelectorAll("link").forEach(linkExisting => {
                if(linkExisting.href === link.href) {
                    linkExist = true
                    return
                }
            })

            if(!linkExist) {
                document.head.appendChild(link)
            }
        })
    }

    function appendScriptsIfNotExists(scripts) {
        scripts.forEach(script => {
            let scriptExist = false

            document.body.querySelectorAll("footer script").forEach(scriptExisting => {
                if(scriptExisting.src === script.src) {
                    scriptExist = true
                    return
                }
            })

            if(!scriptExist) {
                const scriptToLoad = document.createElement("script")
                scriptToLoad.src = script.src
                document.body.querySelector("footer").appendChild(scriptToLoad)
            }
        })
    }

    function clearIntervals() {
        myIntervals.forEach(clearInterval)
    }

    anchors.forEach(anchor => {
        anchor.addEventListener("click", async event => {
            if(anchor.target === "_blank") return
            event.preventDefault()

            const app = document.getElementById("app")

            const url = anchor.closest("a").href
            const page = await getPageFromUrl(url)

            const pageDownloadedTitle = page.head.querySelector("title")
            const pageDownloadedLinks = page.head.querySelectorAll("link")
            const pageDownloadedScripts = page.body.querySelectorAll("footer script")
            const pageDownloadedApp = page.getElementById("app")

            clearIntervals()

            document.head.querySelector("title").textContent = pageDownloadedTitle.textContent

            appendLinksIfNotExists(pageDownloadedLinks)
            appendScriptsIfNotExists(pageDownloadedScripts)

            while(app.firstChild) {
                app.removeChild(app.firstChild)
            }

            app.append(...pageDownloadedApp.childNodes)

            notRefresh()
        })
    })
}

// notRefresh()
