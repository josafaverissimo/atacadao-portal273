function PhoneTable() {
    const inputSearch = document.querySelector("#phones-search-form input")
    const table = document.getElementById("phones-table")
    const phonesUnit = JSON.parse(localStorage.getItem("phonesUnit"))

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

            tdPhone.textContent = phone.telefone
            tdSector.textContent = phone.depto

            tr.appendChild(tdPhone)
            tr.appendChild(tdSector)

            table.querySelector("tbody").appendChild(tr)
        })
    }

    function filter() {
        const inputSearchValue = inputSearch.value.toLowerCase().removeAccents()

        if(inputSearchValue === "") {
            loadPhonesTableByData(phonesUnit)
            return
        }

        const phonesMatched = phonesUnit.reduce((rows, row) => {
            let phone = row.telefone.toLowerCase().removeAccents()
            let sector = row.depto.toLowerCase().removeAccents()

            if(phone.indexOf(inputSearchValue) !== -1 || sector.indexOf(inputSearchValue) !== -1) {
                rows.push(row)
            }

            return rows
        }, [])

        loadPhonesTableByData(phonesMatched)
    }

    function cleanInputAndRestorePhones() {
        inputSearch.value = ""
        loadPhonesTableByData(phonesUnit)
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