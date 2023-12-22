import {InputValidator} from './InputValidator.js'

let nombreTorneo = document.getElementById('nombre')
let fechaInicio = document.getElementById('fInicio')
let fechaFinal = document.getElementById('fFin')
let errorNombre = document.getElementById('errorNombre')
let errorFechaInicio = document.getElementById('errorFechaInicio')
let errorFechaFin = document.getElementById('errorFechaFin')


document.addEventListener('submit', (e) => {

    if (!InputValidator.validarNombre(nombreTorneo.value)) {
        errorNombre.innerHTML = 'Nombre no valido.'
        e.preventDefault()
    } else {
        errorNombre.innerHTML = ''
    }

    if (!InputValidator.validarFecha(fechaInicio.value)) {
        errorFechaInicio.innerHTML = 'Fecha no valida.'
        e.preventDefault()
    } else {
        errorFechaInicio.innerHTML = ''
    }

    if (!InputValidator.validarFecha(fechaFinal.value)) {
        errorFechaFin.innerHTML = 'Fecha no valida.'
        e.preventDefault()
    } else {
        errorFechaFin.innerHTML = ''
    }


})