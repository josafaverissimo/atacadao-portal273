function MyTable(id, filterFormId = null) {
    const table = document.getElementById(id)
    const tableSpinner = table.querySelector(".spinner");
    const filterForm = filterFormId ? document.getElementById(filterFormId) : null
    const thead = getThead()
    let tbody = getTbody()

    function getThead() {
        const cells = table.querySelectorAll("thead th")

        if(!cells) {
            return []
        }

        return [].reduce.call(cells,(row, cell) => [...row, cell.textContent], [])
    }

    function getTbody() {
        const rows = table.querySelectorAll("tbody tr")

        return [].reduce.call(rows, (table, row) => {
            const cells = row.querySelectorAll("td")
            row = [].reduce.call(cells, (row, cell) => [...row, cell.textContent], [])

            return [...table, row]
        }, [])
    }

    function filterTable(search) {
        const filteredRows = tbody.reduce((rows, row) => {
            const isSearchInCell = row.some(cell => {
                return cell.removeAccents().indexOf(search) !== -1
            })

            if(isSearchInCell) {
                rows.push(row)
            }

            return rows
        }, [])

        if(filteredRows.length === 0) {
            loadNotFoundRows()
            return
        }

        loadRows(filteredRows)
    }

    function cleanRows() {
        table.querySelector("tbody").innerHTML = ""
    }

    function loadNotFoundRows() {
        cleanRows()
        const text = "Nenhum registro foi encontrado"
        const tbody = table.querySelector("tbody")

        const tr = document.createElement("tr")
        const td = document.createElement("td")
        td.textContent = text
        td.setAttribute("colspan", String(thead.length))
        td.classList.add("text-center")
        tr.appendChild(td)

        tbody.appendChild(tr)
    }

    function loadRows(rows) {
        cleanRows()

        if(rows.length === 0) {
            loadNotFoundRows()
            return
        }

        const tbody = table.querySelector("tbody")

        rows.forEach(row => {
            const tr = document.createElement("tr")

            row.forEach(cell => {
                const td = document.createElement("td")

                td.textContent = cell
                td.classList.add("col-4")
                tr.appendChild(td)
            })

            tbody.appendChild(tr)
        })
    }

    function cleanFilter() {
        filterForm.querySelector("input").value = ""
        loadRows(tbody)
    }

    function listeningFilterInput() {
        const filterInput = filterForm.querySelector("input")
        const cleanButton = filterForm.querySelector("button")

        if(filterInput) {
            filterInput.addEventListener("input", () => {
                const inputValue = filterInput.value.removeAccents()
                filterTable(inputValue)
            })
        }

        if(cleanButton) {
            cleanButton.addEventListener("click", cleanFilter)
        }
    }

    function loadNewRows(rows) {
        tbody = rows

        cleanFilter()
        loadRows(rows)
    }

    function startLoading() {
        tableSpinner.removeAttribute("hidden")
        table.classList.add("loading")
    }

    function endLoading() {
        tableSpinner.setAttribute("hidden", "")
        table.classList.remove("loading")
    }

    listeningFilterInput()

    return {
        loadNewRows,
        startLoading,
        endLoading
    }
}