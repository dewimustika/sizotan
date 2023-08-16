<?php

namespace Config;

class Permissions
{
    public static $roles = [
        'admin' => [
            'backend_access',
            'kelolapengaduan_access'
        ],
        'user' => [
            'kelolapengaduan_access'
        ]
    ];
}
