<?php
/*
* File:     imap.php
* Category: config
* Author:   M. Goldenbaum
* Created:  24.09.16 22:42
* Updated:  -
*
* Description:
* -
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Default IMAP Connection Account
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the IMAP connections below you wish
    | to use as your default connection for all IMAP work. Of course
    | you may use many connections at once using the IMAP library.
    |
    */
    'default' => env('IMAP_DEFAULT_ACCOUNT', 'default'),

    /*
    |--------------------------------------------------------------------------
    | IMAP Accounts
    |--------------------------------------------------------------------------
    |
    | Here you may configure the IMAP accounts that will be used to access
    | your servers. You can even define multiple accounts, if you have
    | multiple mailboxes that you want to access.
    |
    | PLEASE NOTE: It's highly recommended to use env variables to hide
    | your personal information. You can find an example below.
    |
    */
    'accounts' => [

        'default' => [
            'host' => env('IMAP_HOST', 'localhost'),
            'port' => env('IMAP_PORT', 993),
            'protocol' => env('IMAP_PROTOCOL', 'imap'), //might be 'imap', 'pop3' or 'nntp'
            'encryption' => env('IMAP_ENCRYPTION', 'ssl'), //might be 'ssl', 'tls' or 'false'
            'validate_cert' => env('IMAP_VALIDATE_CERT', true),
            'username' => env('IMAP_USERNAME', 'root@localhost'),
            'password' => env('IMAP_PASSWORD', ''),
            'options' => [
                'sequencing' => 'uid'
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | Different options for the connection.
    |
    */
    'options' => [
        // 'debug' => true,
        'connect_timeout' => 5,
        'read_timeout' => 10,
        'timeout' => 30,
    ],
];
