function getUnitPhones(unitId) {
    const resource = `/phones/unitPhones/unitId/${unitId}`

    return fetch(resource)
}

document.addEventListener("DOMContentLoaded", () => {
    const mainTable = MyTable("unit-phones", "phones-search-filter")

    mySelect(function(value) {
        mainTable.startLoading()

        getUnitPhones(value)
            .then(response => response.json())
            .then(json => {
                mainTable.loadNewRows(json.rows)
                mainTable.endLoading()
            })
    })
})