//alert('input_create_setor')
var rulers = {
    //Position 0
    name: {
        'type': 'varchar',
        'sizeMin': '3',
        'sizeMax': '25',

    },
    //Position 2
    rh: {
        'type': 'int',
        'sizeMin': '5',
        'sizeMax': '7'
    },

    datanasc: {
        'required': true,
    },

    etiniagenero: {
        'type': 'options'
    },
    setor: {
        'type': 'string',
        'required': true
    },


};