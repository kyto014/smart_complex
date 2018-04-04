<?php

// tento konfiguracny subor sluzi na definovanie vsetkych premennych, kt. v kode pouzivame

return[
    'operation_code' => [
        'access_allowed' => 1,
        'access_denied' => 0,
        'sf_password' => 2,
        'sf_code' => 3
    ],

    'key_types' => [
        'rfid' => 1,
        'tag' => 2
    ],

    'second_factor_type' => [
        'none' => 0,
        'password' => 2,
        'code' => 3
    ]
];