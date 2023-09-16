function LinksFilterForm() {
    const cleanButton = document.querySelector("#links-search-filter button")
    const input = document.querySelector("#links-search-filter input")
    const linksByCategory = JSON.parse(localStorage.getItem("linksByCategory"))
    const linksTabContent = document.querySelector("#links-tab-content")
    const emptyMessageDiv = document.querySelector("#links-empty-message")
    const navTabButtons = document.querySelectorAll("#links-tab button")

    function listening() {
        navTabButtons.forEach(navTabButton => {
            navTabButton.addEventListener("click", event => {
                const clickedButton = event.target
                const currentTabId = getCurrentTab().id

                if(clickedButton.id.indexOf(currentTabId) !== -1) {
                    cleanFilter()
                    hiddenEmptyMessage()
                }
            })
        })
        cleanButton.addEventListener("click", cleanFilter)
        input.addEventListener("input", filterLinks)
    }

    function filterLinks() {
        const currentValue = input.value.toLowerCase().removeAccents()
        const currentTabId = getCurrentTab().id

        const linksFiltered = linksByCategory[currentTabId].links.reduce((links, link) => {
            const linkName = link.name.toLowerCase().removeAccents()
            if(linkName.indexOf(currentValue) !== -1 || link.resource.indexOf(currentValue) !== -1) {
                links.push(link)
            }

            return links
        }, [])

        if(linksFiltered.length === 0) {
            cleanTab()
            showEmptyMessage()
            return
        }

        showLinks(linksFiltered)
    }

    function hiddenEmptyMessage() {
        emptyMessageDiv.setAttribute("hidden", "")
    }

    function showEmptyMessage() {
        emptyMessageDiv.removeAttribute("hidden")
    }

    function getCurrentTab() {
        return linksTabContent.querySelector("div.active")
    }

    function cleanTab() {
        const currentTab = getCurrentTab()

        hiddenEmptyMessage()
        currentTab.innerHTML = ""
    }

    function cleanFilter() {
        const currentTabId = getCurrentTab().id
        input.value = ""

        showLinks(linksByCategory[currentTabId].links)
    }

    function showLinks(filteredLinks) {
        cleanTab()

        const currentTab = getCurrentTab()
        const cardRows = linkCardsRows(filteredLinks)

        cardRows.forEach(cardRow => {
            currentTab.appendChild(cardRow)
        })
    }

    return {
        listening
    }
}

function linkCardsRows(links) {
    function createRow() {
        const divRow = document.createElement("div")
        divRow.classList.add("row", "justify-content-center")

        return divRow
    }

    function createCardLink(name, url, notTargetBlank) {
        const divCard = document.createElement("div")
        divCard.classList.add("col-md-6", "col-lg-4", "col-xl-3", "mb-md-2")

        const anchorCard = document.createElement("a")
        anchorCard.classList.add("card", "text-decoration-none")
        anchorCard.href = url

        if(!notTargetBlank) {
            anchorCard.setAttribute("target", "_blank")
        }

        divCard.appendChild(anchorCard)

        const divCardBody = document.createElement("div")
        divCardBody.classList.add("card-body", "d-flex", "justify-content-center")

        anchorCard.appendChild(divCardBody)

        const divSpanWrapper = document.createElement("div")
        const spanCardTitle = document.createElement("span")
        spanCardTitle.textContent = name.toLowerCase()
        spanCardTitle.classList.add("text-capitalize")

        divSpanWrapper.appendChild(spanCardTitle)

        divCardBody.appendChild(divSpanWrapper)

        return divCard
    }

    function generateLinksCardsRows() {
        const rows = []
        let divCardRow = createRow()

        for(let row = 0; row < links.length; row += 3) {
            for(let column = 0; column < 3; column++) {
                let index = row + column;

                if(!links[index]) {
                    break
                }

                let link = links[index]

                let cardLink = createCardLink(link.name, link.resource, link.notTargetBlank)
                divCardRow.appendChild(cardLink)
            }

            rows.push(divCardRow)
        }

        return rows
    }

    return generateLinksCardsRows()
}

function listeningLinkCenterFilter() {
    const linkFilterForm = LinksFilterForm()

    linkFilterForm.listening()
}

if(document.readyState === "complete") {
    listeningLinkCenterFilter()
} else {
    document.addEventListener("DOMContentLoaded", listeningLinkCenterFilter)
}