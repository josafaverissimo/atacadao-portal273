function mySelect(onChange = null) {
    const selectElements = document.querySelectorAll(".my-select")
    const selectOptionsData = {}

    function getSelectOptions(select) {
        const options = select.querySelectorAll("option")
        return [].reduce.call(options, (options, option) => {
            options.push({
                id: option.id,
                value: option.value,
                textContent: option.textContent.trim().toLowerCase()
            })

            return options
        }, [])
    }

    function changeValue(select, option) {
        select.querySelector("button").textContent = option.textContent
        select.querySelector(`#${option.id}`).selected = true

        if(onChange !== null) {
            onChange(option.value)
        }
    }

    function insertLiDropdownItem(select, option) {
        const optionsWrapper = getOptionsWrapper(select)
        const liDropdownItem = document.createElement("li")
        liDropdownItem.classList.add("dropdown-item", "text-capitalize")
        liDropdownItem.textContent = option.textContent
        liDropdownItem.setAttribute("role", "button")

        liDropdownItem.addEventListener("click", () => {
            changeValue(select, option)
        })

        optionsWrapper.appendChild(liDropdownItem)
    }

    function getOptionsWrapper(select) {
        return select.querySelector("ul ul")
    }

    function fillValues() {
        selectElements.forEach(select => {
            const optionsById = getSelectOptions(select)
            const inputElement = select.querySelector("input")

            selectOptionsData[select.id] = []

            optionsById.forEach(option => {
                insertLiDropdownItem(select, option)
                selectOptionsData[select.id].push(option)
            })

            inputElement.addEventListener("input", () => {
                listeningInput(select, inputElement)
            })
        })
    }

    function listeningInput(select, inputElement) {
        const currentValue = inputElement.value.toLowerCase()
        const selectOptionData = selectOptionsData[select.id]

        const filteredSelectOptionData = selectOptionData.reduce((options, option) => {
            if(option.textContent.indexOf(currentValue) !== -1) {
                options.push(option)
            }

            return options
        }, [])

        cleanOptionsWrapper(select)

        filteredSelectOptionData.forEach(option => {
            insertLiDropdownItem(select, option)
        })
    }

    function cleanOptionsWrapper(select) {
        const optionsWrapper = getOptionsWrapper(select)
        optionsWrapper.innerHTML = ""
    }

    fillValues()
}