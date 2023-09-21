function authenticate() {
    const form = document.querySelector("form")

    form.addEventListener("submit", event => {
        event.preventDefault()

        const user = event.target.user.value
        const password = event.target.password.value
        const body = (new URLSearchParams({user, password})).toString()

        fetch(`${baseUrl}/login/do-login`, {
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            method: "POST",
            body,
        }).then(response => response.json())
            .then(json => {
                if(json.success) {
                    window.location.assign(json.redirect)
                } else {
                    bootstrap.Toast.getOrCreateInstance(document.querySelector(".toast")).show()
                }
            })
    })
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("input").forEach(input => {
        const img = document.querySelector("img")
        input.addEventListener("focus",() => img.classList.add("expand"))
        input.addEventListener("blur", () => img.classList.remove("expand"))
    })

    authenticate()
})