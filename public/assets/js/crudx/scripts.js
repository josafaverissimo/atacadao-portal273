function Requester (target)  {
    const config = {
        method: "GET",
        headers: {},
        body: null
    }

    function setMethod(method) {
        config.method = method.toUpperCase()
    }

    function setHeaders(headers) {
        config.headers = headers
    }

    function setBody(body) {
        config.body = body
    }

    function send() {
        return fetch(target, config)
    }

    return {
        setMethod,
        setHeaders,
        setBody,
        send
    }
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".update-table").forEach(tableWrapper => {
        const myTable = MyTable(tableWrapper.querySelector(".my-table"))
        const tableActions = tableWrapper.querySelector(".table-actions")

        tableActions.querySelector(".update-button").addEventListener("click", event => {
            const button = event.target.closest("button")
            const requester = Requester(button.dataset.target)

            myTable.startLoading()
            requester.send()
                .then(response => response.json())
                .then(json => {
                    myTable.loadNewRows(json.rows.map(Object.values))
                    myTable.endLoading()
                })
        })
    })
})