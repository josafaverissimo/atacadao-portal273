function PhoneTable() {
    const inputSearch = document.querySelector("#phones-search-form input")
    const table = document.getElementById("phones-table")
    const unitPhones = JSON.parse(localStorage.getItem("phonesUnit"))

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
    const phonesSearchForm = document.getElementById("phones-search-form")
    const restorePhonesButton = phonesSearchForm.querySelector("button")
    const phoneTable = PhoneTable()

    phonesSearchForm.addEventListener("submit", event => {
        event.preventDefault()
    })

    restorePhonesButton.addEventListener("click", phoneTable.cleanInputAndRestorePhones)

    phonesSearchForm.querySelector("input").addEventListener("input", phoneTable.filter)
})