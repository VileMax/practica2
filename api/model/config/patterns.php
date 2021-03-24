<?php
$patterns = [
    'phone' => [
        'pattern' => '/^((\+380)|(380)|(80)|(0)|())\d{9}$/',
        'replace' => [
            'pattern' => '/^((\+380)|(380)|(80)|(0)|())/',
            'value' => '+380'
        ]
    ],
    'email' => [
        'pattern' => '/^\w+@\w+$/',
    ]
	
];