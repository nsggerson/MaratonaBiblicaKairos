  
    let float = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ',', '.', '/'];
    let arrayInt = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    let arrayString = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
        'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        'ç', 'ã', 'â', 'é', 'í', 'ì', 'á', 'à', 'õ', 'ô',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
        '?', '!', ',', ':', '/', '.','@',
    ];

    function startValidate(){
        //  Pegando o nome do formulario
        let frm = document.forms;
        //let nameForm = ($frm[0].id).toLowerCase();
        document.write(json(frm[0])); 
        
    }

    function json(a) { 
        let frc = a.id.toLowerCase();
        let elt = a.elements;                
        const ajax = new XMLHttpRequest();
        //let text='';
        let a1 = '';
        let a2 = [];
        let a3 ='';
        let a4 = '';
        
        ajax.open("GET","/assets/js/formAvaliar/inputs.rulers.json");
        ajax.responseType = 'json';
        ajax.send();
        ajax.addEventListener('readystatechange',function(){           
            if (ajax.readyState === 4 && ajax.status === 200 ) {
                let respKey= Object.keys(ajax.response[frc]);
                let respValue= ajax.response[frc];                
                for (let $a = 0; $a < respKey.length; $a++) {
                    const keyJson = respKey[$a];                    
                    for (let $b = 0; $b < elt.length; $b++) {
                        const element = elt[$b];
                        if (keyJson === element.id) {                                          
                            for (let valueKey in respValue[keyJson]) {                               
                               let b1 = [respValue[keyJson][valueKey]];
                               for (let i = 0; i < b1.length; i++) {
                                    const elem = b1[i];                                    
                                    if (a1.length >= 1) {                                    
                                        if (valueKey === 'type') {
                                            a2.push(a1+'}');
                                            a1 ='\"'+keyJson+'\":{\"'+valueKey+'\"' + ':'+'\"'+elem+'\"';
                                        }else{
                                            a1 += ','+'\"'+valueKey+'\"' + ':'+'\"'+elem+'\"'; 
                                        }
                                    }else{                                        
                                        a1 = '\"'+keyJson+'\":{\"'+valueKey+'\"' + ':\"'+elem+'\"';
                                    }                           
                                }
                            } 
                           break; 
                        } 
                                               
                    }
                }
                return '{'+a2.toString+'}';                              
            }
        });
           
    }

    function processInput(a){
        //alert(a.length)
        let tm = 0;
        for (let $a in a) {
            const id = Object.keys(a[$a]);            
            for(let $b in a[$a]){
                //console.log(a[$a][$b])
                /**PErcorre os elemento internos do json */
                for (let $k in a[$a][$b]) {
                    let key = $k;
                    let kvalue = a[$a][$b];
                    let value = a[$a][$b][$k];
                    let input= document.getElementById(id.toString());
                    //console.log(value)

                    if (key == 'type' && value == 'options') {
                        if(optionsValidate(input,id.toString()) === 0){
                            return 0;
                        }
                        eventErrorReset(id.toString());
                        tm ++;                        
                        break;                        
                    }
                    else if (key == 'type' && value == 'float') {
                        if (floatValidate(input,id.toString()) === 0) {
                            return 0;
                        }
                        for (let $c in kvalue) {                            
                           //console.log(a[$a][$b][$c])                            
                           switch ($c) {
                               case 'sizeMin':
                                   if(input.value.length  < a[$a][$b][$c]){
                                    eventError(input,id.toString(), 'brown',
                                    'O campo não pode conter valor menor (<) que '+a[$a][$b][$c]+' Caracteres numéricos.',
                                    'glyphicon glyphicon-asterisk');
                                       return 0;
                                   } 
                                   eventErrorReset(id.toString());
                                   tm ++;                                 
                                   break;
                            case 'sizeMin':
                                   if(input.value.length  < a[$a][$b][$c]){
                                    eventError(input,id.toString(), 'brown',
                                    'O campo não pode conter valor menor (<) que '+a[$a][$b][$c]+' Caracteres numéricos.',
                                    'glyphicon glyphicon-asterisk');
                                       return 0;
                                   } 
                                   eventErrorReset(id.toString());
                                   tm ++;                                 
                                   break;
                           }                           
                        }
                    }
                    else if (key == 'type' && value == 'string') {
                        if (stringValidate(input,id.toString()) === 0) {
                            return 0;
                        } 
                        tm ++;                        
                        break;
                    } 
                    else if (key == 'type' && value == 'int') {
                        if (intValidate(input,id.toString()) === 0) {
                            return 0;
                        } 
                        tm ++;                        
                        break;
                    } 
                }
            }            
        }
        if (tm === a.length) {
           return true; 
        }
    } 

    function optionsValidate(a, b){
        if (a.value === 'null') {
            eventError(a, b, 'brown',
            'É obrigatório escolher uma opção.',
            'glyphicon glyphicon-asterisk');
            return 0;
        }

    }

    function floatValidate(a, b) {
        /**
         * Var a= inputs patarametros  */
        $a = b.toUpperCase();
        //Verifica se o campo esta branco
        if (a.value.length <= 0) {
            eventError(a, b,
                'brown',
                "O Campo [ " + $a + " ] não pode ser null.",
                'glyphicon glyphicon-asterisk');
            return 0;
        }

        let arr = a.value.split('');
        let $c = [];
        let $d = '';

        for (let i = 0; i < arr.length; i++) {
            const elArray = arr[i];
            for (let j = 0; j < float.length; j++) {
                const elFloat = float[j].toString();
                if (elArray === elFloat) {
                    if (elFloat === ',') {
                        $c.push('.');
                    } else {
                        $c.push(elFloat);
                    }
                }
            }
            if ($c.indexOf(elArray) == -1) {
                $d += elArray.toUpperCase();
            }
        }

        if ($c.length < arr.length) {
            eventError(a, b,
                'brown',
                "O Campo [ " + $a + " ] não pode recerber o valor [ " + $d + " ].",
                'glyphicon glyphicon-asterisk');
            return 0;
        }
        eventErrorReset(b);
        a.value = $c.join('');
    }

    function intValidate(a, b) {
        /**
         * Var a= inputs patarametros  */
        $a = b.toUpperCase();
        //Verifica se o campo esta branco
        if (a.value.length <= 0) {
            eventError(a, b,
                'brown',
                "O Campo [ " + $a + " ] não pode ser null.",
                'glyphicon glyphicon-asterisk');
            return 0;
        }

        let arr = a.value.split('');
        let $c = [];
        let $d = '';

        for (let i = 0; i < arr.length; i++) {
            const elArray = arr[i];
            for (let j = 0; j < arrayInt.length; j++) {
                const elInt = arrayInt[j].toString();
                if (elArray === elInt) {
                    $c.push(elInt);
                }
            }
            if ($c.indexOf(elArray) == -1) {
                $d += elArray.toUpperCase();
            }
        }

        if ($c.length < arr.length) {
            eventError(a, b,
                'brown',
                "O Campo [ " + $a + " ] não pode recerber o valor [ " + $d + " ].",
                'glyphicon glyphicon-asterisk');
            return 0;
        }
        eventErrorReset(b);
        a.value = $c.join('');
        return 1;
    }

    function stringValidate(a, b) {
        /**
         * Var a= inputs patarametros  */
        $a = b.toUpperCase();
        //Verifica se o campo esta branco
        if (a.value.length <= 0) {
            eventError(a, b,
                'brown',
                "O Campo [ " + $a + " ] não pode ser null.",
                'glyphicon glyphicon-asterisk');
            return 0;
        }

        let arr = a.value.split('');
        let $c = [];
        let $d = '';

        for (let i = 0; i < arr.length; i++) {
            const elArray = arr[i];
            for (let j = 0; j < arrayString.length; j++) {
                const elString = arrayString[j].toLowerCase();
                if (elArray.toLowerCase() === elString) {
                    $c.push(elString);
                }
            }
            if ($c.indexOf(elArray) == -1) {
                $d += elArray.toUpperCase();
            }
        }

        if ($c.length < arr.length) {
            eventError(a, b,
                'brown',
                "O Campo [ " + $a + " ] não pode recerber o valor [ " + $d + " ].",
                'glyphicon glyphicon-asterisk');
            return 0;
        }
        eventErrorReset(b);
        a.value = $c.join('');
        return 1;
    }

    function eventError(a, b, c, d, e) {
        /**
         * var a = Passa o nome dos elementos como inputs ou check
         * var b = Passa o nome do elemento id
         * var c = Passa a cor para o text e elemento grafico de erro
         * var d = Passa a mensagem
         * var e = ativa o icone 
         */

        a.focus();
        a.style.borderColor = c;
        document.getElementById('error').innerHTML = d;
        document.getElementById('ico-error-' + b).className = e;
        document.getElementById('ico-error-' + b).style.color = c;
        
    }

    function eventErrorReset(a) {
        /**
         * var a = Passa o nome dos elementos como inputs ou check
         * */
        document.getElementById('error').innerHTML = '';
        document.getElementById(a).style.borderColor = '';
        document.getElementById('ico-error-' + a).className = '';
        
    }

    //window.addEventListener('load', main);
