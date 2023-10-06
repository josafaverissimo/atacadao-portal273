function getUnitPhones(unitId) {
    const resource = `/phones/unitPhones/unitId/${unitId}`

    return fetch(resource)
}

document.addEventListener("DOMContentLoaded", () => {
    const mainTable = document.querySelector("#unit-phones")
    const myTable = MyTable(mainTable)
    const mySelectWrapper = document.getElementById("select-unit")

    MySelect(mySelectWrapper, function(value) {
        myTable.startLoading()

        getUnitPhones(value)
            .then(response => response.json())
            .then(json => {
                myTable.loadNewRows(json.rows)
                myTable.endLoading()
            })
    }).fillOptions()
})