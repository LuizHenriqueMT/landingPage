function submitInfos() {
    const formActived = document.querySelector('.form')
    const inputName = document.querySelector('.inputname')
    const inputWhats = document.querySelector('.inputwhats')
    const inputInsta = document.querySelector('.inputinsta')
    const inputTrafego = document.querySelector('.inputtrafego')

    const h2 = document.querySelector('h2')


    if(inputName.value &&
         inputInsta.value &&
          inputWhats.value &&
            inputTrafego.value != '') {
        
        formActived.classList.add('form-actived')

        function printH2() {
            h2.innerHTML = "Formulário, preenchido com sucesso"
        }
    
        printH2()
    }
        
}

    