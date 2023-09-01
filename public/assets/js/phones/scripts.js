function getUnitPhones(unitId) {
    const resource = `/phones/unitPhones/unitId/${unitId}`

    return fetch(resource)
}

document.addEventListener("DOMContentLoaded", () => {
    const mainTable = MyTable("unit-phones", "phones-search-form")

    mySelect(function(value) {
        getUnitPhones(value)
            .then(response => response.json())
            .then(json => {
                mainTable.cleanFilter()
                mainTable.loadNewRows(json.rows)
            })
    })
})