var array = [];
var aut = false;
array[0] = document.getElementById('rh');
array[1] = document.getElementById('option1');





function authenticate(str) {

    alert(this.validarform(array[0]));
    return false;
    /*
    var tm = array.length;
    for (let a = 0; a < tm; a++) {
        for (let b = 1; b < tm; b++) {
            const forward = array[b];
            if (validarform(str)) {
                str.style.borderColor = "green";
                document.getElementById('authentic-' + str.id).style.display = 'inline';
                forward.readOnly = false;
                forward.focus();
                c = b - 1;
                // Ativando a função imc
                if (array[c].value && array[b].value && document.getElementById('imc').value.length < 1) {
                    this.calculation_imc();
                }
                //  Configurando o campo diagnostico
                if (array[b].id == 'diagnostico' && array[b].value.length > 1) {
                    var diagnostico = [];
                    var e;
                    var exploder = String(array[b].value).split('');
                    for (let d = 0; d < exploder.length; d++) {
                        const element = exploder[d];
                        diagnostico[d] = element.replace(' ', '/');
                    }
                    e = diagnostico.join('');
                    array[b].value = e.toUpperCase();
                }
            } else {
                // Configurando input no Erro
                document.getElementById('authentic-' + str.id).style.display = 'none';
                str.style.borderColor = "red";
                str.focus();
                return false;
            }
            if (forward.value == null || forward.value === '') {
                return false;
            }
        }
    }
    this.aut = true;*/
}
/*
function authenticate() {
    var diagnostico = avaliacao.diagnostico.value;
    if (document.getElementById('frEstressInjuria').value === '&') {
        document.getElementById('error').innerHTML = 'O campo fator Estresse não pode conter o valor (Escolha...)';
        return false;
    }
    if (this.aut == false) {
        document.getElementById('error').innerHTML = '';
        return false;
    }

}*/