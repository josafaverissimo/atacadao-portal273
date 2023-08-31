function waitImages() {
    const imgs = document.querySelectorAll("img")

    imgs.forEach(img => {
        if(!img.complete) {
            let currentDisplay = window.getComputedStyle(img).getPropertyValue("display")
            img.style.display = "none"
            img.onload = () => {
                img.style.display = currentDisplay
            }
        }
    })
}