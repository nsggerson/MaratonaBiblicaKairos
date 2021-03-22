/*
$( "#peso").change(function() {
      alert( "Handler for .change() called." );
    });*/

var int = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
var float = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ',', '.'];
var caracteres = ['.', ','];

var string = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
    'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
    'ç', 'ã', 'â', 'é', 'í', 'ì', 'á', 'à', 'õ', 'ô',
    '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
    '?', '!', ',', ':', '/', '.',
];

var varchar = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
    'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
    'ç', 'ã', 'â', 'é', 'í', 'ì', 'á', 'à', 'õ', 'ô', ' '
];

var text = [];





//  Procundo campo não preenchidos
function validarform() {

    // alert('Validaform Acionado')
    var frm = document.forms[0];
    var elms = frm.elements;
    //var titleForm = document.getElementById('title').innerText;
    var array = Object.keys(rulers);
    var vld = [];
    //  Percorre o rulers de input
    for (let a = 0; a < array.length; a++) {

        const elementRulers = array[a];
        //alert(elementRulers)           
        for (let b = 0; b < elms.length; b++) {
            //alert(elms[b].id)

            const elementForms = elms[b];
           // alert('Campo: ' + elementForms.id + ' Valor: ' + elementForms.value)
            //alert(elementForms.textContent)
            //  Verificando se os elemenstos consta no inputs
            //  alert('rulers: ' + elementRulers + ' form ' + elementForms.id)
            if (elementRulers === elementForms.id) {
                //Pega o tipo de dados para validar

                for (let c = 0; c < Object.keys(rulers[elementForms.id]).length; c++) {
                    const elementRulersKeys = Object.keys(rulers[elementForms.id])[c];
                    const elementRulersValue = rulers[elementForms.id][elementRulersKeys];
                    document.getElementById('ico-error-' + elementForms.id).className = '#';
                    // Validando o type 
                    if (elementRulersKeys === 'type') {
                        //alert('O tipo é: ' + elementRulersValue)
                        //alert('O valor: ' + elementForms.value)
                        switch (elementRulersValue) {
                            case 'options':
                                //alert('options')
                                if (elementForms.value == 'null') {
                                    document.getElementById(elementForms.id).focus();
                                    document.getElementById(elementForms.id).style.borderColor = "brown";
                                    document.getElementById('error').innerHTML = 'É obrigatório escolher uma opção.';
                                    document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon glyphicon-asterisk';
                                    document.getElementById('ico-error-' + elementForms.id).style.color = 'brown';
                                    return [0, elementForms.id];


                                } else {
                                    document.getElementById('error').innerHTML = '';
                                    document.getElementById(elementForms.id).style.borderColor = "";
                                    //document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon';
                                    break;
                                }
                            case 'float':
                                //alert('float')
                                var r = this.validateTypeFloat(elementForms);
                                if (r[0] == 0) {
                                    document.getElementById(elementForms.id).focus();
                                    document.getElementById(elementForms.id).style.borderColor = "brown";
                                    document.getElementById('error').innerHTML = "O valor [ " + r[2].toUpperCase() +
                                        " ] é incorreto para o campo [ " + r[1].toUpperCase() + " ]";
                                    document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon glyphicon-asterisk';
                                    document.getElementById('ico-error-' + elementForms.id).style.color = 'brown';
                                    return [0, elementForms.id];
                                } else {
                                    document.getElementById('error').innerHTML = '';
                                    document.getElementById(elementForms.id).style.borderColor = "";
                                    //document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon';
                                    break;
                                }
                            case 'int':
                                //alert('float')
                                var r = this.validateTypeInt(elementForms);
                                if (r[0] == 0) {
                                    document.getElementById(elementForms.id).focus();
                                    document.getElementById(elementForms.id).style.borderColor = "brown";
                                    document.getElementById('error').innerHTML = "O valor [ " + r[2].toUpperCase() +
                                        " ] é incorreto para o campo [ " + r[1].toUpperCase() + " ]";
                                    document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon glyphicon-asterisk';
                                    document.getElementById('ico-error-' + elementForms.id).style.color = 'brown';
                                    return [0, elementForms.id];

                                } else {
                                    document.getElementById('error').innerHTML = '';
                                    document.getElementById(elementForms.id).style.borderColor = "";
                                    //document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon';
                                    break;
                                }
                            case 'string':
                                //alert('string')
                                var r = this.validarString(elementForms);

                                if (r[0] == 0) {
                                    document.getElementById(elementForms.id).focus();
                                    document.getElementById(elementForms.id).style.borderColor = "brown";
                                    document.getElementById('error').innerHTML = "O valor [ " + r[2].toUpperCase() +
                                        " ] é incorreto para [ " + r[1].toUpperCase() + " ]";
                                    document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon glyphicon-asterisk';
                                    document.getElementById('ico-error-' + elementForms.id).style.color = 'brown';
                                    return [0, elementForms.id];

                                } else {
                                    document.getElementById('error').innerHTML = '';
                                    document.getElementById(elementForms.id).style.borderColor = "";
                                    //document.getElementById('ico-error-' + elementForms.id).className = "#";
                                    break;
                                }
                            case 'varchar':
                                //alert('string')
                                var r = this.validarVarchar(elementForms);

                                if (r[0] == 0) {
                                    document.getElementById(elementForms.id).focus();
                                    document.getElementById(elementForms.id).style.borderColor = "brown";
                                    document.getElementById('error').innerHTML = "O valor [ " + r[2].toUpperCase() +
                                        " ] é incorreto para [ " + r[1].toUpperCase() + " ]";
                                    document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon glyphicon-asterisk';
                                    document.getElementById('ico-error-' + elementForms.id).style.color = 'brown';
                                    return [0, elementForms.id];

                                } else {
                                    document.getElementById('error').innerHTML = '';
                                    document.getElementById(elementForms.id).style.borderColor = "";
                                    //document.getElementById('ico-error-' + elementForms.id).className = "#";
                                    break;
                                }

                        }
                    }
                    if (elementRulersKeys === 'sizeMin') {
                        //alert('sizeMin')
                        if ((document.getElementById(elementForms.id).value).length < elementRulersValue) {
                            document.getElementById(elementForms.id).focus();
                            document.getElementById(elementForms.id).style.borderColor = "brown";
                            document.getElementById('error').innerHTML = "O campo [ " + (elementForms.id).toUpperCase() +
                                " ] não pode estar [ NULL ] ou conter menos que [ " + elementRulersValue + " ] caracters.";
                            document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon glyphicon-asterisk';
                            document.getElementById('ico-error-' + elementForms.id).style.color = 'brown';
                            return [0, elementForms.id];
                        } else {
                            document.getElementById('error').innerHTML = '';
                            document.getElementById(elementForms.id).style.borderColor = "";
                            //document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon';
                            break;
                        }
                    }
                    if (elementRulersKeys === 'sizeMax') {
                        //alert('sizeMax')
                        if ((document.getElementById(elementForms.id).value).length > elementRulersValue) {
                            document.getElementById(elementForms.id).focus();
                            document.getElementById(elementForms.id).style.borderColor = "brown";
                            document.getElementById('error').innerHTML = "O campo [ " + (elementForms.id).toUpperCase() +
                                " ] não pode conter valor maior que " + elementRulersValue;
                            document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon glyphicon-asterisk';
                            document.getElementById('ico-error-' + elementForms.id).style.color = 'brown';
                            return [0, elementForms.id];
                        } else {
                            document.getElementById('error').innerHTML = '';
                            document.getElementById(elementForms.id).style.borderColor = "";
                            //document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon';
                            break;
                        }

                    }
                    if (elementRulersKeys === 'required') {
                        var textValue = document.getElementById(elementForms.id).value;
                        if (textValue.length <= 0) {
                            document.getElementById(elementForms.id).focus();
                            document.getElementById(elementForms.id).style.borderColor = "brown";
                            document.getElementById('error').innerHTML = "O campo [ " + (elementForms.id).toUpperCase() +
                                " ] não pode estar em branco";
                            document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon glyphicon-asterisk';
                            document.getElementById('ico-error-' + elementForms.id).style.color = 'brown';
                            return [0, elementForms.id];
                        } else {
                            document.getElementById('error').innerHTML = '';
                            document.getElementById(elementForms.id).style.borderColor = "";
                            //document.getElementById('ico-error-' + elementForms.id).className = 'glyphicon';
                            break;
                        }

                    }

                }
            }

        }
        vld[a] = elementRulers;
    }
    return [1, vld];
}

