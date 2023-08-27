document.addEventListener("DOMContentLoaded", () => {
    const navbarClockTimeSelector = ".navbar-clock .time"
    const navbarClockDateSelector = ".navbar-clock .date"
    const navbarClock = Clock(navbarClockTimeSelector, navbarClockDateSelector)

    navbarClock.startClock()
})