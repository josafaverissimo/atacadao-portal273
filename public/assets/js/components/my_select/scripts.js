function MySelect(mySelectWrapper, onChange) {
    const selectOptionsData = []

    function getSelectOptions() {
        const options = mySelectWrapper.querySelectorAll("option")
        return [].reduce.call(options, (options, option) => {
            options.push({
                id: option.id,
                value: option.value,
                textContent: option.textContent.trim().toLowerCase()
            })

            return options
        }, [])
    }

    function changeValue(option) {
        mySelectWrapper.querySelector("button").textContent = option.textContent
        mySelectWrapper.querySelector(`#${option.id}`).selected = true

        if(onChange) {
            onChange(option.value)
        }
    }

    function insertLiDropdownItem(option) {
        const optionsWrapper = getOptionsWrapper()
        const liDropdownItem = document.createElement("li")
        liDropdownItem.classList.add("dropdown-item", "text-capitalize")
        liDropdownItem.textContent = option.textContent
        liDropdownItem.setAttribute("role", "button")

        liDropdownItem.addEventListener("click", () => {
            changeValue(option)
        })

        optionsWrapper.appendChild(liDropdownItem)
    }

    function getOptionsWrapper() {
        return mySelectWrapper.querySelector("ul ul")
    }

    function fillOptions() {
        const optionsById = getSelectOptions()
        const inputElement = mySelectWrapper.querySelector("input")

        optionsById.forEach(option => {
            insertLiDropdownItem(option)
            selectOptionsData.push(option)
        })

        inputElement.addEventListener("input", () => {
            listeningInput(inputElement)
        })
    }

    function listeningInput(inputElement) {
        const currentValue = inputElement.value.toLowerCase()

        const filteredSelectOptionData = selectOptionsData.reduce((options, option) => {
            if(option.textContent.indexOf(currentValue) !== -1) {
                options.push(option)
            }

            return options
        }, [])

        cleanOptionsWrapper()

        filteredSelectOptionData.forEach(option => {
            insertLiDropdownItem(option)
        })
    }

    function cleanOptionsWrapper() {
        const optionsWrapper = getOptionsWrapper()
        optionsWrapper.innerHTML = ""
    }

    return {
        fillOptions
    }
}

function MySelectNode(data = {}) {
    const node = createGenericNode()

    function createGenericNode() {
        return createNodeFromHtml(`
            <div id="${data.id || ""}" class="dropdown my-select ${data.classes || ""}">
                <div class="d-flex flex-column align-items-center">            
                    <label>${data.label}</label>   
                    <select name="${data.name || ""}">
                        ${!!data.options ? data.options.reduce((options, option) => {
                            options += `
                                <option id="my-select-${data.id || ""}-option-${option.id}"
                                    value="${option.value}"
                                >
                                   ${option.textContent}
                                </option>
                            `
                            return options
                        }, "") : ""}
                    </select>
                </div>
                
                <button class="btn btn-light btn-outline-dark dropdown-toggle"
                    data-bs-toggle="dropdown"
                    type="button"
                >
                    ${data.buttonPlaceHolder || "Selecione uma opção"}
                </button>
    
                <div class="dropdown-menu">
                    <ul class="list-group-flush px-2">
                        <li class="list-group-item">
                            <input type="text" class="form-control" placeholder="${data.inputPlaceHolder || "Pesquisar"}">
                            <div class="dropdown-divider"></div>
                        </li>
        
                        <ul class="p-0"></ul>
                    </ul>
                </div>
            </div>`
        )
    }

    function getGenericNode() {
        return node
    }

    return {
        getGenericNode
    }
}
