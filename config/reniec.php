<?php
return
[
    'service'               => env("RENIEC_WSDL", ""),
    'company'               => env("RENIEC_COMPANY", ""),
    'user'                  => env("RENIEC_USER", ""),
    'pass'                  => env("RENIEC_PASSWORD", ""),
    'max_sec_timeout'       => env("RENIEC_MAX_SEC_TIMEOUT", "20"),
];