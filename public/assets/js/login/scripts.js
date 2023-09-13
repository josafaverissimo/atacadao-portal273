function authenticate() {
    const form = document.querySelector("form")

    form.addEventListener("submit", event => {
        event.preventDefault()

        const user = event.target.user.value
        const password = event.target.password.value
        const credentials = btoa(`${user}:${password}`)

        fetch(`${baseUrl}/login/do-login`, {
            headers: {
                Authorization: `Basic ${credentials}`
            }
        }).then(response => response.json())
            .then(json => {
                if(json.success) {
                    sessionStorage.setItem("authorization",  credentials)

                    window.location.href = `${baseUrl}/`
                }
            })
    })
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("input").forEach(input => {
        input.addEventListener(
            "input",
            () => document.querySelector("img").classList.add("expand")
        )
    })

    authenticate()
})