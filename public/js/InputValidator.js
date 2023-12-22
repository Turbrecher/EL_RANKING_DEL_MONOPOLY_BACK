export class InputValidator {
    constructor() {
    }

    static validarNombre(nombre) {

        if (!isNaN(nombre)) {
            return false
        }

        return !(nombre.length < 0 || nombre.length > 50);


    }

    static validarApellidos(apellidos) {
        if (!isNaN(apellidos)) {
            return false
        }

        return !(apellidos.length < 0 || apellidos.length > 50);


    }

    static validarNick(nick) {

        if (!isNaN(nick)) {
            return false
        }

        return !(nick.length < 0 || nick.length > 50);


    }

    static validarFecha(fecha) {
        if (fecha.length <= 0) {
            return false
        }

        return /[0-9]{4}-[0-9]{2}-[0-9]{2}/.test(fecha)
    }
}