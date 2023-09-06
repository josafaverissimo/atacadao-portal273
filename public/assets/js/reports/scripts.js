function ReportsListItem() {
    function create(url, target, name, description, time, footer) {
        const itemAnchor = document.createElement("a")
        itemAnchor.href = url
        itemAnchor.target = target
        itemAnchor.classList.add("list-group-item", "list-group-item-action", "flex-column", "align-items-start")

        const itemWrapperDiv = document.createElement("div")
        itemWrapperDiv.classList.add("d-flex", "w-100", "justify-content-between")
        itemAnchor.appendChild(itemWrapperDiv)

        const itemReportNameH1 = document.createElement("h1")
        itemReportNameH1.classList.add("h5", "mb-1")
        itemReportNameH1.textContent = name
        itemWrapperDiv.appendChild(itemReportNameH1)

        const itemReportTimeSmall = document.createElement("small")
        itemReportTimeSmall.textContent = time
        itemWrapperDiv.appendChild(itemReportTimeSmall)

        const itemReportDescriptionP = document.createElement("p")
        itemReportDescriptionP.classList.add("mb-1")
        itemReportDescriptionP.textContent = description
        itemAnchor.appendChild(itemReportDescriptionP)

        const itemReportFooterSmall = document.createElement("small")
        itemReportFooterSmall.classList.add("fst-italic")
        itemAnchor.appendChild(itemReportFooterSmall)

        const itemReportFooterSmallEm = document.createElement("em")
        itemReportFooterSmallEm.textContent = footer
        itemReportFooterSmall.appendChild(itemReportFooterSmallEm)

        return itemAnchor
    }

    return {
        create
    }
}

function ReportsList(reportsDataSelector) {
    const listGroup = document.querySelector(reportsDataSelector)
    const reportListItem = ReportsListItem()
    const defaultFooter = listGroup.dataset.footer
    const notFound=  listGroup.querySelector(".not-found").cloneNode(true)

    function clean() {
        listGroup.innerHTML = ""
        hideNotFound()
        listGroup.appendChild(notFound)
    }

    function push({url, target, name, description, time, footer}) {
        const item = reportListItem.create(url, target, name, description, time, footer ?? defaultFooter)
        listGroup.appendChild(item)
    }

    function showNotFound() {
        notFound.removeAttribute("hidden")
    }

    function hideNotFound() {
        notFound.setAttribute("hidden", "")
    }

    function get() {
        const items = listGroup.querySelectorAll("a")
        return [].reduce.call(items, (reports, report) => {
            return [...reports, {
                url: report.href,
                target: report.target,
                time: report.querySelector("div > small").textContent,
                name: report.querySelector("h1").textContent,
                description: report.querySelector("p").textContent
            }]
        }, [])
    }

    return {
        get,
        clean,
        push,
        showNotFound,
        hideNotFound
    }
}

function ReportsFilter(reportsFilterSelector, reportsDataSelector) {
    const filterWrapper = document.querySelector(reportsFilterSelector)
    const input = filterWrapper.querySelector("input")
    const resetButton = filterWrapper.querySelector("button")
    const reportsList = ReportsList(reportsDataSelector)
    const reportsListData = reportsList.get()

    function getFilteredData(value) {
        value = value.toLowerCase().removeAccents()

        return reportsListData.filter(report => {
            let match = false

            Object.keys(report).forEach(key => {
                if(report[key].toLowerCase().removeAccents().indexOf(value) !== -1) {
                    match = true
                    return
                }
            })

            return match
        })
    }

    function show(reports) {
        reportsList.clean()

        if(reports.length === 0) {
            reportsList.showNotFound()
            return
        }

        reportsList.hideNotFound()

        reports.forEach(reportsList.push)
    }

    function clean() {
        input.value = ""

        reportsList.clean()
        reportsListData.forEach(reportsList.push)
    }

    function listen() {
        input.addEventListener("input", () => {
            const filteredData = getFilteredData(input.value)
            show(filteredData)
        })

        resetButton.addEventListener("click", clean)
    }

    return {
        listen
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const internalReports = ReportsFilter("#internal-reports-filter", "#internal-reports-list")
    const saveReportsFilter = ReportsFilter("#save-reports-filter", "#save-reports-list")

    internalReports.listen()
    saveReportsFilter.listen()
})