// Valida os para do tipo float
function validateTypeFloat(param) {

    var numero = param.value.split('');
    var array = [];
    // Pega a ultima posição
    var i = float.length - 1;
    for (let a = 0; a < numero.length; a++) {
        const elementNumber = numero[a];
        // Percorre o array com o numero floats
        for (let b = 0; b < float.length; b++) {
            const elementFloat = float[b];
            //alert('Teste: ' + a + ' Ultimo elemento: ' + float[i] + '\n Param: ' + elementNumber + ' String: ' 
            //+ elementFloat + ' \n Caracter ok: ' + array)
            if (elementNumber == elementFloat) {
                array[a] = elementNumber;
                break;
            }
            if (elementFloat === float[i]) {
                return [0, param.id, elementNumber];
            }
        }
    }
    return [1, array];
}

function validarString(param) {
    //retirado espaço em branco
    var text = param.value.replace(" ", "");
    var textParam = text.split('');

    var array = [];

    for (let a = 0; a < textParam.length; a++) {
        const elementParam = textParam[a];
        var i = string.length - 1;
        for (let b = 0; b < string.length; b++) {

            const elementString = string[b];
            //alert('Teste: ' + a + ' Ultimo elemento: ' + string[i] + '\n Param: ' + elementParam + ' String: '
            // + elementString + ' \n Caracter ok: ' + array)
            if (elementParam.toUpperCase() == elementString.toUpperCase()) {
                array[a] = elementParam;
                break;
            }
            if (elementString === string[i]) {
                return [0, param.id, elementParam];
            }
        }

    }
    return [1, array];
}

