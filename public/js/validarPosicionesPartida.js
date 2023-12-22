let selectores = document.getElementsByClassName('selector')
let errorSelectores = document.getElementById('errorSelectores')


document.addEventListener('submit', (e) => {
    //Guardamos los valores de los select en un array.
    let jugadores = []

    for (const selector of selectores) {
        jugadores.push(selector.value)
    }

    //Hacemos que si algun valor se repite, el formulario no se envie.
    for (const selector of selectores) {
        if (seRepite(selector.value, jugadores)) {
            e.preventDefault()
            errorSelectores.innerHTML = "En cada lugar debe haber un jugador, no pueden repetirse."
        }
    }

})


/**
 * Funcion que comprueba si el valor pasado como primer parametro se repite en la lista pasada como segundo parametro.
 * @param valor valor individual
 * @param lista coleccion donde se va a comprobar la repeticion
 * @returns {boolean} si se repite o no (true o false)
 */
function seRepite(valor, lista) {
    let coincidencias = 0
    for (let i = 0; i < lista.length; i++) {
        if (valor === lista[i]) {
            coincidencias++
        }
    }

    return coincidencias > 1
}