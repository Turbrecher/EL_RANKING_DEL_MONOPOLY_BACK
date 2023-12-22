import {InputValidator} from './InputValidator.js'

let nombre = document.getElementById('nombre')
let apellidos = document.getElementById('apellidos')
let nick = document.getElementById('nick')
let errorNombre = document.getElementById('errorNombre')
let errorApellidos = document.getElementById('errorApellidos')
let errorNick = document.getElementById('errorNick')


document.addEventListener('submit', (e) => {

    if (!InputValidator.validarNombre(nombre.value)) {
        errorNombre.innerHTML = 'Nombre no valido.'
        e.preventDefault()
    } else {
        errorNombre.innerHTML = ''
    }

    if (!InputValidator.validarApellidos(apellidos.value)) {
        errorApellidos.innerHTML = 'Apellidos no validos.'
        e.preventDefault()
    } else {
        errorApellidos.innerHTML = ''
    }

    if (!InputValidator.validarNick(nick.value)) {
        errorNick.innerHTML = 'Nick no valido.'
        e.preventDefault()
    } else {
        errorNick.innerHTML = ''
    }

})