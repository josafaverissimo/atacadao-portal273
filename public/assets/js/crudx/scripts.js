function Requester (target)  {
    const config = {
        method: "GET",
        headers: {},
        body: null
    }

    function setMethod(method) {
        config.method = method.toUpperCase()
    }

    function setHeaders(headers) {
        config.headers = headers
    }

    function setBody(body) {
        config.body = body
    }

    function send() {
        return fetch(target, config)
    }

    return {
        setMethod,
        setHeaders,
        setBody,
        send
    }
}

function getData(target, data) {
    const requester = Requester(target)

    if(data) {
        if(data.method) requester.setMethod(data.method)
        if(data.headers) requester.setHeaders(data.headers)
        if(data.body) requester.setBody(data.body)
    }

    return requester.send().then(response => response.json())
}

function doTableActions(tableActions, myTableInstance) {
    const fullscreenModal = FullscreenModal()
    const fullscreenModalForm = fullscreenModal.getNode().querySelector("#create-form-wrapper form")
    const createButton = tableActions.querySelector(".create-button")
    const reloadButton = tableActions.querySelector(".reload-button")
    const expandButton = tableActions.querySelector(".expand-button")
    const { tableToUpdate } = tableActions.dataset
    const tableCard = document.querySelector(`#table-card-${tableToUpdate}`)

    function createButtonAction() {
        // createButton.addEventListener("click",() => {
        //     const html = `
        //         <div>
        //
        //         </div>
        //     `;
        //     expandTable()
        // })
    }

    function reloadButtonAction() {
        const target = `${baseUrl}/crudx/reload/${tableToUpdate}`
        const requester = Requester(target)

        reloadButton.addEventListener("click", () => {
            myTableInstance.startLoading()
            requester.send()
                .then(response => response.json())
                .then(json => {
                    myTableInstance.loadNewRows(json.rows.map(Object.values))
                    myTableInstance.endLoading()
                })
        })
    }

    function expandTable() {
        const myTable = tableCard.querySelector(`.my-table`).cloneNode(true)
        const tableTitle = tableCard.querySelector("h1").textContent
        const fullscreenModalTitleElement = fullscreenModal.getNode().querySelector("h1")

        setFormByTable(tableToUpdate)

        fullscreenModalForm.dataset.tableToUpdate = tableToUpdate

        fullscreenModalTitleElement.textContent = tableTitle
        fullscreenModal.clearBody()
        fullscreenModal.append(myTable)
        fullscreenModal.show()
    }

    function expandButtonAction() {
        expandButton.addEventListener("click", expandTable)
    }

    function translateInputNameToPortuguese(inputName) {
        return {
            name: "nome",
            birthday: "aniversário",
            number: "número",
            sector: "setor",
            owner: "responsável",
            unit: "filial",
            username: "nome de usuário",
            password: "senha",
            host: "host",
            image: "imagem",
            currentPrints: "total de impressões",
            lastDayPrints: "impressões de ontem",
            link: "link",
            description: "description",
            resource: "recurso",
            category: "categoria"
        }[inputName]
    }

    function makeInputWrapperElementElement({id, name, inputData}) {
        const type = inputData.type
        const nameTranslated = translateInputNameToPortuguese(name) || name
        const inputWrapperElementByType = {
            text: () => createNodeFromHtml(`
                <div class="d-flex flex-column align-items-center px-2">
                    <label for="${id}-input">${nameTranslated}</label>
                    <input type="text" id="${id}-input" name="${name}" class="form-control">
                </div>
            `),
            password: () => createNodeFromHtml(`
                <div class="d-flex flex-column align-items-center px-2">
                    <label for="${id}-input">${nameTranslated}</label>
                    <input type="password" id="${id}-input" name="${name}" class="form-control">
                </div>
            `),
            select: () => {
                const options = inputData.options

                const mySelectNode = MySelectNode({
                    id: `${id}-my-select`,
                    name: name,
                    label: nameTranslated,
                    options
                }).getGenericNode()

                MySelect(mySelectNode).fillOptions()

                return mySelectNode
            }
        }

        return inputWrapperElementByType[type]()
    }

    async function setFormByTable(table) {
        const formDataByTable = {
            birthdayPeople: {
                name: {
                    type: "text"
                },
                birthday: {
                    type: "text"
                }
            },
            units: {
                name: {
                    type: "text",
                },
                number: {
                    type: "text"
                }
            },
            unitsPhones: {
                number: {
                    type: "text",
                },
                sector: {
                    type: "text"
                },
                owner: {
                    type: "text"
                },
                unit: {
                    type: "select",
                    options: (await getData(`${baseUrl}/units/getAll`)).map(data => {
                        return {
                            id: data.id,
                            value: data.id,
                            textContent: `${String(data.number).padStart(3, "000")} - ${data.name}`
                        }
                    })
                }
            },
            users: {
                username: {
                    type: "text"
                },
                password: {
                    type: "password"
                }
            },
            links: {
                name: {
                    type: "text"
                },
                resource: {
                    type: "text"
                },
                category: {
                    type: "select",
                    options: (await getData(`${baseUrl}/links-categories/getAll`)).map(data => {
                        return {
                            id: data.id,
                            value: data.id,
                            textContent: data.name
                        }
                    })
                }
            },
            linksCategories: {
                name: {
                    type: "text"
                }
            },
            printers: {
                name: {
                    type: "text"
                },
                host: {
                    type: "text"
                },
                image: {
                    type: "text"
                },
                currentPrints: {
                    type: "text"
                },
                lastDayPrints: {
                    type: "text"
                }
            },
            reports: {
                name: {
                    type: "text"
                },
                description: {
                    type: "text"
                },
                resource: {
                    type: "text"
                },
                category: {
                    type: "select",
                    options: (await getData(`${baseUrl}/reports-categories/getAll`)).map(data => {
                        return {
                            id: data.id,
                            value: data.id,
                            textContent: data.name
                        }
                    })
                }
            },
            reportsCategories: {
                name: {
                    type: "text"
                }
            }
        }
        const formData = formDataByTable[table]
        const fullscreenModalFormInputsWrapper = fullscreenModalForm.querySelector("#inputs-wrapper")

        fullscreenModalFormInputsWrapper.innerHTML = ""

        Object.entries(formData).forEach(entry => {
            const [inputName, inputData] = entry
            const inputWrapperElement = makeInputWrapperElementElement({
                id: inputName,
                name: inputName,
                inputData
            })

            fullscreenModalFormInputsWrapper.appendChild(inputWrapperElement)
        })
    }

    function startActions() {
        createButtonAction()
        reloadButtonAction()
        expandButtonAction()
    }

    startActions()
}

