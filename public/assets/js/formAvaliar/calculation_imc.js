function calculation_imc(){

    //Data de nascimento
    var peso = document.getElementById("peso").value;
    var altura = document.getElementById("altura").value;
    //Validando o campo altura
    
    var b = altura.split('.');
    if (altura.indexOf(',') == 1) {
        altura = parseFloat(altura.replace(',', '.'));
    } else if (altura.indexOf('.')) {
        altura = parseFloat(altura);
    } else {
        altura = parseFloat('0' + '.' + altura);
    }
    peso = parseFloat(peso);
    var soma = String(peso / (altura * altura));
    var result = soma.substring(0, 5);
    document.getElementById("imc").value = result;

}