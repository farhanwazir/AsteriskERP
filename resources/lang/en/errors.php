<?php

return [
    '404' => [
        'code' => '404',
        'heading' => 'Oops! Not found.',
        'msg' => 'We could not find the request you were looking for. Meanwhile, you may <a href="'. url('/') .'">return to dashboard</a>.
        <br /><br />Contact system administrator for support or <a href="'. url('/') .'">restart</a>.'
    ],

    '503' => [
    'code' => '503',
    'heading' => 'Oops! Service unavailable.',
    'msg' => 'The server is currently unable to handle the request due to a temporary overloading or maintenance of the server.
        <br /><br />Contact system administrator for support or <a href="'. url('/') .'">retry</a>.'
]
];