<?php

return  [
      /**Tabela de peso estimado */
      'formPesoEstimado' => [
        "Homem/Branco" => [
            "19-a-59"=>[
                'aj'=> 2.22,
                'cb'=> 3.14,
                'valor'=> 86.82,
            ],
            "60-a-80"=>[
                'aj'=> 1.10,
                'cb'=> 3.07,
                'valor'=> 75.81,
            ],            
        ],
        "Homem/Negro" => [
            "19-a-59"=>[
                'aj'=> 1.09,
                'cb'=> 3.14,
                'valor'=> 83.72,
            ],
            "60-a-80"=>[
                'aj'=> 0.44,
                'cb'=> 2.86,
                'valor'=> 39.21,
            ],   
        ],
        "Mulher/Branca" => [
            "19-a-59"=>[
                'aj'=> 1.01,
                'cb'=> 2.81,
                'valor'=> 66.04,
            ],
            "60-a-80"=>[
                'aj'=> 1.09,
                'cb'=> 2.68,
                'valor'=> 65.51,
            ],  
        ],
        "Mulher/Negra" => [
            "19-a-59"=>[
                'aj'=> 1.24,
                'cb'=> 2.97,
                'valor'=> 82.48,
            ],
            "60-a-80"=>[
                'aj'=> 1.50,
                'cb'=> 2.58,
                'valor'=> 84.22,
            ],  
        ]
    ],
    /**Tabela de altura estimado */
    'formAlturaEstimado' => [
        "Homem/Branco" => [
            "6-a-18"=>[
                'aj'=> 2.22,
                'valor'=> 40.54,
            ],
            "19-a-60"=>[
                'aj'=> 1.88,
                'valor'=> 71.85,
            ],
            ">60"=>[
                'aj'=> 2.08,
                'valor'=> 59.01,
            ]
        ],
        "Homem/Negro" => [
            "6-a-18"=>[
                'aj'=> 2.18,
                'valor'=> 39.60,
            ],
            "19-a-60"=>[
                'aj'=> 1.79,
                'valor'=> 73.42,
            ],
            ">60"=>[
                'aj'=> 1.37,
                'valor'=> 95.79,
            ]
        ],
        "Mulher/Branca" => [
            "6-a-18"=>[
                'aj'=> 2.14,
                'valor'=> 43.21,
            ],
            "19-a-60"=>[
                'aj'=> 1.88,
                'idd'=> 0.06,
                'valor'=> 71.85,
            ],
            ">60"=>[
                'aj'=> 1.91,
                'idd'=> 0.17,
                'valor'=> 75.00,
            ]
        ],
        "Mulher/Negra" => [
            "6-a-18"=>[
                'aj'=> 2.02,
                'valor'=> 46.59,
            ],
            "19-a-60"=>[
                'aj'=> 1.86,
                'idd'=> 0.06,
                'valor'=> 68.10,
            ],
            ">60"=>[
                'aj'=> 1.96,            
                'valor'=> 58.72,
            ]
        ]
    ],    

];
