function fatorEstresse(str) {
    //alert('Acessado fatorEstresse')
    var valor = str.split('/');
    document.getElementById('message').innerHTML = '';
    if (valor[0] == '' && valor[1] != '') {
        document.getElementById('ideal').value = false;
        document.getElementById('atual').value = valor[1];
    } else if (valor[0] != '' && valor[1] == '') {
        document.getElementById('ideal').value = valor[0];
        document.getElementById('atual').value = false;
    } else if (valor[0] != '' && valor[1] != '') {
        document.getElementById('ideal').value = valor[0];
        document.getElementById('atual').value = valor[1];
    } else {
        document.getElementById('ideal').value = false;
        document.getElementById('atual').value = false;
    }

}