function FullscreenModal() {
    const nodeFullscreenModal = document.querySelector("#modal-expanded-table")
    const bootstrapFullscreenModal = bootstrap.Modal.getOrCreateInstance(nodeFullscreenModal)
    const body = nodeFullscreenModal.querySelector(".modal-body")

    function getNode() {
        return nodeFullscreenModal
    }

    function getBoostrapInstance() {
        return bootstrapFullscreenModal
    }

    function clearBody() {
        body.querySelector(".main").innerHTML = ""
    }

    function append(node) {
        body.querySelector(".main").append(node)
    }

    function show() {
        bootstrapFullscreenModal.show()
    }

    function hide() {
        bootstrapFullscreenModal.hide()
    }

    return {
        getBoostrapInstance,
        getNode,
        append,
        clearBody,
        show,
        hide
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const fullscreenModal = FullscreenModal()
    const nodeFullscreenModal = fullscreenModal.getNode()
    const nodeFullscreenModalForm = nodeFullscreenModal.querySelector("form")

    nodeFullscreenModal.querySelectorAll("button.close").forEach(button => {
        button.addEventListener("click", () => {
            fullscreenModal.hide()
        })
    })

    nodeFullscreenModalForm.addEventListener("submit", async event => {
        event.preventDefault()

        const tableToUpdate = nodeFullscreenModalForm.dataset.tableToUpdate
        const formData = new FormData()

        nodeFullscreenModalForm.querySelectorAll("input,select")
            .forEach(({name, value}) => {
                formData.append(name, value)
            }
        )

        const response = await getData(`${baseUrl}/crudx/create/${tableToUpdate}`, {
            method: "post",
            body: formData
        })

        console.log(response)
    })

    document.querySelectorAll(".update-table").forEach(tableWrapper => {
        const myTable = MyTable(tableWrapper.querySelector(".my-table"))
        const tableActions = tableWrapper.querySelector(".table-actions")

        doTableActions(tableActions, myTable)
    })
})