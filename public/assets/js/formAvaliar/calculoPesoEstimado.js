$("#avaliacao").change(function() {
    //alert('PESO')
    //var valor = get_peso();
    
    var valor = document.getElementById('formPesoEstimado').value;
    //alert(valor)
    /*
    var aj = parseFloat(document.getElementById('aj').value);
    var cb = parseFloat(document.getElementById('cb').value);

    document.getElementById('peso').value = '0,00';
    document.getElementById('altura').value = '0,00';

    var array = valor.split(',');
    a = array[1].split(':');
    b = array[2].split(':');
    c = array[3].split(':');
    var fm_aj = parseFloat(a[1]);
    var fm_cb = parseFloat(b[1]);
    var valor = parseFloat(c[1]);
    var soma = (((aj * fm_aj) + (cb * fm_cb)) - valor).toFixed(2);
    document.getElementById('peso').value = soma;*/
});