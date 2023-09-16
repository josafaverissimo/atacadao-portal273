function Clock(timeElementSelector, dateElementSelector) {
    function getTimeNow() {
        const date = new Date()
        const hours = String(date.getHours()).padStart(2, "00")
        const minutes = String(date.getMinutes()).padStart(2, "00")
        const seconds = String(date.getSeconds()).padStart(2, "00")

        return `${hours}:${minutes}:${seconds}`
    }

    function getDateNow() {
        const date = new Date()
        const months = [
            "janeiro", "fevereiro", "março", "abril", "maio", "junho",
            "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"
        ]
        const day = String(date.getDate()).padStart(2, "00")
        const monthNumber = date.getMonth()
        const year = String(date.getFullYear()).padStart(2, "00")
        const month = months[monthNumber]

        return {
            "message": `${day} de ${month} de ${year}`,
            "formatted": `${year}-${month}-${day}`
        }
    }

    function startClock() {
        myIntervals.push(setInterval(() => {
            const time = getTimeNow()
            const date = getDateNow()
            const timeElement = document.querySelector(timeElementSelector);
            const dateElement = document.querySelector(dateElementSelector);

            timeElement.textContent = time
            timeElement.setAttribute("datetime", time);

            dateElement.textContent = date.message
            dateElement.setAttribute("datetime", date.formatted)

        }, 1000))
    }

    return {
        startClock
    }
}
