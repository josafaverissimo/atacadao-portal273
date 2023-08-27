document.addEventListener("DOMContentLoaded", () => {
    const clockTimeSelector = ".clock .time"
    const clockDateSelector = ".clock .date"
    const clock = Clock(clockTimeSelector, clockDateSelector)

    clock.startClock()
})