function validarVarchar(param) {
    //retirado espaço em branco
    var text = param.value.replace(" ", "");
    var textParam = text.split('');

    var array = [];

    for (let a = 0; a < textParam.length; a++) {
        const elementParam = textParam[a];
        var i = varchar.length - 1;
        for (let b = 0; b < varchar.length; b++) {

            const elementVarchar = varchar[b];
            //alert('Teste: ' + a + ' Ultimo elemento: ' + string[i] + '\n Param: ' + elementParam + ' String: '
            // + elementString + ' \n Caracter ok: ' + array)
            if (elementParam.toUpperCase() == elementVarchar.toUpperCase()) {
                array[a] = elementParam;
                break;
            }
            if (elementVarchar === string[i]) {
                return [0, param.id, elementParam];
            }
        }

    }
    return [1, array];
}

function validateTypeInt(param) {
    //retirado espaço em branco
    var text = param.value.replace(" ", "");
    var textParam = text.split('');

    var array = [];

    for (let a = 0; a < textParam.length; a++) {
        const elementParam = textParam[a];
        var i = float.length - 1;
        for (let b = 0; b < float.length; b++) {
            if (elementParam === '.' || elementParam === ',') {
                return [0, param.id, elementParam];
            }
            const elementFloat = float[b];
            //alert('Teste: ' + a + ' Ultimo elemento: ' + float[i] + '\n Param: ' + elementParam + ' String: ' +
            //elementFloat + ' \n Caracter ok: ' + array)
            if (elementParam == elementFloat) {
                array[a] = elementParam;
                break;
            }
            if (elementFloat === float[i]) {
                return [0, param.id, elementParam];
            }
        }

    }

    return [1, array];
}