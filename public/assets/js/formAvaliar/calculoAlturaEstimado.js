$("#avaliacao :input").change(function() {
    //var valor = get_altura();

    var valor = document.getElementById('formEstatura').value;

    var aj = parseFloat(document.getElementById('aj').value);
    var idade = parseInt(document.getElementById('idade').value);
    document.getElementById('altura').value = '0,00';
    var array = valor.split(',');
    a = array[0].split(':');
    b = array[1].split(':');
    c = array[2].split(':');
    var fm_aj = parseFloat(a[1]);
    var fm_id = parseFloat(b[1]);
    var valor = parseFloat(c[1]);
    var soma = parseFloat((valor - (fm_id * idade)).toFixed(2)) + (fm_aj * aj);
    var result = String(soma).split('');
    result = String(result[0] + '.' + result[1] + result[2]);
    document.getElementById('altura').value = result;

});