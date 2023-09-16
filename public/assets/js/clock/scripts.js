function startMainClock() {
    const clockTimeSelector = ".clock .time"
    const clockDateSelector = ".clock .date"
    const clock = Clock(clockTimeSelector, clockDateSelector)
    clock.startClock()
}

if(document.readyState === "complete") {
    startMainClock()
} else {
    document.addEventListener("DOMContentLoaded", startMainClock)
}
