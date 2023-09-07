function loadButton() {

}

document.addEventListener("DOMContentLoaded", () => {
    const mainTable = MyTable("update-data-table", "update-data-search-filter")

    document.querySelector("#load-button").addEventListener("click", () => {
        fetch(`${baseUrl}/update/birthday-people`)
    })
})