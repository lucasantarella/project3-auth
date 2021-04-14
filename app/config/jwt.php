<?php

declare(strict_types=1);

return [
    'public_key' => env('JWT_PUBLIC_KEY_PATH', 'pubkey.pem'),
    'private_key' => env('JWT_PRIVATE_KEY_PATH', 'privkey.pem'),
];
