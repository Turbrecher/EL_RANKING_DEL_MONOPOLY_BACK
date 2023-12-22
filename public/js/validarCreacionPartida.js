import {InputValidator} from './InputValidator.js'

let nombre = document.getElementById('nombre')
let fecha = document.getElementById('fecha')
let errorNombre = document.getElementById('errorNombre')
let errorFecha = document.getElementById('errorFecha')


document.addEventListener('submit', (e) => {

    if (!InputValidator.validarNombre(nombre.value)) {
        errorNombre.innerHTML = 'Nombre no valido.'
        e.preventDefault()
    } else {
        errorNombre.innerHTML = ''
    }

    if (!InputValidator.validarFecha(fecha.value)) {
        errorFecha.innerHTML = 'Fecha no valida.'
        e.preventDefault()
    } else {
        errorFecha.innerHTML = ''
    }

})