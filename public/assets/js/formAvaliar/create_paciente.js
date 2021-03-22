function validar() {
    var name = document.getElementById('name');
    var rh = document.getElementById('rh');
    var idade = document.getElementById('idade');
    var etiniagenero = document.getElementById('etiniagenero');

    if (validarform(name)) {
        if (validarform(rh)) {
            if (validarform(idade)) {
                if (validarform(etiniagenero)) {
                    return true;
                }
            }
        }
    }
    return false;
}