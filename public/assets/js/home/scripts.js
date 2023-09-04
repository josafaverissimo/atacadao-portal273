function PhonesTable() {
    const inputSearch = document.querySelector("#phones-search-filter input")
    const table = document.getElementById("phones-table")
    const unitPhones = JSON.parse(localStorage.getItem("unitPhones"))

    function cleanTable() {
        table.querySelector("tbody").innerHTML = "";
    }

    function loadPhonesTableByData(phones) {
        cleanTable()

        const rows = []
        phones.forEach(phone => {
            const tr = document.createElement("tr")
            const tdPhone = document.createElement("td")
            const tdSector = document.createElement("td")

            tdSector.classList.add("text-capitalize")

            tdPhone.textContent = phone.phone
            tdSector.textContent = phone.owner.toLowerCase()

            tr.appendChild(tdPhone)
            tr.appendChild(tdSector)

            table.querySelector("tbody").appendChild(tr)
        })
    }

    function filter() {
        const inputSearchValue = inputSearch.value.toLowerCase().removeAccents()

        if(inputSearchValue === "") {
            loadPhonesTableByData(unitPhones)
            return
        }

        const phonesMatched = unitPhones.reduce((rows, row) => {
            let phone = row.phone.toLowerCase().removeAccents()
            let sector = row.owner.toLowerCase().removeAccents()

            if(phone.indexOf(inputSearchValue) !== -1 || sector.indexOf(inputSearchValue) !== -1) {
                rows.push(row)
            }

            return rows
        }, [])

        loadPhonesTableByData(phonesMatched)
    }

    function cleanInputAndRestorePhones() {
        inputSearch.value = ""
        loadPhonesTableByData(unitPhones)
    }

    return {
        filter,
        cleanInputAndRestorePhones
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const phonesSearchFilter = document.getElementById("phones-search-filter")
    const restorePhonesButton = phonesSearchFilter.querySelector("button")
    const filterInput = phonesSearchFilter.querySelector("input")
    const phonesTable = PhonesTable()

    restorePhonesButton.addEventListener("click", phonesTable.cleanInputAndRestorePhones)
    filterInput.addEventListener("input", phonesTable.filter)
})