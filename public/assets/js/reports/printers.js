function getPrinterStats(printerHost) {
    const url = `${baseUrl}/reports/printers/getPrinterData/${printerHost}`

    return fetch(url).then(response => response.json())
}

function PrinterStatsTable(table) {
    function setRows(data) {
        let currentRow = 1
        data.forEach(value => {
            const tdData = table.querySelector(`tr:nth-child(${currentRow++}) td:nth-child(2)`)
            tdData.innerHTML = value
        })
    }

    return {
        setRows,
        table
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const printersStatsTables = [].map.call(document.querySelectorAll("table"), PrinterStatsTable)

    printersStatsTables.forEach(table => {
        const { host } = table.table.dataset
        const getPrinterStatsPromise = getPrinterStats(host)

        getPrinterStatsPromise.then(response => {
            if(response.success) {
                const rowData = []
                rowData.push(`${response.tonerLevel}%`)
                rowData.push(response.todayPrints)
                rowData.push(response.totalPrints)

                table.setRows(rowData)
                return
            }

            table.setRows(["N/A", "N/A", "N/A"])
        })
    })
})