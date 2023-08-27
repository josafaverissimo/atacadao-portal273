function Clock() {
    const timeElement = document.querySelector(".time");
    const dateElement = document.querySelector(".date");

    function getTimeNow() {
        const date = new Date()
        const hours = String(date.getHours()).padStart(2, "00")
        const minutes = String(date.getMinutes()).padStart(2, "00")
        const seconds = String(date.getSeconds()).padStart(2, "00")

        return `${hours}:${minutes}:${seconds}`
    }

    function startTime() {
        setInterval(() => {
            let time = getTimeNow()
            timeElement.textContent = time
            timeElement.querySelector("time").setAttribute("datetime", time);

        }, 1000)
    }

    return {
        startTime
    }
}
document.addEventListener("DOMContentLoaded", () => {
    const clock = Clock()

    clock.startTime()
})